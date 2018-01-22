<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footprint_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
    }
    public function getAllUsers($args = []){
        $main_db = $this->load->database('main', TRUE);
        $main_db->select('au.*, d.DEPARTMENT_NAME, et.TYPE_NAME, tup.PHOTO');
        $main_db->from('ACCESS_USER as au');
        $main_db->join('DEPARTMENT as d', 'au.DEPARTMENT_CODE = d.DEPARTMENT_CODE', 'left');
        $main_db->join('EMPLOYEE_TYPE as et', 'et.ID = au.EMPLOYEE_TYPE', 'left');
        $main_db->join('TA_USER_PHOTO as tup', 'tup.USER_ID = au.USER_ID', 'left');
        $query = $main_db->get();
    	$result = $query->result_array();
        return $result;
    }
    public function getAllDepartment($args = []){
        $main_db = $this->load->database('main', TRUE);
        $main_db->select('dp.*');
        $main_db->from('DEPARTMENT as dp');
        $main_db->where('1',1);
        if(isset($args['department'])){
            $main_db->where('dp.DEPARTMENT_CODE', $args['department']);
        }
        if(isset($args['company'])){
            $main_db->where('dp.COMPANY_CODE', $args['company']);
        }
        $query = $main_db->get();
    	$result = $query->result_array();
        return $result;
    }
    public function getEmployees($args = ['company'=>'26343']){
        $main_db = $this->load->database('main', TRUE);
        $main_db->select('au.*');
        $main_db->from('ACCESS_USER as au');
        $main_db->where('1',1);
        if(isset($args['department'])){
            $main_db->where('au.DEPARTMENT_CODE', $args['department']);    
        }
        $main_db->where('au.COMPANY_CODE', $args['company']);
        $main_db->where_not_in('au.STATUS',['Inactive','Terminate']);
        $main_db->order_by('au.FIRST_NAME','ASC');
        $query = $main_db->get();
    	$result = $query->result_array();
        return $result;
    }
    public function getFootprint($args = []){
        $main_db = $this->load->database('main', TRUE);
        $main_db->select('*');
        $main_db->from('USER_TIME_LOG utl');
        $main_db->where('1',1);
        if(isset($args['employee'])){
            $main_db->where('utl.USER_ID', $args['employee']);
        }
        $main_db->where('utl.LOG_TIME >=', $args['start']);
        $main_db->where('utl.LOG_TIME <=', $args['end']);
        $main_db->order_by('utl.LOG_TIME','DESC');
        $query = $main_db->get();
    	$result = $query->result_array();
        return $result;
    }
}