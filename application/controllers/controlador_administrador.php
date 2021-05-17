<?php defined('BASEPATH') or exit('No direct script access allowed');

class controlador_administrador  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_principal');
        $this->load->model('model_administrador');

        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        
    }

    public function usuaris_administracio(){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['title'] = 'Crear un recurs nou';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['infoUsers']= $this->model_administrador->select_all_users();

        $this->load->view('templates/header', $data);
        $this->load->view('admin_usuaris', $data);
        $this->load->view('templates/footer', $data);

        
    }

    



}