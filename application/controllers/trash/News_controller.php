<?php defined('BASEPATH') or exit('No direct script access allowed');

class News_controller  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
        $this->load->library('session');

        $this->load->library('Pdf');
    }

    public function index($page= NULL)
    {
        //PAGINA SI SELECCIONADA
        if($page != NULL){

            $data['news'] = $this->news_model->get_news_page($page);
            $data['titleMain'] = 'Gestor de notícies';
            $data['title'] = 'Mostrar les notícies';
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
            
            if(isset($this->session->user)){
                $data['sessioIniciada'] = "Si, " . $this->session->user;
            }else{
                $data['sessioIniciada'] = "NO";
            }

            $this->load->library('pagination');

            $config['base_url'] = base_url("news/page/");
            $config['total_rows'] = $this->news_model->get_news_num();
            $config['per_page'] = 10;

            $this->pagination->initialize($config);
            $data['pagination_final']= $this->pagination->create_links();
            

            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer', $data);


        }else{

            $data['news'] = $this->news_model->get_news();
            $data['titleMain'] = 'Gestor de notícies';
            $data['title'] = 'Mostrar les notícies';
            $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
            
            if(isset($this->session->user)){
                $data['sessioIniciada'] = "Si, " . $this->session->user;
            }else{
                $data['sessioIniciada'] = "NO";
            }

            $this->load->library('pagination');

            $config['base_url'] = base_url("news/page/");
            $config['total_rows'] = $this->news_model->get_news_num();
            $config['per_page'] = 10;

            $this->pagination->initialize($config);
            $data['pagination_final']= $this->pagination->create_links();
            

            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer', $data);

        }
    }

    //noticies individuals
    public function view($slug = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item'])) {
            show_404();
        }

        $data['titleMain'] = 'Gestor de notícies';
        $data['title'] = $data['news_item']['title'];
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        
        if(isset($this->session->user)){
            $data['sessioIniciada'] = "Si, " . $this->session->user;
        }else{
            $data['sessioIniciada'] = "NO";
        }

        
        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['titleMain'] = 'Gestor de notícies';
        $data['title'] = 'Create a news item';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['missatge'] = '* Tots els camps son obligatoris';
        
        if(isset($this->session->user)){
            $data['sessioIniciada'] = "Si, " . $this->session->user;
        }else{
            $data['sessioIniciada'] = "NO";
        }
        
        $this->form_validation->set_rules('title', 'El titol es obligatori', 'required');
        $this->form_validation->set_rules('text', 'El text es obligatori', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create',$data);
            $this->load->view('templates/footer',$data);
        } else {
            $this->news_model->set_news();

            $data['missatge'] = 'creada correctament';
            $this->load->view('templates/header', $data);
            $this->load->view('news/create',$data);
            $this->load->view('templates/footer',$data);
            // $this->load->view('news/success');
        }
    }


    public function welcome()
    {
        // $this->load->model('news_model','noticies');
        // $data['news'] = $this->noticies->get_news();

        // $this->load->model('news_model');
        $data['news'] = $this->news_model->get_news();
        $data['titleMain'] = 'Gestor de notícies';
        
        
        
        if(isset($this->session->user)){
            $data['sessioIniciada'] = "Si, " . $this->session->user;
        }else{
            $data['sessioIniciada'] = "NO";
        }
        
        
        $data['title'] = 'Benvingut a la pàgina principal';
        $data['subtitle'] = 'Escull on vols anar...';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';

        $this->load->view('templates/header', $data);
        $this->load->view('benvingut', $data);
        $this->load->view('templates/footer', $data);
    }


    public function delete($id = NULL)
    {
        $this->news_model->delete_news($id);
        return redirect('news');
    }

    public function edit($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['titleMain'] = 'Gestor de notícies';
        $data['title'] = 'Edit a news item';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['missatge'] = '* Tots els camps son obligatoris';
        
        
        if(isset($this->session->user)){
            $data['sessioIniciada'] = "Si, " . $this->session->user;
        }else{
            $data['sessioIniciada'] = "NO";
        }

        $this->form_validation->set_rules('title', 'El titol es obligatori', 'required');
        $this->form_validation->set_rules('text', 'El text es obligatori', 'required');
        
        if ($this->form_validation->run() === FALSE) {

            $consulta = $this->news_model->get_news($slug);

            $data['slug']= $slug;
            $data['title_toEdit']= $consulta['title'];
            $data['text_toEdit']= $consulta['text'];
            $data['id_toEdit']= $consulta['id'];

            $this->load->view('templates/header', $data);
            $this->load->view('news/edit',$data);
            $this->load->view('templates/footer',$data);
        } else {

            $this->news_model->edit_news();

            return redirect('news');
        }
    }


}

/* End of file News_controller.php */