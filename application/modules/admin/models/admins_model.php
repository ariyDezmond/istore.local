<?php

class Admins_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_user() {
        $query = $this->db->get_where('admins', array('login' => $this->input->post('login'), 'pass' => $this->input->post('pass')));
        if ($query->row_array()) {
            return true;
        } else {
            return false;
        };
    }

    public function delete_tag($id) {
        $this->db->delete('tags', array('id' => $id));
    }

    public function set_tag($tag, $page_id, $object) {
        $tag = addslashes(strip_tags($tag));
        $page_id = addslashes(strip_tags($page_id));
        $object = addslashes(strip_tags($object));
        if ($object && $tag && is_numeric($page_id)) {
            $data = array(
                'name' => $tag,
                'object' => $object,
                'page_id' => $page_id
            );
            $this->db->insert('tags', $data);
        }
    }

}
