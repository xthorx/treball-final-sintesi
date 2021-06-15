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
    

    public function get_recursos_amount($user_id){

        $sql = "SELECT COUNT(id) AS recnum FROM recursos WHERE autor='$user_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function select_all_alumnes(){
        $sql = "SELECT users.id, users.username, users.email, groups.description, groups.id AS group_id, users.active, users.first_name, users.last_name, users.phone FROM `users`
        INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id`
        INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        WHERE groups.id=2 GROUP BY users.id ";

        $query = $this->db->query($sql);
        return $query->result();

    }


    public function get_classes_from_alumne($id){
        $sql = "SELECT classes.id, classes.nom FROM `users` INNER JOIN `users_groups` ON `users`.`id` = `users_groups`.`user_id` INNER JOIN `groups` ON `users_groups`.`group_id` = `groups`.`id`
        INNER JOIN `alumnes_classes` ON `users`.`id` = `alumnes_classes`.`user_id` INNER JOIN `classes` ON `alumnes_classes`.`classe_id` = `classes`.`id`
        WHERE users.id=$id";

        $query = $this->db->query($sql);
        return $query->result();

    }

    public function set_alumne_classe($idalumne,$idclasse){
        $sql = "SELECT count(id) as idcount  FROM alumnes_classes WHERE user_id = '$idalumne' AND classe_id = '$idclasse'";
        $query = $this->db->query($sql);
        $resultat= $query->result();

        if($resultat[0]->idcount == 0){
            $sql = "INSERT INTO alumnes_classes (user_id, classe_id) VALUES ($idalumne, $idclasse);";
            $query = $this->db->query($sql);
        }
        return true;
    }


    public function borrar_totes_classes($idalumne){
        $sql = "DELETE FROM alumnes_classes WHERE user_id = $idalumne;";
        $query = $this->db->query($sql);
        return true;
    }

    public function borrar_classe($idalumne, $idclasse){
        $sql = "DELETE FROM alumnes_classes WHERE user_id='$idalumne' AND classe_id='$idclasse'";
        $query = $this->db->query($sql);
        return true;
    }


    public function editar_perfil($id, $email, $fname, $lname, $phone){

        $sql = "UPDATE users set email='$email', first_name='$fname', last_name='$lname', phone='$phone' WHERE id='$id';";
        $query = $this->db->query($sql);
        return true;

    }




    public function set_recurs_tag($idrecurs,$idtag){
        $sql = "SELECT count(id) as idcount  FROM tags_recursos WHERE id_recurs = '$idrecurs' AND id_tag = '$idtag'";
        $query = $this->db->query($sql);
        $resultat= $query->result();

        if($resultat[0]->idcount == 0){
            $sql = "INSERT INTO tags_recursos (id_recurs, id_tag) VALUES ($idrecurs, $idtag);";
            $query = $this->db->query($sql);
        }
        return true;
    }


    public function borrar_tots_tags($idrecurs){
        $sql = "DELETE FROM tags_recursos WHERE id_recurs = $idrecurs;";
        $query = $this->db->query($sql);
        return true;
    }

    public function borrar_tag($idrecurs, $idtag){
        $sql = "DELETE FROM tags_recursos WHERE id_recurs='$idrecurs' AND id_tag='$idtag'";
        $query = $this->db->query($sql);
        return true;
    }



    public function redirectPermisos_pagines($permis){

        if($permis=="professor"){
            if($this->ion_auth->in_group("professor") || $this->ion_auth->in_group("admin")){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }else if($permis=="admin"){
            if($this->ion_auth->in_group("admin")){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }else if($permis=="usuari"){
            if($this->ion_auth->logged_in()){

            }else{
                $this->session->set_flashdata('message', "No tens permís per entrar aquí.");
                return redirect(base_url(""));
            }
        }

    }









    
    
}