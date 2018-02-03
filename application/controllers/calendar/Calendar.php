<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index(){
    	$profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['profile'] = $profile;
        $this->load->view('calendar/calendar', $data);
    }
}
