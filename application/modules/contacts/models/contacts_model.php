<?php

class Contacts_model extends CI_Model {

    private $table_name = 'contacts';
    private $redirect_url = 'contacts';

    public function __construct() {
        $this->load->database();
    }

    public function get() {
        $query = $this->db->get($this->table_name);
        if (count($query->row_array()) > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function update($id) {
        $data = array(
            'adress' => $this->input->post('adress'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'coords' => mb_substr(mb_substr($this->input->post('coords'), 1, mb_strlen($this->input->post('coords'), 'utf-8'), 'utf-8'), 0, -1),
            'social_text' => $this->input->post('social_text'),
            'social_vk' => $this->input->post('social_vk'),
            'social_fb' => $this->input->post('social_fb'),
            'social_tw' => $this->input->post('social_tw'),
            'social_ok' => $this->input->post('social_ok'),
            'social_insta' => $this->input->post('social_insta')
        );
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

}
