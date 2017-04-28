<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doors extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('doors_model');
    }
    public function index(){
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
    public function schedule(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
    public function permission(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['doors'] = $this->doors_model->getTerminals();
        $this->load->view('doors/permission',$data);
    }
    public function getDoorPermissionsAjax(){
        $id = $this->input->post('id');
        $guid = $this->input->post('guid');        
        $error = true;
        $msg = '';
        $users = $this->doors_model->getTerminalsUsersCanAccess($id);
        if(!empty($users)){
            $error = false;
        }
        $return = array('error'=>$error,'msg'=>$msg,"users"=>$users);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
    public function users(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['door_users'] = $this->doors_model->getUsersWithBadge();
        $this->load->view('doors/users',$data);
    }
    public function getUserAJAX(){
        $error = true;
        $msg = '';
        $users = $this->doors_model->getUsersWithBadge();
        if(!empty($users)){
            $error = false;
        }
        $return = array('error'=>$error,'msg'=>$msg,"users"=>$users);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
    public function doors(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['doors'] = $this->doors_model->getTerminals();
        $this->load->view('doors/doors',$data);
    }
    public function searchEventsBySchedule(){
        $today = date('m-d-Y');
        $first = '00:00:00';
        $end = '23:59:59';
        $error = true;
        $msg = '';
        $start_date = $this->input->post('start_date');
        if(!empty($start_date)){
            $start_date = date("m-d-Y", strtotime($start_date));
        }else{
            $start_date = $today;
        }
        $start_time = $this->input->post('start_time');
        if(!empty($start_time)){
            $start_time = date("H:i:s", strtotime($start_time));
        }else{
            $start_time = $first;
        }
        $start = $start_date.' '.$start_time;

        $end_date = $this->input->post('end_date');
        if(!empty($end_date)){
            $end_date = date("m-d-Y", strtotime($end_date));
        }else{
            $end_date = $today;
        }
        $end_time = $this->input->post('end_time');
        if(!empty($end_time)){
            $end_time = date("H:i:s", strtotime($end_time));
        }else{
            $end_time = $end;
        }
        $end = $end_date.' '.$end_time;

        $events = $this->doors_model->getEventsBySchedule($start,$end);
        if(!empty($events)){
            $error = false;
        }else{
            $msg = "Búsqueda sin resultados";
        }
        $return = array('error'=>$error,'msg'=>$msg,"events"=>$events);
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function getUserTerminalAccess(){
        $error = true;
        $msg = '';
        $user_id = $this->input->post('user_id');
        $guid = $this->input->post('guid');
        $access = $this->doors_model->getUsersTerminalGrants($guid);
        if(!empty($access))
            $error = false;
        $return = array('error'=>$error,'msg'=>$msg,"access"=>$access);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
    public function searchEventByUsersAndAccess(){
        $error = true;
        $msg = '';
        $user_id = $this->input->post('user_id');
        $door_name = $this->input->post('door_name');
        $events = $this->doors_model->getDoorMovByUserAndAccess($user_id,$door_name);
        if(!empty($events)){
            $error = false;
        }else{
            $msg = "Búsqueda sin resultados";
        }
        $return = array('error'=>$error,'msg'=>$msg,"events"=>$events);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
    public function searchEventByDoorAndSchedule(){
        $error = true;
        $msg = '';
        $events = [];
        $today = date('m-d-Y');
        $first = '00:00:00';
        $end = '23:59:59';
        $door_id = $this->input->post('door_id');
        $door_name = $this->input->post('door_name');
        $door_guid = $this->input->post('door_guid');
        $start_date = $this->input->post('start_date');
        $start_time = $this->input->post('start_time');
        $end_date = $this->input->post('end_date');
        $end_time = $this->input->post('end_time');
        if(!empty($door_id)&&!empty($door_name)) {
            if(!empty($start_date)) {
                if(!empty($start_time)) {
                    if(empty($end_date))
                        $end_date = $start_date;
                    if(empty($end_time))
                        $end_time = $end;
                }else{
                    $start_time = $first;
                    if(empty($end_date))
                        $end_date = $start_date;
                    if(empty($end_time))
                        $end_time = $end;
                }
                $start_date = date("m-d-Y", strtotime($start_date));
                $start_time = date("H:i:s", strtotime($start_time));
                $start = $start_date.' '.$start_time;
                $end_date = date("m-d-Y", strtotime($end_date));
                $end_time = date("H:i:s", strtotime($end_time));
                $end = $end_date.' '.$end_time;
                $events = $this->doors_model->getDoorMovByDoorNameAndSchedule($door_name,$start,$end);
            }else{
                $events = $this->doors_model->getDoorMovByDoorName($door_name);
            }
        }
        if(!empty($events))
            $error = false;
        else{
            $msg = "Búsqueda sin resultados";
        }
        $return = array('error'=>$error,'msg'=>$msg,"events"=>$events);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
}
