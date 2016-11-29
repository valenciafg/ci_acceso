<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
        
    }
    public function getAllSettings(){
    	$this->db->db_select("ControlMeru");
    	$query = $this->db->get('prueba');
    	$result = $query->result_array();
        return $result;
    }
}