<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doors_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
    }

    /**
     * Get last actions on doors (deny and allow)
     * @return array
     */
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

    /**
     * Get door movements by start and end datetime
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getEventsBySchedule($start,$end){
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where_in('x.x_hist_type',[35,68]);
        $this->db->where('x.x_timestamp >=', $start);
        $this->db->where('x.x_timestamp <=', $end);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getUsersWithBadge(){
        $this->db->select('c.c_id,c.c_fname,c.c_lname,b.b_number_str,b.b_guid');
        $this->db->from('cardholder as c');
        $this->db->join('badge as b', 'c.c_id = b.b_cardholder_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getUsersTerminalGrants($guid){
        $groups = [];
        $this->db->select('bs.*');
        $this->db->from('badgesite as bs');
        $this->db->where('bs.bs_b_guid', $guid);
        $query = $this->db->get();
        $result_ag = $query->result_array();
        if(!empty($result_ag)){
            foreach ($result_ag as $ag){
                $groups[] = $ag['bs_access_grp_0'];
                $groups[] = $ag['bs_access_grp_1'];
                $groups[] = $ag['bs_access_grp_2'];
                $groups[] = $ag['bs_access_grp_3'];
                $groups[] = $ag['bs_access_grp_4'];
                $groups[] = $ag['bs_access_grp_5'];
                $groups[] = $ag['bs_access_grp_6'];
                $groups[] = $ag['bs_access_grp_7'];
                $groups[] = $ag['bs_access_grp_8'];
                $groups[] = $ag['bs_access_grp_9'];
                $groups[] = $ag['bs_access_grp_10'];
                $groups[] = $ag['bs_access_grp_11'];
                $groups[] = $ag['bs_access_grp_12'];
                $groups[] = $ag['bs_access_grp_13'];
                $groups[] = $ag['bs_access_grp_14'];
                $groups[] = $ag['bs_access_grp_15'];
                $groups[] = $ag['bs_access_grp_16'];
                $groups[] = $ag['bs_access_grp_17'];
                $groups[] = $ag['bs_access_grp_18'];
                $groups[] = $ag['bs_access_grp_19'];
                $groups[] = $ag['bs_access_grp_20'];
                $groups[] = $ag['bs_access_grp_21'];
                $groups[] = $ag['bs_access_grp_22'];
                $groups[] = $ag['bs_access_grp_23'];
                $groups[] = $ag['bs_access_grp_24'];
                $groups[] = $ag['bs_access_grp_25'];
                $groups[] = $ag['bs_access_grp_26'];
                $groups[] = $ag['bs_access_grp_27'];
                $groups[] = $ag['bs_access_grp_28'];
                $groups[] = $ag['bs_access_grp_29'];
                $groups[] = $ag['bs_access_grp_30'];
                $groups[] = $ag['bs_access_grp_31'];
            }
        }
        $groups_array = '';
        foreach ($groups as $group){
            if(!empty($group))
                $groups_array[] = $group;
        }
//        $groups_str = rtrim($groups_str,',');

        $this->db->select('t.tp_term_id,t.tp_term_name,t.tp_guid');
        $this->db->from('accgroup as ag');
        $this->db->join('accgrpterm as agt', 'ag.ag_id = agt.agt_ag_id');
        $this->db->join('terminal as t', 'agt.agt_term_id = t.tp_term_id');
        $this->db->where_in('ag.ag_id', $groups_array);
        $this->db->group_by(array("t.tp_term_id", "t.tp_term_name","t.tp_guid"));
        $query = $this->db->get();
        $access_door = $query->result_array();

        return $access_door;
    }

    public function getDoorMovByUserAndAccess($cardholder_id,$term_name){
            $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
            $this->db->limit(50);
            $this->db->from('xaction as x');
            $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
            $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
            $this->db->where('x.x_hist_type',35);
            $this->db->where('c.c_id',$cardholder_id);
            $this->db->like('x.x_term_name', $term_name);
            $this->db->order_by('x.x_timestamp', 'DESC');
            $query = $this->db->get();
            $deny = $query->result_array();

            $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
            $this->db->limit(50);
            $this->db->from('xaction as x');
            $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
            $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
            $this->db->where('x.x_hist_type',68);
            $this->db->where('c.c_id',$cardholder_id);
            $this->db->like('x.x_term_name', $term_name);
            $this->db->order_by('x.x_timestamp', 'DESC');
            $query = $this->db->get();
            $allow = $query->result_array();

            $all = array_merge($deny,$allow);
            return $all;
    }

    /**
     * Get doors data
     * @return mixed
     */
    public function getTerminals(){
        $this->db->select('t.tp_term_id,t.tp_term_name,t.tp_guid');
        $this->db->from('terminal as t');
        $this->db->order_by('t.tp_term_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDoorMovByDoorName($door_name){
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number');
        $this->db->limit(50);
        $this->db->from('xaction as x');
        $this->db->where('x.x_hist_type',35);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $deny = $query->result_array();

        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number');
        $this->db->limit(50);
        $this->db->from('xaction as x');
        $this->db->where('x.x_hist_type',68);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $allow = $query->result_array();

        $all = array_merge($deny,$allow);
        return $all;
    }

    public function getDoorMovByDoorNameAndSchedule($door_name,$start,$end){
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where_in('x.x_hist_type',[35,68]);
        $this->db->where('x.x_timestamp >=', $start);
        $this->db->where('x.x_timestamp <=', $end);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}