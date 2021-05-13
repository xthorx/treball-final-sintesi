<?php defined('BASEPATH') or exit('No direct script access allowed');

class model_principal  extends CI_Model
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

    public function get_categories($cat){
        $query = $this->db->get_where('categories', array('categoria_pare' => $cat));
        return $query->result();
    }

    public function category_name($cat){
        $this->db->select('nom');
        $query = $this->db->get_where('categories', array('id' => $cat));
        return $query->result();
    }

    public function autor_name($userID){
        $this->db->select('username');
        $query = $this->db->get_where('users', array('id' => $userID));
        return $query->result();
    }

    public function get_recursos_from_categoria($cat){
        $query = $this->db->get_where('recursos', array('categoria' => $cat));
        return $query->result();
    }


    public function insert_recurs($titol,$desc,$categoria,$tipus_recurs,$privadesa){
        
        $user = $this->ion_auth->user()->row();
        $autorres= $user->id;

        $data = array(
            'titol'=>$titol,
            'descripcio'=>$desc,
            'autor'=>$autorres,
            'categoria'=>$categoria,
            'tipus_recurs'=>$tipus_recurs,
            'privadesa'=>$privadesa
            );
        $this->db->insert('recursos',$data);

        $sql = "SELECT LAST_INSERT_ID() AS id_inserted";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_tots_recursos(){
        $query = $this->db->get('recursos');
        return $query->result();
    }

    public function obtenir_totes_categories(){
        $query = $this->db->get('categories');
        return $query->result();
    }


    public function obtenir_tots_tags(){
        $query = $this->db->get('tags');
        return $query->result();
    }

    public function obtenir_info_tag($id){
        $query = $this->db->get_where('tags', array('id' => $id));
        return $query->result();
    }

    public function editar_tag($id,$tagname){
        echo $sql = "UPDATE tags SET tag='$tagname' WHERE id='$id'";
        $query = $this->db->query($sql);
        return true;
    }

    public function insert_tag($nom){

        $data = array(
            'tag'=>$nom
            );
        $this->db->insert('tags',$data);
        return true;
    }

    public function borrar_tag($id){
        echo $sql = "DELETE FROM tags WHERE id='$id'";
        $query = $this->db->query($sql);
        return true;
    }

    


    public function obtenir_info_categoria($id){
        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->result();
    }

    public function editar_categoria($id,$categorianame,$categoriapare){
        echo $sql = "UPDATE categories SET nom='$categorianame', categoria_pare='$categoriapare' WHERE id='$id'";
        $query = $this->db->query($sql);
        return true;
    }

    public function insert_categoria($nom){

        $data = array(
            'nom'=>$nom
            );
        $this->db->insert('categories',$data);
        return true;
    }

    public function borrar_categoria($id){
        echo $sql = "DELETE FROM categories WHERE id='$id'";
        $query = $this->db->query($sql);
        return true;
    }


    public function borrar_recurs($id){
        $this->load->helper("file");

        echo $sql = "DELETE FROM recursos WHERE id='$id'";
        $query = $this->db->query($sql);

        delete_files('./uploads/recurs_' . $id);
        rmdir('./uploads/recurs_' . $id);

        return true;
    }


    public function get_recurs_individual($id){
        $query = $this->db->get_where('recursos', array('id' => $id));
        return $query->result();
    }


    public function editar_recurs($id,$titol,$desc,$categoria,$tipus_recurs,$privadesa){
        echo $sql = "UPDATE recursos SET titol='$titol', descripcio='". htmlspecialchars(nl2br($desc), ENT_QUOTES) ."', categoria='$categoria', tipus_recurs='$tipus_recurs', privadesa='$privadesa' WHERE id='$id'";
        $query = $this->db->query($sql);
        return true;
    }


    
}