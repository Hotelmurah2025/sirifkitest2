<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Base configuration
$config['base_url'] = '';
$config['index_page'] = '';
$config['uri_protocol'] = 'REQUEST_URI';
$config['allowed_origins'] = array('http://localhost:5173');

// Logging configuration
$config['log_threshold'] = 1;
$config['log_path'] = APPPATH . 'logs/';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';

// Error reporting
$config['display_errors'] = TRUE;
$config['log_errors'] = TRUE;
$config['error_reporting'] = E_ALL;

// System configuration
$config['charset'] = 'UTF-8';
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

// Security configuration
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
