<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class controlador_api extends JwtAPI_Controller {
    public function __construct (){
        parent::__construct ();
        $this->load->model("model_principal");
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


        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
    }
    
    //MOSTRAR LES NOTICIES, TOTES O LA QUE SELECCIONIS
    public function index_get(){


        // GET request
        // http://localhost/treball-final-sintesi/api
        // http://localhost/treball-final-sintesi/api?id=57
        // http://localhost/treball-final-sintesi/api?cat=1

		
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
            $this->response(json_encode($this->model_principal->get_recurs_individual($id)[0]), API_Controller::HTTP_OK);
        }else if($id==NULL){
            $this->response(json_encode($this->model_principal->get_recursos_from_categoria($cat)), API_Controller::HTTP_OK);
        }
		
		

    }

    //CREAR UNA NOTICIA NOVA
    public function index_post(){


        if($this->post('title')!=NULL){

            // CREAR NOTICIA
            // PARÀMETRES NECESSARIS DEL POST EN CAS DE VOLER CREAR UNA NOTICIA: title, text
            // AMB UN HEADER AMB: Authorization: Bearer XX-TOKEN-XX  

            $title = $this->post('title');
            $text = $this->post('text');

            if ($this->auth_request()) {

                $jwt = $this->renewJWT();

                if ($this->News_model->set_newsparams($title,$text)){
                    $this->set_response("Noticia afegida correctament.", API_Controller::HTTP_CREATED);
                }
                
                else {
                    $this->set_response("Error en publicar la noticia.", API_Controller::HTTP_BAD_REQUEST);
                }

            }
            
            else {
                $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
            }


        }else{

            // LOGIN NOMÉS (per obtenir la token)
            // PARÀMETRES NECESSARIS DEL POST EN CAS DE VOLER DEMANAR EL TOKEN: username, password

            $user = $this->post('username'); //administrator
            $pass = $this->post('password'); //password
            
            $this->login($user, $pass);
        }

        
    }

    public function index_delete(){

        // BORRAR NOTICIA
        // PARÀMETRES NECESSARIS DEL DELETE EN CAS DE VOLER BORRAR UNA NOTICIA: id
        // AMB UN HEADER AMB: Authorization: Bearer XX-TOKEN-XX
        

        if ($this->auth_request()) {

            $jwt = $this->renewJWT();

            $id= $this->delete('id');

            if($this->News_model->delete_news($id)){

                $this->set_response("Noticia borrada correctament.", API_Controller::HTTP_OK);

            }

        }
        
        else {
            $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
        }

    }

    public function index_put(){

        // ACTUALITZAR NOTICIA
        // PARÀMETRES NECESSARIS DEL PUT EN CAS DE VOLER CREAR UNA NOTICIA: id, title, text
        // AMB UN HEADER AMB: Authorization: Bearer XX-TOKEN-XX  

        $id = $this->put('id');
        $title = $this->put('title');
        $text = $this->put('text');

        if ($this->auth_request()) {

            $jwt = $this->renewJWT();

            if ($this->News_model->edit_news_params($id,$title,$text)){
                $this->set_response("Noticia actualitzada correctament.", API_Controller::HTTP_CREATED);
            }
            
            else {
                $this->set_response("Error en actualitzar la noticia.", API_Controller::HTTP_BAD_REQUEST);
            }

        }
        
        else {
            $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
        }

        
    }



    public function index_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }


    

}