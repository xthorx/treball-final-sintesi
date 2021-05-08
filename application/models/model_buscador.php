<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_buscador  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function buscar_recurs($text){
        echo $sql = "SELECT * FROM recursos WHERE titol LIKE '%{$text}%' OR descripcio LIKE '%{$text}%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function buscar_recurs_avancat($text,$tag){
        $sql = "SELECT * FROM `recursos` INNER JOIN `tags_recursos` ON `recursos`.`id` = `tags_recursos`.`id_recurs`
        INNER JOIN `tags` ON `tags_recursos`.`id_tag` = `tags`.`id`
        WHERE (id_tag LIKE $tag AND titol LIKE '%{$text}%' OR descripcio LIKE '%{$text}%')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    
}