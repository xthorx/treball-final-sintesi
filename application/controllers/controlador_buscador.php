<?php defined('BASEPATH') or exit('No direct script access allowed');

class controlador_buscador  extends CI_Controller
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

    public function buscar_titol_desc(){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $this->form_validation->set_rules('categorianame', 'nom de la categoria', 'required');
        $data['title']= "Buscador de recursos";
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        if ($this->form_validation->run() === TRUE){
            $categorianame = $this->input->post('categorianame');
            if ($this->model_principal->insert_categoria($categorianame)){
                return redirect(base_url("administracio_categories"));
            }
            else{
                return redirect(base_url("administracio_categories"));
            }
        }
        else{
            $this->load->view('templates/header', $data);
            $this->load->view('buscador', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    



}