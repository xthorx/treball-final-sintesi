<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_buscador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function login_user(){
        $query = $this->db->get_where('users', array('username' => $this->input->post('user')));
        return $query->row_array();
    }

    
}