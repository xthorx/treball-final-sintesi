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


        if ($this->input->server('REQUEST_METHOD') === 'POST'){


            // editar_usuari($id, $email, $active, $fname, $lname, $phone)

            $this->model_administrador->editar_usuari($this->input->post('submitNewEntry'), $this->input->post('inputemail'), 
            $this->input->post('inputact'), $this->input->post('inputfname'), $this->input->post('inputlname'), 
            $this->input->post('inputphone'), $this->input->post('inputdesc'));



            return redirect(base_url("admin/usuaris"));
        }



        $data['title'] = 'Administrador de usuaris';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['infoUsers']= $this->model_administrador->select_all_users();
        $data['allGroups']= $this->model_administrador->select_groups();

        $this->load->view('templates/header', $data);
        $this->load->view('admin_usuaris', $data);
        $this->load->view('templates/footer', $data);

        
    }


    public function editar_perfil(){

        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        


        $data['title'] = 'Gestió del perfil';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['infoPerfil']= $this->model_administrador->select_user_info($this->ion_auth->user()->row()->id)[0];

        $this->load->view('templates/header', $data);
        $this->load->view('perfil', $data);
        $this->load->view('templates/footer', $data);

        
    }

    public function canviar_contrasenya(){
        
        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['title'] = 'Canviar la contrasenya';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->form_validation->set_rules('contra_vella', 'contrasenya vella', 'required');
        $this->form_validation->set_rules('contra_nova1', 'contrasenya nova 1', 'required');
        $this->form_validation->set_rules('contra_nova2', 'contrasenya nova 2', 'required');
               

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('contrasenya', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {   

            if($this->input->post('contra_nova1') != $this->input->post('contra_nova2')){
                $this->session->set_flashdata('message', "La contrasenya no s'ha canviat. Les contrasenyes no son iguals.");
                return redirect(base_url("contrasenya"));
                die();
            }

            $usr=$this->ion_auth->user()->row();
            $data = array(
                'password' => $this->input->post('contra_nova1')
            );

            $nomUsuari= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;

            if($this->ion_auth->login($nomUsuari, $this->input->post('contra_vella'))){
                if($this->ion_auth->update($usr->id, $data)){
                    $this->session->set_flashdata('message', "La contrasenya s'ha canviat correctament.");
                    return redirect(base_url("contrasenya"));

                }else{
                    $this->session->set_flashdata('message', "La contrasenya no s'ha canviat. " . $this->ion_auth->errors());
                    return redirect(base_url("contrasenya"));

                }
            }else{
                $this->session->set_flashdata('message', "La contrasenya no s'ha canviat. Has introduït la contrasenya anterior incorrectament.". $this->ion_auth->errors());
                return redirect(base_url("contrasenya"));

            }

        }



        
    }


    public function canviar_contrasenya_admin($id=NULL){


        // HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['title'] = 'Administració: Canviar la contrasenya';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->form_validation->set_rules('contra_nova1', 'contrasenya nova 1', 'required');
        $this->form_validation->set_rules('contra_nova2', 'contrasenya nova 2', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['usuariContra']= $this->model_principal->autor_name($id)[0]->username;

            $this->load->view('templates/header', $data);
            $this->load->view('administracio/nova_contrasenya_admin', $data);
            $this->load->view('templates/footer', $data);
        }
        else
        {

            if($this->input->post('contra_nova1') != $this->input->post('contra_nova2')){
                $this->session->set_flashdata('message', "La contrasenya no s'ha canviat. Les contrasenyes no son iguals.");
                return redirect(base_url("contrasenya_admin/" . $id));
                die();
            }


            $data = array(
                'password' => $this->input->post('contra_nova1')
            );

            if($this->ion_auth->update($id, $data)){
                $this->session->set_flashdata('message', "La contrasenya s'ha canviat correctament.");
                return redirect(base_url("contrasenya_admin/" . $id));

            }else{
                $this->session->set_flashdata('message', "La contrasenya no s'ha canviat. " . $this->ion_auth->errors());
                return redirect(base_url("contrasenya_admin/" . $id));

            }
        }
    }


    public function borrar_usuari($id=NULL){




        
    }


    

    



}