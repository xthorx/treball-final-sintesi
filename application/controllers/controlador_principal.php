<?php defined('BASEPATH') or exit('No direct script access allowed');


require_once(dirname(__FILE__) . "/controlador_redirectpermisos.php");

class controlador_principal  extends controlador_redirectpermisos
{

    public $dataTemp= "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_principal');
        $this->load->model('model_buscador');
        $this->load->model('model_administrador');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('cookie');
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
        
        $result= $this->model_principal->get_categories(0);

        foreach ($result as $row){
            $this->dataTemp .= "<p class='my-0'>-><a href='categoria/".$row->id."'>" . $row->nom . "</a></p>";
            $this->subcategories_show($row->id, 25);
        }
        
        
        $data['title'] = 'Accedeix als recursos de les teves assignatures';
        $data['subtitle'] = 'Et presentem DWTube, on podràs accedir des del teu compte per poder veure<br>tots els continguts de les teves assignatures i realitzar les activitats<br>proposades pel professorat.';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['categoriesList']= $this->dataTemp;


        $data['grup_usuari']= $this->check_user_type();
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

        if($id != null && is_numeric($id)){
            
            $resultCategoriaName= $this->model_principal->category_name($id);
            $data['titleMain'] = 'Categoria: ' . $resultCategoriaName[0]->nom;
            $data['title'] = 'Categoria: ' . $resultCategoriaName[0]->nom;


            $data['categoriaName']= $resultCategoriaName[0]->nom;
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

            $data['recursos_categoria']= $this->model_principal->get_recursos_from_categoria($id);
            
            foreach ($data['recursos_categoria'] as $rec){
                // if($rec->privadesa != "public" && $rec->privadesa != "private"){
                //     echo $data['rec_privadesa'][$rec->id]= $this->model_principal->recurs_privadesa_text($rec->privadesa)[0]->nom;
                // }
                
                $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
            }

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('categoria', $data);
            $this->load->view('templates/footer', $data);

        }else{
            return redirect(base_url());
        }

    }


    public function veure_recursos(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari


        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        $data['title'] = 'Administrador de recursos';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['recursos_categoria']= $this->model_principal->get_tots_recursos();
        

        foreach ($data['recursos_categoria'] as $rec){
            $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
            $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
        }



        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('recursos_llistat', $data);
        $this->load->view('templates/footer', $data);

    }


    public function crear_recurs(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari


        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            // $data['loggedin'] = false;
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
        }

        $data['title'] = 'Crear un recurs nou';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->form_validation->set_rules('titol', 'titol', 'required');
        $this->form_validation->set_rules('descripcio', 'descripcio', 'required');
        $this->form_validation->set_rules('categoria', 'categoria', 'required');
        $this->form_validation->set_rules('tipus_recurs', 'tipus de recurs', 'required');
        $this->form_validation->set_rules('privadesa', 'privadesa', 'required');

        $data['tagslist']= $this->model_principal->obtenir_tots_tags();



        if ($this->form_validation->run() === TRUE)
		{
            $titol = $this->input->post('titol');
            $desc = $this->input->post('descripcio');
            $cat = $this->input->post('categoria');
            echo $tipus = $this->input->post('tipus_recurs');
            $priv = $this->input->post('privadesa');


            if($tipus=="infografia"){

                if ($last_inserted= $this->model_principal->insert_recurs($titol,$desc,$cat,$tipus,$priv)[0]->id_inserted){
                    
                    if (!is_dir('../../uploads/recurs_' . $last_inserted))
                    {
                        mkdir('../../uploads/recurs_' . $last_inserted, 0777, true);
                        $dir_exist = false; // dir not exist
                    }


                    $config = array(
                        'upload_path' => '../../uploads/recurs_' . $last_inserted,
                        'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                        'file_name' => 'infografia'
                    );
                    $this->load->library('upload', $config);

                    if($this->upload->do_upload('infografia')){
                        $uploaded_data = array('upload_data' => $this->upload->data());

                        $file_nameuploaded = $uploaded_data['upload_data']['file_name'];

                        $this->model_principal->set_filename_recurs($last_inserted,$file_nameuploaded);
                    }

                    

                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $file_name = $upload_data['file_name'];


                    if(!empty($this->input->post('check_list'))) {
                        foreach($this->input->post('check_list') as $tag) {
                            $this->model_principal->set_recurs_tag($last_inserted,$tag);
                        }
                    }



                    return redirect(base_url("recursos"));
                }
                else{
                }
            }else if($tipus=="video_arxiu"){

                if ($last_inserted= $this->model_principal->insert_recurs($titol,$desc,$cat,$tipus,$priv)[0]->id_inserted){
                    
                    if (!is_dir('../../uploads/recurs_' . $last_inserted))
                    {
                        mkdir('../../uploads/recurs_' . $last_inserted, 0777, true);
                        $dir_exist = false; // dir not exist
                    }


                    $config = array(
                        'upload_path' => '../../uploads/recurs_' . $last_inserted,
                        'allowed_types' => 'mp4',
                        'file_name' => 'video_arxiu'
                    );
                    $this->load->library('upload', $config);

                    if($this->upload->do_upload('video_arxiu')){
                        $uploaded_data = array('upload_data' => $this->upload->data());

                        $file_nameuploaded = $uploaded_data['upload_data']['file_name'];

                        $this->model_principal->set_filename_recurs($last_inserted,$file_nameuploaded);
                    }

                    if(!empty($this->input->post('check_list'))) {
                        foreach($this->input->post('check_list') as $tag) {
                            $this->model_principal->set_recurs_tag($last_inserted,$tag);
                        }
                    }

                    return redirect(base_url("recursos"));
                }
                else{
                }
            }else if($tipus=="video_youtube"){


                $videoYT = $this->input->post('video_youtube');

                $last_inserted= $this->model_principal->insert_recurs($titol,$desc,$cat,$tipus,$priv)[0]->id_inserted;
                $this->model_principal->set_videoyt_recurs($last_inserted,$videoYT);


                if(!empty($this->input->post('check_list'))) {
                    foreach($this->input->post('check_list') as $tag) {
                        $this->model_principal->set_recurs_tag($last_inserted,$tag);
                    }
                }



                return redirect(base_url("recursos"));


            }else if($tipus=="pissarra"){

                if ($last_inserted= $this->model_principal->insert_recurs($titol,$desc,$cat,$tipus,$priv)[0]->id_inserted){
                    
                    if (!is_dir('../../uploads/recurs_' . $last_inserted))
                    {
                        mkdir('../../uploads/recurs_' . $last_inserted, 0777, true);
                        $dir_exist = false; // dir not exist
                    }


                    file_put_contents('../../uploads/recurs_' . $last_inserted . '/pissarra.png', file_get_contents($this->input->post('pissarra')));

                    $this->model_principal->set_filename_recurs($last_inserted,"pissarra.png");

                    if(!empty($this->input->post('check_list'))) {
                        foreach($this->input->post('check_list') as $tag) {
                            $this->model_principal->set_recurs_tag($last_inserted,$tag);
                        }
                    }

                    // $config = array(
                    //     'upload_path' => '../../uploads/recurs_' . $last_inserted,
                    //     // 'allowed_types' => 'png',
                    //     'file_name' => 'pissarra'
                    // );
                    // $this->load->library('upload', $config);

                    // echo "PISSARRA POST: " .$this->input->post('pissarra');

                    // $pissarraPostBase64 = preg_replace('#data:image/[^;]+;base64,#', '', $this->input->post('pissarra'));

                    // // echo "PISSARRA POST: " .$pissarraPostBase64;



                    // $imgPissarra = imagecreatefromstring(base64_decode($pissarraPostBase64));

                    // // $this->input->post('pissarra')= $imgPissarra;
                    // $_POST['pissarra'] = $imgPissarra;

                    // echo "PISSARRA POST: " .$this->input->post('pissarra');

                    // if($this->upload->do_upload('pissarra')){
                    //     $uploaded_data = array('upload_data' => $this->upload->data());

                    //     $file_nameuploaded = $uploaded_data['upload_data']['file_name'];

                    //     $this->model_principal->set_filename_recurs($last_inserted,$file_nameuploaded);
                    // }

                    return redirect(base_url("recursos"));
                }
                else{
                }

            }



		}
		else
		{

            $data['categoriesList']= $this->model_principal->obtenir_totes_categories();
            $data['classesList']= $this->model_principal->obtenir_totes_classes();

            $data['grup_usuari']= $this->check_user_type();
			$this->load->view('templates/header', $data);
            $this->load->view('crear_recurs', $data);
            $this->load->view('templates/footer', $data);
		}
    }


    public function editar_recursos($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            // $data['loggedin'] = false;
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
        }

        $data['title'] = 'Editar recurs';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->form_validation->set_rules('titol', 'descripcio', 'required');
        $this->form_validation->set_rules('descripcio', 'categoria', 'required');
        $this->form_validation->set_rules('categoria', 'tipus de recurs', 'required');
        $this->form_validation->set_rules('privadesa', 'privadesa', 'required');

        $data['tagslist']= $this->model_principal->obtenir_tots_tags();

        if($id==NULL){

            if ($this->form_validation->run() === TRUE){

                if(!empty($this->input->post('check_list'))){

                    foreach($data['tagslist'] as $tagall){
                        $trobat=0;

                        foreach($this->input->post('check_list') as $tag){
                            if($tagall->id==$tag){
                                $this->model_administrador->set_recurs_tag($this->input->post('id'),$tag);
                                $trobat++;
                            }
                        }

                        if($trobat==0){
                            $this->model_administrador->borrar_tag($this->input->post('id'),$tagall->id);
                        }
                    }
                }else{
                    $this->model_administrador->borrar_tots_tags($this->input->post('id'));
                }


                $id = $this->input->post('id');
                $titol = $this->input->post('titol');
                $desc = $this->input->post('descripcio');
                $cat = $this->input->post('categoria');
                $tipus = $this->input->post('tipus_recurs');
                $priv = $this->input->post('privadesa');


                if ($this->model_principal->editar_recurs($id,$titol,$desc,$cat,$priv)){
                    return redirect(base_url("recursos"));
                }
                else{
                    return redirect(base_url("recursos"));

                }
            }
            else
            {

                // return redirect(base_url("recursos"));
            }
        }else{
            $data['categoriesList']= $this->model_principal->obtenir_totes_categories();
            $data['recursInfo']= $this->model_principal->get_recurs_individual($id);
            $data['classesList']= $this->model_principal->obtenir_totes_classes();

            $data['totsTags']= $this->model_principal->obtenir_tots_tags();
            $data['tagsUsuari']= $this->model_buscador->tags_recurs($id);


            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('editar_recurs', $data);
            $this->load->view('templates/footer', $data);
        }
        

    }

    public function borrar_recursos($id){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        if($id != NULL && is_numeric($id)){
            if ($this->model_principal->borrar_recurs($id)){
                die();
                return redirect(base_url("recursos"));
            }
            else{
                return redirect(base_url("recursos"));
            }
        }

    }   
    


    public function recurs_veure($id){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
            
        }else{
            $data['loggedin'] = false;
            // $this->session->set_flashdata('not_loggedin', "not_loggedin");
            // return redirect(base_url("login"));
            // die();
        }

        $data['title'] = 'Mostrar recurs';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        

        if($id != NULL && is_numeric($id)){

            $data['inforecurs']= $this->model_principal->get_recurs_individual($id)[0];

            

            if($data['inforecurs']->privadesa=="public"){
                //pot entrar tothom
            }else if($data['inforecurs']->privadesa=="privat"){
                $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari
            }else if(is_numeric($data['inforecurs']->privadesa)){
                if($data['loggedin'] == true){
                    $this->redirectPermisos_recursos_grups($data['inforecurs']->privadesa, $this->ion_auth->user()->row()->id); //privadesa,user_id
                }else{
                    $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                    return redirect(base_url(""));
                }
                
            }



            if ($this->input->server('REQUEST_METHOD') === 'POST'){

                if (!is_dir("../../uploads/recurs_$id/fitxers")){
                    mkdir("../../uploads/recurs_$id/fitxers", 0777, true);
                    $dir_exist = false; // dir not exist
                }
                if($this->input->post('arxiuadjuntBorrar') != null){
                    echo $arxiuadjuntBorrar= $this->input->post('arxiuadjuntBorrar');
                    unlink("../../uploads/recurs_$id/fitxers/$arxiuadjuntBorrar");
                    return redirect(base_url("recursos/mostrar/$id"));

                }else{
                    $config['upload_path'] = '../../uploads/recurs_' . $id . '/fitxers/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 1000000;
                    $this->load->library('upload', $config);
            
                    if (!$this->upload->do_upload('fitxerAdjuntAfegir')) {
                        //no s'ha penjat
                        $error = array('error' => $this->upload->display_errors());

                        die();
                        return redirect(base_url("recursos/mostrar/$id"));

                    } else {
                        //s'ha penjat bé!
                        $data = array('image_metadata' => $this->upload->data());
                        return redirect(base_url("recursos/mostrar/$id"));

                    }
                }
            }else{

                if($data['inforecurs']->tipus_recurs=="infografia" || $data['inforecurs']->tipus_recurs=="pissarra"){
                    $data['visitesrecurs']= $this->model_principal->comptar_visites_recurs($id)[0]->visites_img;
                }else{
                    $data['visitesrecurs']= null;
                }
                
                $this->load->helper('directory');
                $data['arxiusadjunts'] = directory_map('../../uploads/recurs_' . $id . '/fitxers');

                $data['categoriarecurs']= $this->model_principal->get_categoria_recurs($id);
                $data['tagsrecurs']= $this->model_buscador->tags_recurs($id);

                if(!$this->ion_auth->in_group("admin") && !$this->ion_auth->in_group("professor")){
                    $data['arxiusadjunts_permis']= "no";
                }else{
                    $data['arxiusadjunts_permis']= "si";
                }

                if($data['loggedin']==true){
                    
                    if(isset($this->model_principal->check_preferit($this->ion_auth->user()->row()->id,$data['inforecurs']->id)[0]->id)){
                        $data['recursPreferit']= "preferit";
                    }else{
                        $data['recursPreferit']= "no";
                    }
                }
                

                $data['grup_usuari']= $this->check_user_type();
                $this->load->view('templates/header', $data);
                $this->load->view('veure_recurs', $data);
                $this->load->view('templates/footer', $data);

            }

            

        }else{
            return redirect(base_url());
        }
    }



    public function recursos_preferits_controlador(){

        $data['inforecurs']= $this->model_principal->get_recurs_individual($this->input->get('recurs'))[0];

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
            
        }else{
            $data['loggedin'] = false;
            // $this->session->set_flashdata('not_loggedin', "not_loggedin");
            // return redirect(base_url("login"));
            // die();
        }


        if($data['inforecurs']->privadesa=="public"){
            //pot entrar tothom
        }else if($data['inforecurs']->privadesa=="privat"){
            $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari
        }else if(is_numeric($data['inforecurs']->privadesa)){
            if($data['loggedin'] == true){
                $this->redirectPermisos_recursos_grups($data['inforecurs']->privadesa, $this->ion_auth->user()->row()->id); //privadesa,user_id
            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
            
        }


        $recursid= $this->input->get('recurs');
        $userid= $this->ion_auth->user()->row()->id;

        if($this->input->get('accio') == "afegir_preferit"){
            $this->model_principal->afegir_preferits($userid,$recursid);
        }else if($this->input->get('accio') == "treure_preferit"){
            $this->model_principal->borrar_preferits($userid,$recursid);
        }


    }


    public function recursos_preferits_llistar(){

        $this->redirectPermisos_pagines_ncontroller("usuari"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }


        $data['title'] = 'Llistat dels teus recursos preferits';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['totsRecursos']= $this->model_principal->comprovar_preferits($this->ion_auth->user()->row()->id);
        

        foreach ($data['totsRecursos'] as $rec){
            $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
            $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
        }



        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('recursos_llistat_public', $data);
        $this->load->view('templates/footer', $data);
    }



    





    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // XXXXXXXXXXXX ADMINISTRACIO DE TAGS XXXXXXXXXXXX
    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function admin_tags(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{

            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }

        $data['title'] = 'Administrador de tags';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['tagsList']= $this->model_principal->obtenir_tots_tags();

        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('administracio/tags', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editar_tag_individual($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
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

                $data['grup_usuari']= $this->check_user_type();
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

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/editar_tag', $data);
            $this->load->view('templates/footer', $data);
        }
    }


    public function crear_tag_individual(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }


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

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/crear_tag', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function borrar_tag($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

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

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }

        $data['title'] = 'Administrador de categories';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['categoriaList']= $this->model_principal->obtenir_totes_categories();


        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('administracio/categories', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editar_categoria_individual($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        
        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
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


            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/editar_categoria', $data);
            $this->load->view('templates/footer', $data);
        }
    }


    public function crear_categoria_individual(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }

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

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/crear_categoria', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function borrar_categoria($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();
        }


        if($id != NULL){
            if ($this->model_principal->borrar_categoria($id)){
                return redirect(base_url("administracio_categories"));
            }
            else{
                return redirect(base_url("administracio_categories"));
            }
        }
    }

    public function pissarra(){ 
        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari
        $this->load->view('pissarra'); 
    }




    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // XXXXXXXXXXXX ADMINISTRACIO DE CLASSES XXXXXXXXXXXX
    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function admin_classes(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }

        $data['title'] = 'Administrador de classes';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['classeList']= $this->model_principal->obtenir_totes_classes();


        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('administracio/classes', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editar_classe_individual($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }


        if($id==NULL){
            $this->form_validation->set_rules('classename', 'nom de la classe', 'required');
            if ($this->form_validation->run() === TRUE){
                $classeid = $this->input->post('classeid');
                $classename = $this->input->post('classename');
                if ($this->model_principal->editar_classe($classeid,$classename)){
                    return redirect(base_url("administracio_classes"));
                }
                else{
                    return redirect(base_url("administracio_classes"));
                }
            }
            else{
                $data['categoriesList']= $this->model_principal->obtenir_totes_categories();

                $data['grup_usuari']= $this->check_user_type();
                $this->load->view('templates/header', $data);
                $this->load->view('administracio/editar_classe', $data);
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
            $data['title'] = 'Administrador de classes';
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
            $data['editarClasse']= $this->model_principal->obtenir_info_classe($id);

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/editar_classe', $data);
            $this->load->view('templates/footer', $data);
        }
    }


    public function crear_classe_individual(){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $this->session->set_flashdata('not_loggedin', "not_loggedin");
            return redirect(base_url("login"));
            die();

            // $data['loggedin'] = false;
        }


        $this->form_validation->set_rules('classename', 'nom de la classe', 'required');
        $data['title']= "Crear una classe";
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        if ($this->form_validation->run() === TRUE){
            $classename = $this->input->post('classename');
            if ($this->model_principal->insert_classe($classename)){
                return redirect(base_url("administracio_classes"));
            }
            else{
                return redirect(base_url("administracio_classes"));
            }
        }
        else{

            $data['grup_usuari']= $this->check_user_type();
            $this->load->view('templates/header', $data);
            $this->load->view('administracio/crear_classe', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function borrar_classe($id=NULL){

        $this->redirectPermisos_pagines_ncontroller("professor"); //professor, admin o usuari

        if($id != NULL){
            if ($this->model_principal->borrar_classe($id)){
                return redirect(base_url("administracio_classes"));
            }
            else{
                return redirect(base_url("administracio_classes"));
            }
        }
    }



    public function recursos_mostrar_public(){

        //HEADER LOGGEDIN VARIABLE
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            $data['usuariLogat_nom']= $this->model_principal->autor_name($this->ion_auth->user()->row()->id)[0]->username;
        }else{
            $data['loggedin'] = false;
        }


        $data['title'] = 'Llistat de tots els recursos';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $data['totsRecursos']= $this->model_principal->get_tots_recursos();
        

        foreach ($data['totsRecursos'] as $rec){
            $data['rec_categoria'][$rec->id]= $this->model_principal->category_name($rec->categoria)[0]->nom;
            $data['rec_autor'][$rec->id]= $this->model_principal->autor_name($rec->autor)[0]->username;
        }



        $data['grup_usuari']= $this->check_user_type();
        $this->load->view('templates/header', $data);
        $this->load->view('recursos_llistat_public', $data);
        $this->load->view('templates/footer', $data);

    }


    

    




    



}