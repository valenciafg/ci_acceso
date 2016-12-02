<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('settings_model');
    }
    public function index(){
        $data['settings'] = $this->settings_model->get_config_row();
        $this->load->view('settings/settings',$data);
    }
    public function saveGeneralAjax(){
        $error = true;
        $msg = '';
        $data = [];
        $general_update_time_active = $this->input->post('general_update_time_active');
        if(isset($general_update_time_active))
            $general_update_time_active = '1';
        else
            $general_update_time_active = '0';
        $general_update_time = $this->input->post('general_update_time');
        $config['configName'] = 'general_update_time_active';
        $config['configValue'] = $general_update_time_active;
        $data[] = $config;
        $config['configName'] = 'general_update_time';
        $config['configValue'] = $general_update_time;
        $data[] = $config;
        $result = $this->settings_model->save_all_config($data);
        if($result>0){
            $msg = "Algunos datos no fueron almacenados";
        }else{
            $error = false;
            $msg = "Datos de configuración almacenados";
        }
        header('Content-Type: application/json');
        echo json_encode(['error'=>$error,'msg'=>$msg]);
    }
}
