<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jwt_api extends JwtAPI_Controller {
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


        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

    }
    
    // URL PER ACCEDIR: http://localhost/treball-final-sintesi/api2
    // Funció per la API amb el mètode: GET 
    // Variables a afegir: - (només header amb el token)
    // Aquesta funció retorna la informació de l'usuari i una llista amb els seus recursos preferits
    public function index_get(){
		
        if ($this->auth_request()) {

            //en el cas en que s'envii un get amb "perfil" com a variable, es retornarà la informació del perfil
            if($this->input->get('perfil') != null){
                $jwt = $this->renewJWT();
                $token=explode(" ",$this->head ("Authorization"));
                $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256')); 
                $messagePost = [
                    'status' => API_Controller::HTTP_OK,
                    'token' => $jwt,
                    'infousuari' => json_encode($this->model_principal->info_usuari($token_data->usr))
                ];
                $this->set_response($messagePost, API_Controller::HTTP_OK);
            }

            //en el cas en que s'envii un get sense variables, es retornarà una llista amb els seus recursos preferits
            else{
                $jwt = $this->renewJWT();
                $token=explode(" ",$this->head ("Authorization"));
                $token_data = JWT::decode($token[1],$this->config->item('jwt_key'),array('HS256')); 
                $messagePost = [
                    'status' => API_Controller::HTTP_OK,
                    'token' => $jwt,
                    'recursos' => json_encode($this->model_principal->comprovar_preferits($token_data->usr))
                ];
                $this->set_response($messagePost, API_Controller::HTTP_OK);
            }

            

        }
        
        else {
            $this->set_response("Error en l'autenticació amb el token: " . $this->error_message, $this->auth_code);
        }
        
    }

    // URL PER ACCEDIR: http://localhost/treball-final-sintesi/api2
    // Funció per la API amb el mètode: POST 
    // Variables a afegir: username, password
    // Aquesta funció fa login i retorna el token a l'usuari
    public function index_post(){

        $user = $this->post('username');
        $pass = $this->post('password');
        
        $this->login($user, $pass);

        
    }

    



    public function index_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

}