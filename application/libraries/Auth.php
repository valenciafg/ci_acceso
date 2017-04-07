<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth{

    protected  $CI;
    private $connect;
    private $host = '172.24.10.10';
    private $port = '389';
    private $domain_prefix = 'PLAZAMERU\\';
    private $default_group = 'g_AppMeru';
    private $base_dn = "DC=PLAZAMERU,DC=com";

    public function __construct() {
        $this->CI =& get_instance();
    }
    public function ldap_check_connection($host,$port,$return_source=FALSE){
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
    public function ldap_user_group_check($user, $group = false, $ldap_conn = false){
        if(!$group){
            $group = $this->default_group;
        }
        if(!$ldap_conn){
            $check = $this->ldap_check_connection($this->host, $this->port, true);
            if(!$check['error']){
                $ldap_conn = $check['source'];
            }
        }
        $entries = 'pp';
        if($ldap_conn){
            $base_dn = $this->base_dn;
            $filter = "(&(objectClass=user)(sAMAccountName=".$user.")(memberof=CN=".$group.",".$base_dn."))";
            return $filter;
            $search_result = @ldap_search($ldap_conn, $base_dn, $filter);
            $entries = @ldap_get_entries($ldap_conn, $search_result);
        }
        return $entries;
        //$member = $entries["count"] > 0;
    }
    public function ldap_login_check($username,$password,$host,$port,$get=false){
        $user = $this->domain_prefix . $username;
        $return = array();
        $check = $this->ldap_check_connection($host,$port,true);
        if($check["error"] === false) {
            $source = $check["source"];
            if($this->ldap_set_options()){
                $connected = @ldap_bind($source,$user,$password);
                if($connected){
                    return $this->ldap_user_group_check($username,$this->default_group,$source);
                    if(!$get){
                        $return = ["error" => false, "msg" => "Usuario Conectado"];
                    }else{
                        $return = ["error" => false, "msg" => "Usuario Conectado","source"=>$source];
                    }
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
    public function ldap_login_user($user,$password){
        $host = $this->host;
        $port = $this->port;
        $check = $this->ldap_login_check($user, $password, $host, $port);
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