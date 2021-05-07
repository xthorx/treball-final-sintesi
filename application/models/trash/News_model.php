<!-- <?php defined('BASEPATH') or exit('No direct script access allowed');

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

    public function get_news_byid($id = FALSE)
    {
        if ($id === FALSE) {
            // SELECT * FROM news
            $query = $this->db->get('news');
            return $query->result_array();
        }
        // SELECT * FROM news WHERE id='$id'
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function get_news_page($page)
    {
        $this->db->limit(10, $page);
        $query = $this->db->get('news');
        return $query->result_array();
    }

    public function get_news_num()
    {
        $query = $this->db->get('news');
        return $query->num_rows();
    }

    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }

    public function set_newsparams($title,$text)
    {
        $this->load->helper('url');

        $slug = url_title($title, 'dash', TRUE);

        $data = array(
            'title' => $title,
            'slug' => $slug,
            'text' => $text
        );

        return $this->db->insert('news', $data);
    }

    public function delete_news($id = FALSE)
    {
        $query = $this->db->delete('news', array('id' => $id));
        return true;

    }

    public function edit_news()
    {

        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('news', $data);

        // redirect(site_url('site'));


    }

    public function edit_news_params($id,$title,$text)
    {

        $data = array(
            'title' => $title,
            'text' => $text
        );
        $this->db->where('id', $id);
        $this->db->update('news', $data);

        return true;


    }
}

/* End of file News_model.php */ -->