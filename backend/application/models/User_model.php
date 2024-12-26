<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $query = $this->db->get("users");
        return $query->result_array();
    }

    public function create_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function get_user($id) {
        $query = $this->db->get_where('users', ['id' => $id]);
        return $query->row_array();
    }
}
