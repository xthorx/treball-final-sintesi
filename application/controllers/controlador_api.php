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
    
    //MOSTRAR LES NOTICIES, TOTES O LA QUE SELECCIONIS
    public function req_get(){

        // GET request
        // http://localhost/treball-final-sintesi/api
        // http://localhost/treball-final-sintesi/api?id=57
        // http://localhost/treball-final-sintesi/api?cat=1

        $token=explode(" ",$this->head ("Authorization"));
        // $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256')); 

        
        $id= $this->get('id');
        $cat= $this->get('cat');
		
		if($this->get('categories') != NULL){
			$this->response(json_encode($this->model_principal->obtenir_totes_categories()), API_Controller::HTTP_OK);
		}else if($this->get('autor') != NULL){ 
			$this->response(json_encode($this->model_principal->autor_name($this->get('autor'))), API_Controller::HTTP_OK);
		}else if($this->get('categoria_name') != NULL){ 
			$this->response(json_encode($this->model_principal->category_name($this->get('categoria_name'))), API_Controller::HTTP_OK);
		}else if($this->get('privadesa') != NULL){ 
			$this->response(json_encode($this->model_principal->obtenir_info_classe($this->get('privadesa'))), API_Controller::HTTP_OK);
		}else if($id==NULL && $cat==NULL){
            $this->response(json_encode($this->model_principal->get_tots_recursos()), API_Controller::HTTP_OK);
        }else if($cat==NULL){


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

                    // $token=explode(" ",$this->head ("Authorization"));
                    // $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256')); 

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

    public function req_post(){

        echo $this->post('cmd');
    }



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





    //CREAR UNA NOTICIA NOVA
    // public function index_post(){


    //     if($this->post('title')!=NULL){

    //         // CREAR NOTICIA
    //         // PARÀMETRES NECESSARIS DEL POST EN CAS DE VOLER CREAR UNA NOTICIA: title, text
    //         // AMB UN HEADER AMB: Authorization: Bearer XX-TOKEN-XX  

    //         $title = $this->post('title');
    //         $text = $this->post('text');

    //         if ($this->auth_request()) {

    //             $jwt = $this->renewJWT();

    //             if ($this->News_model->set_newsparams($title,$text)){
    //                 $this->set_response("Noticia afegida correctament.", API_Controller::HTTP_CREATED);
    //             }
                
    //             else {
    //                 $this->set_response("Error en publicar la noticia.", API_Controller::HTTP_BAD_REQUEST);
    //             }

    //         }
            
    //         else {
    //             $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
    //         }


    //     }else{

    //         // LOGIN NOMÉS (per obtenir la token)
    //         // PARÀMETRES NECESSARIS DEL POST EN CAS DE VOLER DEMANAR EL TOKEN: username, password

    //         $user = $this->post('username'); //administrator
    //         $pass = $this->post('password'); //password
            
    //         $this->login($user, $pass);
    //     }

        
    // }



    public function req_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }










    public function descarregar_fitxer_adjunt_api_get($ruta,$nomfitxer,$token){


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
            // $this->session->set_flashdata('not_loggedin', "not_loggedin");
            // return redirect(base_url("login"));
            // die();
        }

        $image_path=file_get_contents('../../uploads/recurs_'.$ruta.'/fitxers/'. $nomfitxer);

        header("Expires: 0");
        header('Pragma: public');
        header("Cache-Control: no-cache private", false);
        header("Content-Description: File Transfer");
        header("Content-disposition: attachment; filename=". $nomfitxer);      
        header("Content-Type: application/force-download");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '. strlen($image_path));
        header('Connection: close');
        ob_clean();
        flush();
        echo $image_path;
        die();
    }


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
            // $this->session->set_flashdata('not_loggedin', "not_loggedin");
            // return redirect(base_url("login"));
            // die();
        }

        $video_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type: video/mp4');
        echo $video_path;
        die();
    }


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
            // $this->session->set_flashdata('not_loggedin', "not_loggedin");
            // return redirect(base_url("login"));
            // die();
        }

        $image_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type:image/png');
        echo $image_path;
        die();
    }


    

}