<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth{

    protected  $CI;
    public function __construct() {
        $this->CI =& get_instance();
    }
    public function check_ldap_connection($host,$port,$return_source=FALSE){
        $return = array();
        if (!function_exists('ldap_connect')) {
            $return = ["error"=>true,"msg"=>"El modulo de LDAP no está presente en el servidor del sistema."];
        }else{
            $dn = @ldap_connect($host,$port);
            if($dn===FALSE){
                $return = ["error"=>true,"msg"=>"No se puede conectar con el servidor LDAP"];
            }else {
                if ($return_source === FALSE){
                    $return = ["error" => false, "msg" => "Conexión exitosa"];
                    $this->connect = $dn;
                }else {
                    $return = ["error" => false, "msg" => "Conexión exitosa", "source" => $dn];
                    $this->connect = $dn;
                }
            }
        }
        return $return;
    }
    // These to ldap_set_options are needed for binding to AD properly
    // They should also work with any modern LDAP service.
    public function ldap_set_options(){
        if(!ldap_set_option($this->connect, LDAP_OPT_REFERRALS, 0))
            return false;
        if(!ldap_set_option($this->connect, LDAP_OPT_PROTOCOL_VERSION, 3))
            return false;
        return true;
    }
    public function login_ldap_check($user,$password,$host,$port,$get=false){
        $return = array();
        $check = $this->check_ldap_connection($host,$port,true);
        if($check["error"] === false) {
            $source = $check["source"];
            if($this->ldap_set_options()){
                $connected = @ldap_bind($source,$user,$password);
                if($connected){
                    if(!$get)
                        $return = ["error" => false, "msg" => "Usuario Conectado"];
                    else
                        $return = ["error" => false, "msg" => "Usuario Conectado","source"=>$source];
                }else{
                    $return = ["error" => true, "msg" => "No se puede conectar el usuario especificado"];
                }
            }else{
                $return = ["error" => true, "msg" => "No se puede establecer opciones de configuración"];
            }
        }else{
            $return = ["error" => true, "msg" => "No se puede establecer conexión"];
        }
        return $return;
    }
    public function login_user($user,$password){
        $host = '172.24.10.10';
        $port = '389';
        $check = $this->login_ldap_check('PLAZAMERU\\'.$user,$password,$host,$port);
        return $check;
    }
    /*
    $base_dn = "DC=YourDomain,DC=com";
$filter = "(&(objectClass=user)(sAMAccountName=yourUserName)(memberof=CN=YourGroup,OU=Users,DC=YourDomain,DC=com))";
$search_result = ldap_search($ldap_conn, $base_dn, $filter);
$entries = ldap_get_entries($ldap_conn, $search_result);
$member = $entries["count"] > 0;
     */
}