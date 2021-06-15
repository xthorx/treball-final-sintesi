<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_buscador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function buscar_recurs($text){
        // echo $sql = "SELECT * FROM `recursos` LEFT JOIN `tags_recursos` ON `recursos`.`id` = `tags_recursos`.`id_recurs`
        // LEFT JOIN `tags` ON `tags_recursos`.`id_tag` = `tags`.`id`
        // WHERE (titol LIKE '%{$text}%' OR descripcio LIKE '%{$text}%') GROUP BY recursos.id";
        $sql = "SELECT * FROM recursos WHERE titol LIKE '%{$text}%' OR descripcio LIKE '%{$text}%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function buscar_recurs_avancat($text,$tag){
        $sql = "SELECT recursos.id, recursos.titol, recursos.tipus_recurs, tags.tag, recursos.categoria, recursos.autor FROM `recursos` INNER JOIN `tags_recursos` ON `recursos`.`id` = `tags_recursos`.`id_recurs`
        INNER JOIN `tags` ON `tags_recursos`.`id_tag` = `tags`.`id`
        WHERE id_tag LIKE $tag AND (titol LIKE '%{$text}%' OR descripcio LIKE '%{$text}%') GROUP BY recursos.id";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function tags_recurs($idrecurs){

        $sql = "SELECT tags.id, tags.tag FROM `recursos` LEFT JOIN `tags_recursos` ON `recursos`.`id` = `tags_recursos`.`id_recurs` LEFT JOIN `tags` ON `tags_recursos`.`id_tag` = `tags`.`id` WHERE (recursos.id LIKE $idrecurs)";
        $query = $this->db->query($sql);
        return $query->result();



    }

    
}