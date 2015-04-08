<?php

class Search_model extends CI_Model {

    private $table_name = 'news';
    private $images_table = 'news_images';
    private $redirect_url = 'news';

    public function __construct() {
        $this->load->database();
    }

    public function order($id, $direction) {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        $category = $query->row_array();
        $order = $category['order'];
        if ($direction == 'up') {
            $order++;
        } elseif ($direction == 'down') {
            $order--;
        }
        $data = array(
            'order' => $order,
        );

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        redirect('admin/' . $this->redirect_url);
    }

    public function get3news_for_front() {
        $this->db->order_by('order', 'desc');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get_where($this->table_name, array('active' => 'on'), 3);
        return $query->result_array();
    }

    public function get_by_url($url) {
        $query = $this->db->get_where($this->table_name, array('active' => 'on', 'url' => $url));
        return $query->row_array();
    }

    public function get_blogs($id = null) {
        if ($id) {
            $query = $this->db->get_where($this->table_name, array('id' => $id));
            return $query->row_array();
        }
        $this->db->order_by('order', 'desc');
        $query = $this->db->get($this->table_name);
        if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_tags($page_id) {
        if ($page_id) {
            $query = $this->db->get_where('tags', array('page_id' => $page_id, 'object' => 'blog'));
            return $query->result_array();
        }
    }

    public function set($image) {
        date_default_timezone_set('Asia/Bishkek');
        if ($this->input->post('date')) {
            $date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
        } else {
            $date = date('Y-m-d H:i:s', time());
        }
        $data = array(
            'name' => $this->input->post('name'),
            'url' => $this->input->post('url'),
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc'),
            'keyw' => $this->input->post('keyw'),
            'text' => $this->input->post('text'),
            'date' => $date,
            'active' => $this->input->post('active'),
            'image' => $image
        );

        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

    public function update($id, $image = null) {
        if (!$image) {
            $data = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
                'text' => $this->input->post('text'),
                'date' => date('Y-m-d H:i:s', strtotime($this->input->post('date'))),
                'active' => $this->input->post('active')
            );
            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc'),
                'keyw' => $this->input->post('keyw'),
                'text' => $this->input->post('text'),
                'date' => date('Y-m-d H:i:s', strtotime($this->input->post('date'))),
                'active' => $this->input->post('active'),
                'image' => $image
            );

            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        }
    }

    protected function search_query($query) {
        $query_search = '';
        $arraywords = explode(' ', $query);
        foreach ($arraywords as $key => $value) {
            if (isset($arraywords[$key - 1]))
                $query_search .= ' OR ';
            $query_search .= '`a.name` LIKE "%' . $value . '%" OR `b.name` LIKE "%' . $value .'%" OR `a.text` LIKE "%' . $value . '%"'.' OR `b.text` LIKE "%' . $value . '%"';
        }
        $query = "SELECT * FROM goods AS a,accessors AS b WHERE $query_search";
        return $query;
    }

    public function get($q) {

        $query = $this->db->query($this->search_query($q));
        if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}
