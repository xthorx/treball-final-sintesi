<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once(dirname(__FILE__) . "/controlador_redirectpermisos.php");

class controlador_fitxers  extends controlador_redirectpermisos
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_buscador');
        $this->load->model('model_principal');

        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        
    }

    public function descarregar_fitxer_adjunt($ruta,$nomfitxer){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            // $data['loggedin'] = false;
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
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


    public function mostrar_video_fitxer($ruta,$nomfitxer){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            // $data['loggedin'] = false;
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
        }

        $video_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type: video/mp4');
        echo $video_path;
        die();
    }


    public function mostrar_imatge_fitxer($ruta,$nomfitxer){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            // $data['loggedin'] = false;
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
        }

        $image_path=file_get_contents('../../uploads/recurs_'.$ruta.'/'. $nomfitxer);
        header('Content-type:image/png');
        echo $image_path;
        die();
    }




    public function test(){
        $this->load->view('test');
    }
    



}