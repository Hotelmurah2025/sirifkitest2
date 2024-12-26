<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
        
        // CORS headers for all methods
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        
        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    public function users($id = null) {
        $method = $_SERVER['REQUEST_METHOD'];
        
        switch($method) {
            case 'GET':
                if ($id === null) {
                    $users = $this->user_model->get_all();
                    $this->output
                        ->set_content_type("application/json")
                        ->set_output(json_encode($users));
                } else {
                    $user = $this->user_model->get_user($id);
                    if ($user) {
                        $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode($user));
                    } else {
                        $this->output
                            ->set_status_header(404)
                            ->set_content_type("application/json")
                            ->set_output(json_encode(['status' => 'error', 'message' => 'User not found']));
                    }
                }
                break;
                
            case 'POST':
                $input = json_decode(file_get_contents('php://input'), true);
                
                $this->form_validation->set_data($input);
                $this->form_validation->set_rules('name', 'Name', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
                
                if ($this->form_validation->run() === FALSE) {
                    $this->output
                        ->set_status_header(400)
                        ->set_content_type("application/json")
                        ->set_output(json_encode([
                            'status' => 'error',
                            'message' => validation_errors()
                        ]));
                    return;
                }
                
                $id = $this->user_model->create_user($input);
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode([
                        'status' => 'success',
                        'message' => 'User created successfully',
                        'id' => $id
                    ]));
                break;
                
            case 'PUT':
                if ($id === null) {
                    $this->output
                        ->set_status_header(400)
                        ->set_content_type("application/json")
                        ->set_output(json_encode(['status' => 'error', 'message' => 'No user ID provided']));
                    return;
                }
                
                $input = json_decode(file_get_contents('php://input'), true);
                
                $this->form_validation->set_data($input);
                $this->form_validation->set_rules('name', 'Name', 'required|trim');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
                
                if ($this->form_validation->run() === FALSE) {
                    $this->output
                        ->set_status_header(400)
                        ->set_content_type("application/json")
                        ->set_output(json_encode([
                            'status' => 'error',
                            'message' => validation_errors()
                        ]));
                    return;
                }
                
                $success = $this->user_model->update_user($id, $input);
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode([
                        'status' => $success ? 'success' : 'error',
                        'message' => $success ? 'User updated successfully' : 'Failed to update user'
                    ]));
                break;
                
            case 'DELETE':
                if ($id === null) {
                    $this->output
                        ->set_status_header(400)
                        ->set_content_type("application/json")
                        ->set_output(json_encode(['status' => 'error', 'message' => 'No user ID provided']));
                    return;
                }
                
                $success = $this->user_model->delete_user($id);
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode([
                        'status' => $success ? 'success' : 'error',
                        'message' => $success ? 'User deleted successfully' : 'Failed to delete user'
                    ]));
                break;
        }
    }
}
