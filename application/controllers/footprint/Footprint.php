<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footprint extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('footprint_model');
    }
    public function index(){
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
    public function users(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['footprint_users'] = $this->footprint_model->getAllUsers();
        $this->load->view('footprint/users',$data);
    }
    public function search(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['departments'] = $this->footprint_model->getAllDepartment();
        $data['employees'] = $this->footprint_model->getEmployees();
        // $data['footprint_users'] = $this->footprint_model->getAllUsers();
        $this->load->view('footprint/searchFootprint',$data);
    }
    public function searchDepartment(){
        $returnAjax = $this->input->post('returnAjax');
        $department = $this->input->post('department');
        $company = $this->input->post('company');
        $args['company'] = ($company != null)? $company : '26343';
        if($department != null){
            $args['department'] = $department;
        }
        $response = $this->footprint_model->getAllDepartment($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchEmployees(){
        $department = $this->input->post('department');
        $company = $this->input->post('company');
        $returnAjax = $this->input->post('returnAjax');
        $args['company'] = ($company != null)? $company : '26343';
        if($department != null){
            $args['department'] = $department;
        }
        $response = $this->footprint_model->getEmployees($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchFootprint(){
        $error = false;
        $msg = '';
        $today = date('Y-m-d');
        $first = '00:00:00';
        $end = '23:59:59';
        $start_date = $this->input->post('start_date');
        $start_time = $this->input->post('start_time');
        $start_time = $start_time==''? $first: date('H:i:s',strtotime($start_time));
        
        $end_date = $this->input->post('end_date');
        $end_date = $end_date==''? $today: date('Y-m-d',strtotime($end_date));
        $start_date = $start_date==''? date('Y-m-d', strtotime('-7 days', strtotime($end_date))): date('Y-m-d',strtotime($start_date));

        $end_time = $this->input->post('end_time');
        $end_time = $end_time==''? $end: date('H:i:s',strtotime($end_time));
        
        $start_date = $start_date.' '.$start_time;
        $end_date = $end_date.' '.$end_time;
        $data = [
            'start' => $start_date,
            'end'   => $end_date
        ];
        $department = $this->input->post('department');
        $employee = $this->input->post('employee');
        $args = [
            'start'=>$start_date,
            'end'=>$end_date,
            'employee'=>$employee
        ];
        if($department !== ''){
            $args['department'] = $department;
        }
        $response = $this->footprint_model->getFootprint($args);
        if(!empty($response)){
            $response = $this->setFootprintDataResponse($response);
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function searchPeopleCNE(){
        $returnAjax = $this->input->post('returnAjax');
        $nacionalidad = $this->input->post('nacionalidad');
        $cedula = $this->input->post('cedula');
        $this->load->library('infove');
        $response = $this->infove->obtenerElectorCNE($nacionalidad,$cedula);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchTaxpayerSENIAT(){
        $returnAjax = $this->input->post('returnAjax');
        $rif = $this->input->post('rif');
        $this->load->library('infove');
        $response = $this->infove->obtenerContribuyenteSENIAT($rif);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchIVSS(){
        $returnAjax = $this->input->post('returnAjax');
        $nacionalidad = $this->input->post('nacionalidad');
        $cedula = $this->input->post('cedula');
        $dia = $this->input->post('dia');
        $mes = $this->input->post('mes');
        $anho = $this->input->post('anho');
        $this->load->library('infove');
        $response = $this->infove->obtenerCuentaIVSS($nacionalidad,$cedula,$dia,$mes,$anho);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchDebtCORPOELEC(){
        $returnAjax = $this->input->post('returnAjax');
        $nic = $this->input->post('nic');
        $this->load->library('infove');
        $response = $this->infove->obtenerDeudaCorpoelec($nic);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchDebtCANTV(){
        $returnAjax = $this->input->post('returnAjax');
        $area = $this->input->post('area');
        $tlf = $this->input->post('tlf');
        $this->load->library('infove');
        $response = $this->infove->obtenerDeudaCANTV($area,$tlf);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchTrackingZoom(){
        $returnAjax = $this->input->post('returnAjax');
        $nro = $this->input->post('nro');
        $this->load->library('infove');
        $response = $this->infove->obtenerSeguimientoZOOM($nro);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function setFootprintDataResponse($data){
        $logs = [];
        for($i = 0; $i < count($data) -1; $i++){
            $sw = false;
            for($j = $i + 1; $j < count($data); $j++){
                if(date('Y-m-d', strtotime($data[$i]['LOG_TIME'])) == date('Y-m-d', strtotime($data[$i]['LOG_TIME']))){
                    if($data[$i]['LOG_TIME'] > $data[$j]['LOG_TIME']){
                        $row['out'] = $data[$i]['LOG_TIME'];
                        $row['in'] = $data[$j]['LOG_TIME'];
                    }else{
                        $row['out'] = $data[$j]['LOG_TIME'];
                        $row['in'] = $data[$i]['LOG_TIME'];
                    }
                    $row['unix'] = strtotime($data[$i]['LOG_TIME']);
                    $sw = true;
                    $logs[] = $row;
                    $i = $j - 1;
                    break;
                }
            }
            if(!$sw){
                $row['in'] = $data[$i]['LOG_TIME'];
                $row['out'] = '';
                $row['unix'] = strtotime($data[$i]['LOG_TIME']);
                $logs[] = $row;
            }
        }
        return $logs;
    }
}