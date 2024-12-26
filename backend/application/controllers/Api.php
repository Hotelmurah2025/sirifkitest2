<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
    }

    public function users() {
        $users = $this->user_model->get_all();
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($users));
    }
}
