<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doors extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('doors_model');
    }
    public function index(){
//        $dactions = $this->doors_model->getLastActions();
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
    public function schedule(){
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
}
