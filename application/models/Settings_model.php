<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
        
    }
    public function getAllSettings(){
    	$this->db->db_select("ControlMeru");
    	$query = $this->db->get('config');
    	$result = $query->result_array();
        return $result;
    }
    public function get_config_row(){
        $rows = $this->getAllSettings();
        $new = array();
        if(!empty($rows)) {
            foreach ($rows as $row) {
                $row['configName'];
                $row['configValue'];
                $new[$row['configName']] = $row['configValue'];
            }
        }
        return $new;
    }
    public function get_config_value($name,$value){
        $this->db->db_select("ControlMeru");
        $this->db->where('configName', $name);
        $this->db->where('configValue', $value);
        $query = $this->db->get('config');
        return ($query->num_rows() > 0 ? $query->row(): FALSE);
    }
    public function get_config_field($name){
        $this->db->db_select("ControlMeru");
        $this->db->where('configName', $name);
        $query = $this->db->get('config');
        return ($query->num_rows() > 0 ? $query->row(): FALSE);
    }

    public function add_config($data){
        $this->db->db_select("ControlMeru");
        $this->db->insert('config', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update_config($configName,$configValue){
        $this->db->db_select("ControlMeru");
        $configValue = (empty($configValue)?"":$configValue);
        $data = array('configValue'=>$configValue);
        $this->db->where('configName', $configName);
        $result = $this->db->update('config', $data);
        return $result;
    }

    public function save_all_config($rows){
        $errors = 0;
        foreach($rows as $row){
            if($this->get_config_field($row['configName'], $row['configValue'])===FALSE){
                $nid = $this->add_config($row);
                if($nid == 0) {
                    $errors++;
                }
            }else{
                $this->update_config($row['configName'],$row['configValue']);
            }
        }
        return $errors;
    }
}