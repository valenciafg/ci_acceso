<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('rooms_model');
    }
    public function index(){
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['door_schedule'] = [];
        $this->load->view('doors/schedule',$data);
    }
    public function searchOperators(){
        $error = false;
        $msg = '';
        $id = $this->input->post('id');
        if($id !== ''){
            $args['id'] = $id;
        }        
        $response = $this->rooms_model->getOperators($args);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function operators(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['operators'] = $this->rooms_model->getOperators();
        $this->load->view('rooms/operators',$data);
    }
    public function saveOperatorData(){
        $profile = $this->session->userdata();
        $returnAjax = $this->input->post('returnAjax');
        $codigo = $this->input->post('codigo');
        $departamento = $this->input->post('departamento');
        $departamento = $departamento !== ''?$departamento:'NULL';
        $nombre = $this->input->post('nombre');
        $nombre = $nombre !== ''?$nombre:'NULL';
        $estatus = $this->input->post('estatus');
        $id = $this->input->post('id');
        $args = [
            'id' => $id,
            'codigo' => $codigo,
            'estatus' => $estatus,
            'departamento' => $departamento,
            'nombre' => $nombre,
            'editDate' => date('Y-m-d H:i:s'),
            'editUser' => $profile['user']
        ];
        $response = $this->rooms_model->updateOperator($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    /**
     * Event type section
     */
    public function eventtypes(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['eventtypes'] = $this->rooms_model->getEventTypes();
        $data['availability'] = $this->rooms_model->getRoomAvailability();
        $data['status'] = $this->rooms_model->getRoomStatusRecords();
        $this->load->view('rooms/event-types',$data);
    }
    public function saveEventTypeData(){
        $profile = $this->session->userdata();
        $returnAjax = $this->input->post('returnAjax');
        $codigo = $this->input->post('aet_codigo');
        $descripcion = $this->input->post('aet_description');
        $clasificacion = $this->input->post('aet_clasification');
        $departamento = $this->input->post('aet_departament');
        $disponibilidad = $this->input->post('aet_availability');
        $estatus = $this->input->post('aet_status');
        $args = [
            'eventCode' => $codigo,
            'description' => $descripcion,
            'clasification' => $clasificacion,
            'department' => $departamento,
            'availability' => $disponibilidad,
            'status' => $estatus,
            'createUser' => $profile['user']
        ];
        $response = $this->rooms_model->insertEventType($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function saveEditEventTypeData(){
        $profile = $this->session->userdata();
        $returnAjax = $this->input->post('returnAjax');
        $id = $this->input->post('eet_id');
        $codigo = $this->input->post('eet_codigo');
        $descripcion = $this->input->post('eet_description');
        $clasificacion = $this->input->post('eet_clasification');
        $departamento = $this->input->post('eet_departament');
        $disponibilidad = $this->input->post('eet_availability');
        $estatus = $this->input->post('eet_status');
        $args = [
            'id' => $id,
            'eventCode' => $codigo,
            'description' => $descripcion,
            'clasification' => $clasificacion,
            'department' => $departamento,
            'availability' => $disponibilidad,
            'status' => $estatus,
            'editUser' => $profile['user'],
            'editDate' => date('Y-m-d H:i:s')
        ];
        $response = $this->rooms_model->updateEventType($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function getEvenTypeData(){
        $event = $this->input->post('event');
        $returnAjax = $this->input->post('returnAjax');
        $args = [
            'id' => $event
        ];
        $response = $this->rooms_model->getEvenTypeData($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    /**
     * Room status section
     */
    public function roomstatus(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['rooms'] = $this->getRoomStatus();
        $this->load->view('rooms/room-status',$data);
    }
    public function getRoomStatus(){
        $returnAjax = $this->input->post('returnAjax');
        $args = [];
        $response = $this->rooms_model->getRoomStatus($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function roomStatusScheduledTask(){
        $rooms = $this->rooms_model->getRoomStatus(['availabilityCode'=>5]);
        $sw = false;
        foreach ($rooms as $r) {
            $data = [
                'roomExtension' => $r['PhoneNumber'],
                'roomName' => $r['roomNameCentral'],
                'eventCode' => '106',
                'operatorCode' => '35'
            ];
            $this->rooms_model->insertRoomEvent($data);
            $sw = true;
        }
        header('Content-Type: application/json');
        echo json_encode($sw);
    }
    /**
     * Room events seciton
     */
    public function roomevents(){
        $profile = $this->session->userdata();
        if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }
        $data['operators'] = $this->rooms_model->getOperators();
        $data['rooms'] = $this->rooms_model->getRoom();
        $data['events'] = [];
        $this->load->view('rooms/room-events',$data);
    }
    public function searchroomevents(){
        $returnAjax = $this->input->post('returnAjax');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $room = $this->input->post('room');
        $operator = $this->input->post('operator');
        $args = [
            'start' => $start,
            'end' => $end
        ];
        if($room !== null && $room !== ''){
            $args['room'] = $room;
        }
        if($operator !== null && $operator !== ''){
            $args['operator'] = $operator;
        }
        $response = $this->rooms_model->getRoomEvents($args);
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchAvailability(){
        $returnAjax = $this->input->post('returnAjax');
        $response = $this->rooms_model->getAvailability();
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
    public function searchStatus(){
        $returnAjax = $this->input->post('returnAjax');
        $response = $this->rooms_model->getStatus();
        if($returnAjax != null){
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            return $response;
        }
    }
}