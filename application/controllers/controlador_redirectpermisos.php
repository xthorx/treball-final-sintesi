<?php defined('BASEPATH') or exit('No direct script access allowed');

class controlador_redirectpermisos  extends CI_Controller
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

    public function check_user_type(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->in_group("admin")){
                $user_type="admin";
            }else if($this->ion_auth->in_group("professor")){
                $user_type="professor";
            }else if($this->ion_auth->in_group("alumne")){
                $user_type="alumne";
            }else{
                $user_type="no";
            }
        }else{
            $user_type="no";
        }

        return $user_type;
    }

    public function redirectPermisos_pagines_ncontroller($permis){

        if($permis=="professor"){
            if($this->ion_auth->in_group("professor") || $this->ion_auth->in_group("admin")){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }else if($permis=="admin"){
            if($this->ion_auth->in_group("admin")){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }else if($permis=="usuari"){
            if($this->ion_auth->logged_in()){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }

    }

    



}