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
        $sql = "SELECT ret.*, dp.DEPARTMENT_NAME, retc.description AS className
        FROM RoomEventType ret
        LEFT JOIN [MAINSERVER\EASYCLOCKING].[SekureTime].dbo.DEPARTMENT AS dp ON dp.DEPARTMENT_CODE = ret.department
        LEFT JOIN RoomEventTypeClasification AS retc ON retc.id = ret.clasification
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
        dp.DEPARTMENT_NAME AS departmentName
        FROM PhoneDirectory pd
        LEFT JOIN (
        SELECT roomExtension, MAX(regDate) AS regDate 
        FROM RoomEvent GROUP BY roomExtension) AS t1
        ON pd.PhoneNumber = t1.roomExtension
        LEFT JOIN RoomEvent re ON re.roomExtension = pd.PhoneNumber AND re.regDate = t1.regDate
        LEFT JOIN RoomEventType ret ON ret.eventCode = re.eventCode
        LEFT JOIN RoomEventTypeClasification retc ON retc.id = ret.clasification
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
}