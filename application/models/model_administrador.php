<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_administrador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function select_all_users(){
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
        return $query->result();
    }

    
}