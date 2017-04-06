<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('doors_model');
        $this->load->model('settings_model');
    }
    public function index(){
        $dactions = $this->doors_model->getLastActions();
        $data['door_actions'] = $dactions;
        $data['settings'] = $this->settings_model->getAllSettings();
        $this->load->view('dashboard/main',$data);
    }
    public function getLastActionsAJAX(){
        $error = true;
        $msg = '';
        $dactions = $this->doors_model->getLastActions();
        if(!empty($dactions)){
            $error = false;
        }
        $return = array('error'=>$error,'msg'=>$msg,"events"=>$dactions);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
}
