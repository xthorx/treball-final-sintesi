<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_administrador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function select_all_users(){
        $sql = "SELECT users.id, users.username, users.email, groups.description, groups.id AS group_id, users.active, users.first_name, users.last_name, users.phone FROM `users`
        INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        GROUP BY users.id";

        $query = $this->db->query($sql);
        return $query->result();

    }


    public function editar_usuari($id, $email, $active, $fname, $lname, $phone, $group){

        $sql = "UPDATE users set email='$email', active='$active', first_name='$fname', last_name='$lname', phone='$phone' WHERE id='$id';";
        $query = $this->db->query($sql);

        $sql = "UPDATE users_groups set group_id='$group' WHERE user_id='$id';";
        $query = $this->db->query($sql);
        return true;

    }


    public function select_groups(){
        $sql = "SELECT * FROM groups";
        $query = $this->db->query($sql);
        return $query->result();

    }

    public function select_user_info($id){
        $sql = "SELECT * FROM users WHERE id='$id'";
        $query = $this->db->query($sql);
        return $query->result();

    }
    
    
    
}