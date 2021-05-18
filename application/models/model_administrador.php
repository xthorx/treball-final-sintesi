<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_administrador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function select_all_users(){
        $sql = "SELECT users.id, users.username, users.email, groups.description, users.active, users.first_name, users.last_name, users.phone FROM `users`
        INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        GROUP BY users.id";

        $query = $this->db->query($sql);
        return $query->result();

    }

    
}