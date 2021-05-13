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

        $this->form_validation->set_rules('busqueda', 'text per buscar', 'required');
        $data['title']= "Buscador de recursos";
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['totsTags']= $this->model_principal->obtenir_tots_tags();

        if ($this->form_validation->run() === TRUE){

            if($this->input->post('tagBuscar') != NULL){
                $busqueda = htmlspecialchars($this->input->post('busqueda'));
                $tagBuscar= $this->input->post('tagBuscar');
                
                if($data['resultatBusquedaTags']= $this->model_buscador->buscar_recurs_avancat($busqueda,$tagBuscar)){
                    foreach ($data['resultatBusquedaTags'] as $rec){
                        $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
                        $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
                    }
                }else{
                    $data['no_resultat']= true;
                }

                
            }else if($this->input->post('tagFiltre') != NULL){

                $data['tagsFiltre']= $this->model_principal->obtenir_tots_tags();

                $busqueda = htmlspecialchars($this->input->post('busqueda'));
                $tag = htmlspecialchars($this->input->post('tagFiltre'));
                $data['busqueda_text']= $busqueda;

                if($data['resultatBusquedaTags']= $this->model_buscador->buscar_recurs_avancat($busqueda,$tag)){
                    foreach ($data['resultatBusquedaTags'] as $rec){
                        $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
                        $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;

                        for($i=0; $i<count($this->model_buscador->tags_recurs($rec->id)); $i++){
                            $data['tags_recurs_list'][$rec->id][$i] = $this->model_buscador->tags_recurs($rec->id)[$i]->tag;
                        }
                    }
                }else{
                    $data['no_resultat']= true;
                }


            }else{

                $data['tagsFiltre']= $this->model_principal->obtenir_tots_tags();

                $busqueda = htmlspecialchars($this->input->post('busqueda'));
                $data['busqueda_text']= $busqueda;

                if($data['resultatBusqueda']= $this->model_buscador->buscar_recurs($busqueda)){
                    foreach ($data['resultatBusqueda'] as $rec){
                        $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
                        $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;

                        for($i=0; $i<count($this->model_buscador->tags_recurs($rec->id)); $i++){
                            $data['tags_recurs_list'][$rec->id][$i] = $this->model_buscador->tags_recurs($rec->id)[$i]->tag;
                        }
                    }
                }else{
                    $data['no_resultat']= true;
                }

                
            }


            $this->load->view('templates/header', $data);
            $this->load->view('buscador', $data);
            $this->load->view('templates/footer', $data);
        }
        else{
            $this->load->view('templates/header', $data);
            $this->load->view('buscador', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    



}