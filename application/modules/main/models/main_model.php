<?php

class Main_model extends CI_Model {

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

}
