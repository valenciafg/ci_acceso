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
        $this->db->limit(150);
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where_in('x.x_hist_type',[35,68,33,37]);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $allow = $query->result_array();
        return $allow;
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
        $this->db->where_in('x.x_hist_type',[35,68,33,37]);
        $this->db->where('x.x_timestamp >=', $start);
        $this->db->where('x.x_timestamp <=', $end);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getEventsByScheduleHistoric($start,$end){
        $sql = "select
	                x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname
                from xaction as x
                join [controlserver].[Pegasys].dbo.badge as b on b.b_number_str = x.x_badge_number COLLATE SQL_Latin1_General_CP1_CI_AS 
                join [controlserver].[Pegasys].dbo.cardholder as c on b.b_cardholder_id = c.c_id
                where 
                    x.x_hist_type in (35,68,33,37)
                    and x.x_timestamp >= '".$start."'
                    and x.x_timestamp <= '".$end."'
                order by x.x_timestamp DESC";
        $control_db = $this->load->database('control', TRUE);
        $query = $control_db->query($sql);
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
    /**
     * get doors that user can access
     * @param  [string] $guid [user badge encoded ID]
     * @return [array]       [Door array]
     */
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
    /**
     * get user who can open a door
     * @param  [integer] $door_id [unique door identification key]
     * @return [array]          [Users array]
     */
    public function getTerminalsUsersCanAccess($door_id){
        $this->db->select('agt.agt_ag_id');
        $this->db->from('accgrpterm as agt');
        $this->db->where('agt.agt_term_id', $door_id);
        $query = $this->db->get();
        $access_groups = $query->result_array();
        $groups = array();
        foreach ($access_groups as $group) {
            $groups[] = $group['agt_ag_id'];
        }
        if(empty($groups))
            return $groups;
        $this->db->select('bs.bs_b_guid');
        $this->db->from('badgesite as bs');
        $this->db->where_in('bs.bs_access_grp_0', $groups);
        $this->db->or_where_in('bs.bs_access_grp_1', $groups);
        $this->db->or_where_in('bs.bs_access_grp_2', $groups);
        $this->db->or_where_in('bs.bs_access_grp_3', $groups);
        $this->db->or_where_in('bs.bs_access_grp_4', $groups);
        $this->db->or_where_in('bs.bs_access_grp_5', $groups);
        $this->db->or_where_in('bs.bs_access_grp_6', $groups);
        $this->db->or_where_in('bs.bs_access_grp_7', $groups);
        $this->db->or_where_in('bs.bs_access_grp_8', $groups);
        $this->db->or_where_in('bs.bs_access_grp_9', $groups);
        $this->db->or_where_in('bs.bs_access_grp_10', $groups);
        $this->db->or_where_in('bs.bs_access_grp_11', $groups);
        $this->db->or_where_in('bs.bs_access_grp_12', $groups);
        $this->db->or_where_in('bs.bs_access_grp_13', $groups);
        $this->db->or_where_in('bs.bs_access_grp_14', $groups);
        $this->db->or_where_in('bs.bs_access_grp_15', $groups);
        $this->db->or_where_in('bs.bs_access_grp_16', $groups);
        $this->db->or_where_in('bs.bs_access_grp_17', $groups);
        $this->db->or_where_in('bs.bs_access_grp_18', $groups);
        $this->db->or_where_in('bs.bs_access_grp_19', $groups);
        $this->db->or_where_in('bs.bs_access_grp_20', $groups);
        $this->db->or_where_in('bs.bs_access_grp_21', $groups);
        $this->db->or_where_in('bs.bs_access_grp_22', $groups);
        $this->db->or_where_in('bs.bs_access_grp_23', $groups);
        $this->db->or_where_in('bs.bs_access_grp_24', $groups);
        $this->db->or_where_in('bs.bs_access_grp_25', $groups);
        $this->db->or_where_in('bs.bs_access_grp_26', $groups);
        $this->db->or_where_in('bs.bs_access_grp_27', $groups);
        $this->db->or_where_in('bs.bs_access_grp_28', $groups);
        $this->db->or_where_in('bs.bs_access_grp_29', $groups);
        $this->db->or_where_in('bs.bs_access_grp_30', $groups);
        $this->db->or_where_in('bs.bs_access_grp_31', $groups);
        $query = $this->db->get();
        $badges = $query->result_array();
        $badges_guid = array();
        foreach ($badges as $badge) {
            $badges_guid[] = $badge['bs_b_guid'];
        }
        $this->db->select('ch.c_id, ch.c_lname, ch.c_fname, ch.c_dept_id, ch.c_guid, ch.c_s_timestamp, d.dept_name');
        $this->db->from('cardholder as ch');
        $this->db->join('badge as b', 'b.b_cardholder_id = ch.c_id');
        $this->db->join('dept as d', 'ch.c_dept_id = d.dept_id','left');
        $this->db->where_in('b.b_guid', $badges_guid);
        $query = $this->db->get();
        $cardholders = $query->result_array();
        return $cardholders;
    }
    public function getDoorMovByUserAndAccess($cardholder_id,$term_name){
            $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
            $this->db->limit(50);
            $this->db->from('xaction as x');
            $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
            $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
            $this->db->where('x.x_hist_type',33);
            $this->db->where('c.c_id',$cardholder_id);
            $this->db->like('x.x_term_name', $term_name);
            $this->db->order_by('x.x_timestamp', 'DESC');
            $query = $this->db->get();
            $invalid_card = $query->result_array();

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

            $first = array_merge($invalid_card,$deny);

            $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
            $this->db->limit(50);
            $this->db->from('xaction as x');
            $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
            $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
            $this->db->where('x.x_hist_type',37);
            $this->db->where('c.c_id',$cardholder_id);
            $this->db->like('x.x_term_name', $term_name);
            $this->db->order_by('x.x_timestamp', 'DESC');
            $query = $this->db->get();
            $deny_timezone = $query->result_array();

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

            $second = array_merge($deny_timezone,$allow);

            $all = array_merge($first,$second);
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
        $invalid_card = $query->result_array();

        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number');
        $this->db->limit(50);
        $this->db->from('xaction as x');
        $this->db->where('x.x_hist_type',35);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $deny = $query->result_array();

        $first = array_merge($invalid_card,$deny);

        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number');
        $this->db->limit(50);
        $this->db->from('xaction as x');
        $this->db->where('x.x_hist_type',35);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $deny_timezone = $query->result_array();

        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number');
        $this->db->limit(50);
        $this->db->from('xaction as x');
        $this->db->where('x.x_hist_type',68);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $allow = $query->result_array();

        $second = array_merge($deny_timezone,$allow);

        $all = array_merge($first,$second);
        return $all;
    }

    public function getDoorMovByDoorNameAndSchedule($door_name,$start,$end){
        $this->db->select('x.x_hist_type,x.x_panel_name,x_term_name,x.x_fname,x.x_lname,x.x_timestamp,x.x_badge_number,b.b_number_str,b.b_cardholder_id,b.b_description,c.c_lname,c.c_fname');
        $this->db->from('xaction as x');
        $this->db->join('badge as b', 'b.b_number_str = x.x_badge_number');
        $this->db->join('cardholder as c', 'b.b_cardholder_id = c.c_id');
        $this->db->where_in('x.x_hist_type',[35,68,33,37]);
        $this->db->where('x.x_timestamp >=', $start);
        $this->db->where('x.x_timestamp <=', $end);
        $this->db->like('x.x_term_name', $door_name);
        $this->db->order_by('x.x_timestamp', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}