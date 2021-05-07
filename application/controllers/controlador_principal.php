<?php defined('BASEPATH') or exit('No direct script access allowed');

class controlador_principal  extends CI_Controller
{

    public $dataTemp= "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_principal');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');

        
    }

    public function pagina_inici(){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['titleMain'] = 'Gestor de notícies';
        
        $result= $this->model_principal->get_categories(0);

        foreach ($result as $row){
            $this->dataTemp .= "<p class='my-0'>-><a href='categoria/".$row->id."'>" . $row->nom . "</a></p>";
            $this->subcategories_show($row->id, 25);
            
        }
        
        
        $data['title'] = 'Benvingut a la pàgina principal';
        $data['subtitle'] = 'Escull on vols anar...';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['categoriesList']= $this->dataTemp;


        


        $this->load->view('templates/header', $data);
        $this->load->view('benvingut', $data);
        $this->load->view('templates/footer', $data);
    }


    public function subcategories_show($idMain, $espai){

        $resultsub= $this->model_principal->get_categories($idMain);

        foreach ($resultsub as $row){
            $this->dataTemp .= "<p class='my-0' style='margin-left: ".$espai."px;'>-><a href='categoria/".$row->id."'>" . $row->nom . "</a></p>";
            $this->subcategories_show($row->id, $espai+25);
        }

        return true;
    }


    public function categoria($id){


        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $result= $this->model_principal->category_name($id);
        $data['titleMain'] = 'Categoria: ' . $result[0]->nom;


        $data['title'] = 'Benvingut a la pàgina principal';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['recursos_categoria']= $this->model_principal->get_recursos_from_categoria($id);
        
        foreach ($data['recursos_categoria'] as $rec){
            $data['rec_categoria']= $this->model_principal->category_name($rec->categoria)[0]->nom;
            $data['rec_autor']= $this->model_principal->autor_name($rec->autor)[0]->username;
        }



        $this->load->view('templates/header', $data);
        $this->load->view('categoria', $data);
        $this->load->view('templates/footer', $data);

    }


    public function veure_recursos(){


        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        $data['title'] = 'Benvingut a la pàgina principal';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['recursos_categoria']= $this->model_principal->get_tots_recursos();
        

        foreach ($data['recursos_categoria'] as $rec){
            $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
            $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
        }




        $this->load->view('templates/header', $data);
        $this->load->view('recursos_llistat', $data);
        $this->load->view('templates/footer', $data);

    }


    public function crear_recurs(){


        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['title'] = 'Crear un recurs nou';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->form_validation->set_rules('titol', 'titol', 'required');
        $this->form_validation->set_rules('descripcio', 'descripcio', 'required');
        $this->form_validation->set_rules('categoria', 'categoria', 'required');
        $this->form_validation->set_rules('tipus_recurs', 'tipus de recurs', 'required');
        $this->form_validation->set_rules('privadesa', 'privadesa', 'required');



        if ($this->form_validation->run() === TRUE)
		{


            $titol = $this->input->post('titol');
            $desc = $this->input->post('descripcio');
            $cat = $this->input->post('categoria');
            $tipus = $this->input->post('tipus_recurs');
            $priv = $this->input->post('privadesa');


			if ($this->model_principal->insert_recurs($titol,$desc,$cat,$tipus,$priv)){
                return redirect(base_url("recursos"));
			}
			else{
			}
		}
		else
		{

            $data['categoriesList']= $this->model_principal->obtenir_totes_categories();


			$this->load->view('templates/header', $data);
            $this->load->view('crear_recurs', $data);
            $this->load->view('templates/footer', $data);
		}



        



    }


    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // XXXXXXXXXXXX ADMINISTRACIO DE TAGS XXXXXXXXXXXX
    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function admin_tags(){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }

        $data['title'] = 'Crear un recurs nou';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['tagsList']= $this->model_principal->obtenir_tots_tags();

        $this->load->view('templates/header', $data);
        $this->load->view('administracio/tags', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editar_tag_individual($id=NULL){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        if($id==NULL){
            $this->form_validation->set_rules('tagname', 'nom del tag', 'required');
            if ($this->form_validation->run() === TRUE){
                $tagid = $this->input->post('tagid');
                $tagname = $this->input->post('tagname');
                if ($this->model_principal->editar_tag($tagid,$tagname)){
                    return redirect(base_url("administracio_tags"));
                }
                else{
                    return redirect(base_url("administracio_tags"));
                }
            }
            else{
                $data['categoriesList']= $this->model_principal->obtenir_totes_categories();
                $this->load->view('templates/header', $data);
                $this->load->view('administracio/editar_tag', $data);
                $this->load->view('templates/footer', $data);
            }
        }else{
            //HEADER LOGGEDIN VARIABLE
            if($this->ion_auth->logged_in()){
                $data['loggedin'] = true;
                $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
            }else{
                $data['loggedin'] = false;
            }
            $data['title'] = 'Editar tag';
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
            $data['editarTag']= $this->model_principal->obtenir_info_tag($id);

            $this->load->view('templates/header', $data);
            $this->load->view('administracio/editar_tag', $data);
            $this->load->view('templates/footer', $data);
        }
    }


    public function crear_tag_individual(){
        $this->form_validation->set_rules('tagname', 'nom del tag', 'required');
        $data['title']= "Crear un tag";
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        if ($this->form_validation->run() === TRUE){
            $tagname = $this->input->post('tagname');
            if ($this->model_principal->insert_tag($tagname)){
                return redirect(base_url("administracio_tags"));
            }
            else{
                return redirect(base_url("administracio_tags"));
            }
        }
        else{

            //HEADER LOGGEDIN VARIABLE
            if($this->ion_auth->logged_in()){
                $data['loggedin'] = true;
                $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
            }else{
                $data['loggedin'] = false;
            }


            $this->load->view('templates/header', $data);
            $this->load->view('administracio/crear_tag', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function borrar_tag($id=NULL){
        if($id != NULL){
            if ($this->model_principal->borrar_tag($id)){
                return redirect(base_url("administracio_tags"));
            }
            else{
                return redirect(base_url("administracio_tags"));
            }
        }
    }



    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // XXXXXXXXXXXX ADMINISTRACIO DE CATEGORIES XXXXXXXXXXXX
    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function admin_categories(){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        // $data['categoriesName'];

        // $data['categoriesList']= $this->model_principal->obtenir_totes_categories();

        // foreach($data['categoriesList'] as $cat){
        //     $data['categoriesName'][$cat->id]= $this->model_principal->obtenir_info_categoria($cat->categoria_pare);
            
        // }

        $data['title'] = 'Crear un recurs nou';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['categoriaList']= $this->model_principal->obtenir_totes_categories();

        $this->load->view('templates/header', $data);
        $this->load->view('administracio/categories', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editar_categoria_individual($id=NULL){

        
        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        if($id==NULL){
            $this->form_validation->set_rules('categorianame', 'nom de la categoria', 'required');
            $this->form_validation->set_rules('categoriapare', 'nom de la categoria', 'required');

            if ($this->form_validation->run() === TRUE){
                $categoriaid = $this->input->post('categoriaid');
                $categorianame = $this->input->post('categorianame');
                $categoriapare = $this->input->post('categoriapare');


                if ($this->model_principal->editar_categoria($categoriaid,$categorianame,$categoriapare)){
                    return redirect(base_url("administracio_categories"));
                }
                else{
                    $this->session->set_flashdata('errorformulari', "error");
                    return redirect(base_url("administracio_categories"));
                }
            }
            else{
                $this->session->set_flashdata('errorformulari', "error");
                return redirect(base_url("administracio_categories"));
            }
        }else{
            
            $data['title'] = 'Editar categoria';
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
            $data['editarCategoria']= $this->model_principal->obtenir_info_categoria($id);
            $data['categoriesList']= $this->model_principal->obtenir_totes_categories();

            $this->load->view('templates/header', $data);
            $this->load->view('administracio/editar_categoria', $data);
            $this->load->view('templates/footer', $data);
        }
    }


    public function crear_categoria_individual(){
        $this->form_validation->set_rules('categorianame', 'nom de la categoria', 'required');
        $data['title']= "Crear una categoria";
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

            //HEADER LOGGEDIN VARIABLE
            if($this->ion_auth->logged_in()){
                $data['loggedin'] = true;
                $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
            }else{
                $data['loggedin'] = false;
            }

            $this->load->view('templates/header', $data);
            $this->load->view('administracio/crear_categoria', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function borrar_categoria($id=NULL){
        if($id != NULL){
            if ($this->model_principal->borrar_categoria($id)){
                return redirect(base_url("administracio_categories"));
            }
            else{
                return redirect(base_url("administracio_categories"));
            }
        }
    }


    



}