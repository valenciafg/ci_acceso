<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('doors_model');
    }
    public function index(){
        $dactions = $this->doors_model->getLastActions();
        $data['door_actions'] = $dactions;
        $this->load->view('dashboard/main',$data);
    }

}
