<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doors_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
    }

    public function getLastActions(){
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
        $this->db->limit(20);
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where('x.x_hist_type',35);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $deny = $query->result_array();
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
        $this->db->limit(20);
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where('x.x_hist_type',68);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $allow = $query->result_array();

        $all = array_merge($deny,$allow);
        return $all;
    }

}