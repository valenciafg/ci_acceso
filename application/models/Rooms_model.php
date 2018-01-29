<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms_model extends CI_Model
{
    public function ___construct()
    {
        parent::___construct();
    }
    public function getOperators($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $sql = "SELECT ro.*, dp.DEPARTMENT_NAME FROM RoomOperator ro
        LEFT JOIN [MAINSERVER\EASYCLOCKING].[SekureTime].dbo.DEPARTMENT AS dp ON dp.DEPARTMENT_CODE = ro.department AND dp.COMPANY_CODE = '26343' 
        WHERE 1 = 1 ";
        if(!empty($args)){
            $sql .= isset($args['id'])?" AND ro.id = ".$args['id']:"";
        }
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function updateOperator($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $data = [
            'name' => $args['nombre'],
            'department' => $args['departamento'],
            'status' => $args['estatus'],
            'editUser' => $args['editUser'],
            'editDate' => $args['editDate']
        ];
        $meru_db->where('code', $args['codigo']);
        $result = $meru_db->update('RoomOperator', $data);
        return $result;
    }
    /**
     * Event Types section
     */
    public function getEventTypes($args = []){
        $sql = "SELECT ret.*, dp.DEPARTMENT_NAME, retc.description AS className, rs.Name as statusName, ra.name as availabilityName
        FROM RoomEventType ret
        LEFT JOIN [MAINSERVER\EASYCLOCKING].[SekureTime].dbo.DEPARTMENT AS dp ON dp.DEPARTMENT_CODE = ret.department
        LEFT JOIN RoomEventTypeClasification AS retc ON retc.id = ret.clasification
        LEFT JOIN RoomStatus AS rs ON rs.id = ret.status
        LEFT JOIN RoomAvailability AS ra ON ra.id = ret.availability
        WHERE 1 = 1";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function insertEventType($data = []){
        $meru_db = $this->load->database('meru', TRUE);
        $meru_db->insert('RoomEventType', $data);
        $insert_id = $meru_db->insert_id();
        return $insert_id;
    }
    public function updateEventType($args){
        $meru_db = $this->load->database('meru', TRUE);
        $data = [
            'eventCode' => $args['eventCode'],
            'description' => $args['description'],
            'clasification' => $args['clasification'],
            'department' => $args['department'],
            'availability' => $args['availability'],
            'status' => $args['status'],
            'editUser' => $args['editUser'],
            'editDate' => $args['editDate']
        ];
        $meru_db->where('id', $args['id']);
        $result = $meru_db->update('RoomEventType', $data);
        return $result;
    }
    public function getEvenTypeData($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $sql = "SELECT ret.* FROM RoomEventType ret
        WHERE 1 = 1 ";
        if(!empty($args)){
            $sql .= isset($args['id'])?" AND ret.id = ".$args['id']:"";
        }
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    /**
     * Rooms section
     */
    public function getRoom($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $sql = "SELECT pd.* FROM PhoneDirectory pd
        WHERE 1 = 1 AND IsRoom = 1";
        if(!empty($args)){

        }
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;    
    }
    public function getRoomStatus($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $sql = "SELECT 
        pd.ExtensionID,
        pd.PhoneNumber,
        pd.Name AS roomName,
        re.roomName AS roomNameCentral,
        pd.Area,
        pd.Location,
        re.eventCode,
        ret.description AS eventDescription,
        re.regDate AS eventDate,
        ret.clasification,
        retc.description AS clasificationName,
        re.operatorCode,
        ro.alias operatorAlias,
        ro.name AS operatorName,
        ret.department,
        ret.status as statusCode,
        rs.Name as statusName,
        ret.availability as availabilityCode,
        ra.name as availabilityName,
        dp.DEPARTMENT_NAME AS departmentName
        FROM PhoneDirectory pd
        LEFT JOIN (
        SELECT roomExtension, MAX(regDate) AS regDate 
        FROM RoomEvent GROUP BY roomExtension) AS t1
        ON pd.PhoneNumber = t1.roomExtension
        LEFT JOIN RoomEvent re ON re.roomExtension = pd.PhoneNumber AND re.regDate = t1.regDate
        LEFT JOIN RoomEventType ret ON ret.eventCode = re.eventCode
        LEFT JOIN RoomEventTypeClasification retc ON retc.id = ret.clasification
        LEFT JOIN RoomStatus rs ON rs.id = ret.status
        LEFT JOIN RoomAvailability ra ON ra.id = ret.availability
        LEFT JOIN RoomOperator ro ON ro.code = re.operatorCode
        LEFT JOIN [MAINSERVER\EASYCLOCKING].[SekureTime].dbo.DEPARTMENT AS dp ON dp.DEPARTMENT_CODE = ret.department
        WHERE 1 = 1
        AND pd.IsRoom = 1 ";
        if(!empty($args)){

        }
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getRoomEventTypeClasification($args = []){
        $sql = "SELECT * FROM RoomEventTypeClasification WHERE 1 = 1";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    /**
     * Seccion room events
     */
    public function getRoomEvents($args = []){
        $meru_db = $this->load->database('meru', TRUE);
        $sql = "SELECT 
        re.*, 
        ret.description as Type, 
        retc.description as clasification, 
        ret.department,
        dp.DEPARTMENT_NAME, 
        ro.alias, 
        ro.name
        FROM RoomEvent re
        LEFT JOIN RoomEventType ret ON re.eventCode = ret.eventCode
        LEFT JOIN RoomEventTypeClasification retc ON retc.id = ret.clasification
        LEFT JOIN [MAINSERVER\EASYCLOCKING].[SekureTime].dbo.DEPARTMENT AS dp ON dp.DEPARTMENT_CODE = ret.department
        LEFT JOIN RoomOperator ro ON ro.code = re.operatorCode
        WHERE 1 = 1 ";
        if(!empty($args)){
            $sql .= isset($args['start']) && isset($args['start']) ? " AND re.regDate BETWEEN '".$args['start']."' AND '".$args['end']."' " : "";
            $sql .= isset($args['room'])?" AND re.roomExtension = '".$args['room']."' ":"";
            $sql .= isset($args['operator'])?" AND re.operatorCode = '".$args['operator']."' ":"";
        }
        $sql .= " ORDER BY re.regDate DESC";
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getRoomAvailability($args = []){
        $sql = "SELECT ra.* FROM RoomAvailability ra WHERE 1 = 1 ";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getRoomStatusRecords($args = []){
        $sql = "SELECT rs.* FROM RoomStatus rs WHERE 1 = 1 ";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getAvailability($args = []){
        $sql = "SELECT ra.* FROM RoomAvailability ra WHERE 1 = 1 ";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function getStatus($args = []){
        $sql = "SELECT rs.* FROM RoomStatus rs WHERE 1 = 1 ";
        if(!empty($args)){

        }
        $meru_db = $this->load->database('meru', TRUE);
        $query = $meru_db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}