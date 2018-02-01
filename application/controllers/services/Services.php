<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // $this->load->model('rooms_model');
    }
    public function index(){
        /*if(!$profile || count($profile)<2) {
            redirect(base_url() . "login");
            die();
        }*/
        $this->load->view('services/services');
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
}