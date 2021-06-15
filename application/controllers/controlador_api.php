<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class controlador_api extends JwtAPI_Controller {
    public function __construct (){
        parent::__construct ();
        $this->load->model("model_principal");
        $this->load->model("model_administrador");
        $this->load->model("Tokens_m");

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');


        $config=[
            //            "iat" => time(), // AUTOMATIC value 
            //            "exp" => time() + 300, // expires 5 minutes AUTOMATIC VALUE
            "sub" => "secure.jwt.daw.local", // subject of token
            "jti" => $this->uuid->v5('secure.jwt.daw.local')// Json Token Id
        ];
        $this->init($config,300); // configuration + auth timeout
        // $this->init($config); // configuration + auth timeout is configured from JWT config file


        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
    }
    
    // URL PER ACCEDIR: http://localhost/treball-final-sintesi/api
    // Funció per la API amb el mètode: GET 
    // Variables a afegir: id, cat, categories, autor, categoria_name i privadesa.
    // En el cas que es faci servir qualsevol dels paràmetres menys el de ID, no farà falta una token
    public function req_get(){

        $token=explode(" ",$this->head ("Authorization"));

        $id= $this->get('id');
        $cat= $this->get('cat');
		
		if($this->get('categories') != NULL){

            //dona com a resposta totes les categories de la base de dades
			$this->response(json_encode($this->model_principal->obtenir_totes_categories()), API_Controller::HTTP_OK);
		}else if($this->get('autor') != NULL){ 

            //dona com a resposta el nom d'un autor havent-hi donat anteriorment el seu ID
			$this->response(json_encode($this->model_principal->autor_name($this->get('autor'))), API_Controller::HTTP_OK);
		}else if($this->get('categoria_name') != NULL){ 

            //dona com a resposta el nom d'una categoria que anteriorment s'hagi enviat el seu ID
			$this->response(json_encode($this->model_principal->category_name($this->get('categoria_name'))), API_Controller::HTTP_OK);
		}else if($this->get('privadesa') != NULL){

            //s'obté com a resposta el nom d'una classe, tot donant el seu ID per paràmetre
			$this->response(json_encode($this->model_principal->obtenir_info_classe($this->get('privadesa'))), API_Controller::HTTP_OK);
		}else if($id==NULL && $cat==NULL){

            //obté una llista de tots els recursos
            $this->response(json_encode($this->model_principal->get_tots_recursos()), API_Controller::HTTP_OK);
        }else if($cat==NULL){

            //retorna la informació d'un recurs en concret, amb tota la seva informació
            //només si l'usuari té el permís necessari per veure'l
            if(!isset($token[1])){

                $infoRecurs= $this->model_principal->get_recurs_individual($id)[0];
                $infoRecurs->descripcio= htmlspecialchars_decode($infoRecurs->descripcio);
                if($infoRecurs->privadesa=="public"){
                    
                    $messagePost = [
                        'status' => API_Controller::HTTP_OK,
                        'inforecurs' => json_encode($infoRecurs)
                    ];
                    $this->set_response($messagePost, API_Controller::HTTP_OK);

                }else{
                    echo "no tens permis";
                    die();
                }
            }else{

            
                if ($this->auth_request()) {

                    $infoRecurs= $this->model_principal->get_recurs_individual($id)[0];
                    $infoRecurs->descripcio= htmlspecialchars_decode($infoRecurs->descripcio);

                    $token=explode(" ",$this->head ("Authorization"));
                    $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256')); 


                    if($infoRecurs->privadesa=="public"){
                        //pot entrar tothom
                    }else if($infoRecurs->privadesa=="privat"){
                        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari
                    }else if(is_numeric($infoRecurs->privadesa)){
                        $this->redirectPermisos_recursos_grups($infoRecurs->privadesa, $token_data->usr); //privadesa,user_id
                    }

                    $jwt = $this->renewJWT();

                    $messagePost = [
                        'status' => API_Controller::HTTP_OK,
                        'token' => $jwt,
                        'inforecurs' => json_encode($infoRecurs)
                    ];
                    $this->set_response($messagePost, API_Controller::HTTP_OK);
                }
                else {
                    $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
                }
            }

        }else if($id==NULL){
            $this->response(json_encode($this->model_principal->get_recursos_from_categoria($cat)), API_Controller::HTTP_OK);
        }
    }

    // URL PER ACCEDIR: http://localhost/treball-final-sintesi/api
    // Funció per la API amb el mètode: POST 
    // Variables a afegir: id, nom, cognom, correu i telefon
    // Aquesta funció actualitza el perfil d'usuari amb les noves dades enviades pel formulari
    public function req_post(){

        if ($this->auth_request()) {

            $token=explode(" ",$this->head ("Authorization"));
            $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256'));

            $id = $this->post('id');
            $nom = $this->post('nom');
            $cognom = $this->post('cognom');
            $correu = $this->post('correu');
            $telefon = $this->post('telefon');

            $jwt = $this->renewJWT();


            if($this->model_administrador->editar_perfil($id, $correu, $nom, $cognom, $telefon)){
                $messagePost = [
                    'status' => API_Controller::HTTP_OK,
                    'error' => "Perfil actualitzat correctament.",
                    'token' => $jwt
                ];
                $this->set_response($messagePost, API_Controller::HTTP_OK);
            }else{
                $messagePost = [
                    'status' => API_Controller::HTTP_BAD_REQUEST,
                    'error' => "No s'ha conseguit actualitzar el perfil correctament.",
                    'token' => $jwt
                ];
                $this->set_response($messagePost, API_Controller::HTTP_BAD_REQUEST);
            }

        }

        
    }


    //Aquesta funció no és de la api, només comprova que l'usuari tingui
    //els permisos suficients per entrar a un apartat
    public function redirectPermisos_pagines_ncontroller($permis){

        $permisUserLogged= $this->model_principal->user_group_check($IDUser)[0]->name;

        if($permis=="professor"){
            if($permisUserLogged== "professor" || $permisUserLogged== "admin"){
            }else{
                $this->set_response("No tens permís per accedir al recurs: " . $this->error_message, $this->auth_code);
                die();
            }
        }else if($permis=="admin"){
            if($permisUserLogged== "admin"){
            }else{
                $this->set_response("No tens permís per accedir al recurs: " . $this->error_message, $this->auth_code);
                die();
            }
        }else if($permis=="usuari"){
            if($permisUserLogged== "professor" || $permisUserLogged== "admin" || $permisUserLogged== "alumne"){
            }else{
                $this->set_response("No tens permís per accedir al recurs: " . $this->error_message, $this->auth_code);
                die();
            }
        }
    }

    //Aquesta funció no és de la api, només comprova que l'usuari formi part
    //de la classe que tingui acces al recurs que s'intenta visualitzar.
    public function redirectPermisos_recursos_grups($privadesaRecurs, $IDUser){

        $permisUserLogged= $this->model_principal->user_group_check($IDUser)[0]->name;

        if($permisUserLogged== "professor" || $permisUserLogged== "admin"){
        }else if($permisUserLogged== "alumne"){
            $classesAlumne= $this->model_administrador->get_classes_from_alumne($IDUser);
            $trobat= 0;
            foreach($classesAlumne as $classe){
                if($privadesaRecurs == $classe->id){
                    $trobat= 1;
                }
            }
            if($trobat==0){
                $this->set_response("No tens permís per accedir al recurs: " . $this->error_message, $this->auth_code);
                die();
            }
        }else{
            $this->set_response("No tens permís per accedir al recurs: " . $this->error_message, $this->auth_code);
            die();
        }
        
    }







    public function req_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }



    // Aquesta funció comprova un token passat per paràmetre i mira
    // si l'usuari en questió té permisos per veure un video
    // i li retorna el video en cas afirmatiu
    public function mostrar_video_fitxer_api_get($ruta,$nomfitxer,$token){

        $infoRecursIndividual= $this->model_principal->get_recurs_individual($ruta)[0];
        if($infoRecursIndividual->privadesa=="public"){
            //pot entrar tothom
        }else if($infoRecursIndividual->privadesa=="privat"){
            $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari
        }else if(is_numeric($infoRecursIndividual->privadesa)){
            if($this->ion_auth->logged_in()){
                $this->redirectPermisos_recursos_grups($infoRecursIndividual->privadesa, $this->ion_auth->user()->row()->id); //privadesa,user_id
            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
            
        }

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $video_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type: video/mp4');
        echo $video_path;
        die();
    }


    // Aquesta funció comprova un token passat per paràmetre i mira
    // si l'usuari en questió té permisos per veure una foto
    // i li retorna la foto en cas afirmatiu
    public function mostrar_imatge_fitxer_api_get($ruta,$nomfitxer,$token=NULL){
        
        if($token==NULL){
            $permisUserLogged= "-";
        }else{
            $token_data = JWT::decode($token,$this->config->item('jwt_key'),array('HS256'));
            $permisUserLogged= $this->model_principal->user_group_check($token_data->usr)[0]->name;
        }
        

        $infoRecursIndividual= $this->model_principal->get_recurs_individual($ruta)[0];
        
        if($infoRecursIndividual->privadesa=="public"){ //pot entrar tothom
        }else if($infoRecursIndividual->privadesa=="privat"){
            if($permisUserLogged=="admin" || $permisUserLogged=="professor"){}
            else{ echo "no tens permis"; die(); }
            
        }else if(is_numeric($infoRecursIndividual->privadesa)){
            $this->redirectPermisos_recursos_grups($infoRecursIndividual->privadesa, $token_data->usr); //privadesa,user_id

        }

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $image_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type:image/png');
        echo $image_path;
        die();
    }


    

}