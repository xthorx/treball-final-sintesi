<?php defined('BASEPATH') or exit('No direct script access allowed');

class News_model  extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function get_news($slug = FALSE)
    {
        if ($slug === FALSE) {
            // SELECT * FROM news 
            $query = $this->db->get('news');
            return $query->result_array();
        }
        // SELECT * FROM news WHERE slug='$slug'
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        // $slug = url_title($this->input->post('title'), '_', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}

/* End of file News_model.php */