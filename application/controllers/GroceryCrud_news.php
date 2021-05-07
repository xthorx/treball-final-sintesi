<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroceryCrud_news extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		$this->load->library('session');
	}

	public function _news_output($output = null)
	{

		$data['titleMain'] = 'Gestor de notícies';
        $data['title'] = 'Login';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['missatge'] = '* Tots els camps son obligatoris';

		if(isset($this->session->user)){
            $data['sessioIniciada'] = "Si, " . $this->session->user;

			$this->load->view('templates/header', $data);
			$this->load->view('groceryCrud.php',(array)$output);
			$this->load->view('templates/footer', $data);
        }else{
            $data['sessioIniciada'] = "NO";

			$this->load->view('templates/header', $data);
			$this->load->view('templates/no_logged_in',(array)$output);
			$this->load->view('templates/footer', $data);
        }

		
		
		
	}

	public function index()
	{
		$this->_news_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function news_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('news');
			$crud->set_subject('News');
			$crud->required_fields('id');
			$crud->columns('id','title','slug','text');

			$output = $crud->render();

			$this->_news_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

}
