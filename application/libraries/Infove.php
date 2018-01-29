
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Infove{
    protected  $CI;
    public function __construct() {
        $this->CI =& get_instance();
    }
    public function obtenerElectorCNE($nacionalidad = "", $cedula = "") {
        $url = "http://www.cne.gob.ve/web/registro_electoral/ce.php?nacionalidad=".$nacionalidad."&cedula=".$cedula;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER,'http://www.cne.gob.ve/');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $html=curl_exec($ch);
        if($html==false){
            $m=curl_error(($ch));
            error_log($m);
            curl_close($ch);
            $j['error'] = true;
            $j['descripcion'] = $m;
            // print json_encode($j);
            return $j;
        } else {
            curl_close($ch);
            if (strpos($html, '<b>DATOS DEL ELECTOR</b>') > 0) {
                $modo = 1; # Puede Votar
            } else if (strpos($html, '<strong>DATOS PERSONALES</strong>') > 0) {
                $modo = 2; # No Puede Votar
            } else {
                $modo = -1;
                $j['error'] = true;
                $j["descripcion"] = "El usuario no se encuentra inscrito en el registro electoral";
                // return json_encode($j);
                return $j;
            }
            $j['error'] = false;
            $j["descripcion"] = "/cne/elector";
            $j['modo'] = $modo;
            // Datos para un elector que puede votar
            if ($j['modo'] == 1) {
                #Obtener Cédula
                $npos = strpos($html, 'align="left">', strpos($html, 'dula:')) + 13;
                $j['cedula'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Nombre
                $npos = strpos($html, 'align="left"><b>', strpos($html, 'Nombre:')) + 16;
                $j['nombre'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Estado
                $npos = strpos($html, 'align="left">', strpos($html, 'Estado:')) + 13;
                $j['estado'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Municipio
                $npos = strpos($html, 'align="left">', strpos($html, 'Municipio:')) + 13;
                $j['municipio'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Parroquia
                $npos = strpos($html, 'align="left">', strpos($html, 'Parroquia:')) + 13;
                $j['parroquia'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Centro
                $npos = strpos($html, '"#0000FF">', strpos($html, 'Centro:')) + 10;
                $j['centro'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Dirección
                $npos = strpos($html, '"#0000FF">', strpos($html, 'Direcci')) + 10;
                $j['direccion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                $j['servicio'] = 'no';
                #Obtener servicio
                $npos = strpos($html, 'color="#', strpos($html, 'SERVICIO ELECTORAL')) + 16;
                $j['servicio'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            }
            // Datos para un elector con objeción
            else if ($j['modo'] == 2) {
                #Obtener Cédula
                $npos = strpos($html, 'strong> ', strpos($html, 'dula:')) + 8;
                $j['cedula'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Nombre
                $npos = strpos($html, 'strong> ', strpos($html, 'Primer Nombre:')) + 8;
                $j['nombre'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Nombre
                $npos = strpos($html, 'strong> ', strpos($html, 'Segundo Nombre:')) + 8;
                $j['nombre'] .= " " . trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Apellido
                $npos = strpos($html, 'strong> ', strpos($html, 'Primer Apellido:')) + 8;
                $j['nombre'] .= " " . trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Apellido
                $npos = strpos($html, 'strong> ', strpos($html, 'Segundo Apellido:')) + 8;
                $j['nombre'] .= " " . trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Estatus
                $npos = strpos($html, '<td>', strpos($html, 'ESTATUS')) + 4;
                $j['estatus'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Objecion
                $npos = strpos($html, 'strong> ', strpos($html, '>Objeci')) + 8;
                $j['objecion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Descripción
                $npos = strpos($html, 'strong> ', strpos($html, '>Descripci')) + 8;
                $j['descripcionobjecion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener institución
                $npos = strpos($html, 'strong> ', strpos($html, 'solventar la objeci')) + 8;
                $j['institucion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
                #Obtener Requisitos
                $npos = strpos($html, '<td>', strpos($html, 'Requisitos')) + 4;
                $j['requisitos'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            }
            return $j;
        }
    }
    function obtenerContribuyenteSENIAT($rif){
        $url = "http://contribuyente.seniat.gob.ve/getContribuyente/getrif?rif=$rif";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER,'http://seniat.gob.ve');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($ch,CURLOPT_TIMEOUT,30);
        $html=curl_exec($ch);
        if($html==false){
            $m=curl_error(($ch));
            error_log($m);
            curl_close($ch);
            $j['error'] = true;
            $j['descripcion'] = $m;
            return $j;
        } else {
            curl_close($ch);
            if (strpos($html, 'rif:numeroRif="') == false) {
                $j['rif'] = $rif;
                $j['error'] = "El RIF $rif no est&aacute; registrado o no existe";
                return $j;
            }
            $j['error'] = false;
            $j['descripcion'] = "obtenerContribuyente";
            #Obtener RIF
            $npos = strpos($html, 'rif:numeroRif="') + 15;
            $j['rif'] = trim(substr($html, ($npos), (strpos($html, '"', ($npos)) - ($npos))));
            #Obtener Nombre
            $npos = strpos($html, '<rif:Nombre>') + 12;
            $j['nombre'] = utf8_decode(trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos)))));
            #Obtener Agente de retención
            $npos = strpos($html, '<rif:AgenteRetencionIVA>') + 24;
            $j['retencion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Contribuyente
            $npos = strpos($html, '<rif:ContribuyenteIVA>') + 22;
            $j['contribuyente'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Tasa
            $npos = strpos($html, '<rif:Tasa>') + 10;
            $j['tasa'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            return $j;
        }
    }
    function obtenerCuentaIVSS($nacionalidad, $cedula, $dia, $mes, $anho) {
        $url = "http://www.ivss.gob.ve:28083/CuentaIndividualIntranet/CtaIndividual_PortalCTRL";
        $params = "nacionalidad_aseg=$nacionalidad&cedula_aseg=$cedula&d=$dia&m=$mes&y=$anho";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch,CURLOPT_REFERER,"http://ivss.gov.ve");
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $html=curl_exec($ch);
        if($html==false){
            $m=curl_error(($ch));
            error_log($m);
            curl_close($ch);
            $j['error'] = $m;
            return $j;
        } else {
            curl_close($ch);
            
            #Verificar si hubo error
            $npos = strpos($html, 'function error');
            if ($npos > 0) {
                $j['error'] = true;
                $j['descripcion'] = "la Cedula no esta registrada como asegurado";
                return $j;
            }
            #No hubo error
            $j['error'] = false;
            $j['descripcion'] = "/ivss/cuenta";
            #Obtener Cédula
            $npos = strpos($html, 'Identidad') + 65;
            $j['cedula'] = trim(substr($html, ($npos), 20));
            #Obtener Nombre
            $npos = strpos($html, 'Apellido') + 60;
            $j['nombre'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            #Obtener Sexo
            $npos = strpos($html, 'Sexo') + 64;
            $j['sexo'] = trim(substr($html, ($npos), 15));
            #Obtener Fecha de Nacimiento
            $npos = strpos($html, '#000000">', strpos($html, 'Nacimiento')) + 9;
            $j['nacimiento'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Número Patronal
            $npos = strpos($html, '#000000">', strpos($html, 'Patronal')) + 9;
            $j['numeropatronal'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Nombre Empresa
            $npos = strpos($html, '#000000">', strpos($html, 'Empresa')) + 9;
            $j['empresa'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Fecha de Ingreso
            $npos = strpos($html, '#000000">', strpos($html, 'Ingreso')) + 9;
            $j['ingreso'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Estatus del Asegurado
            $npos = strpos($html, '<td width="28%">', strpos($html, 'Estatus del Asegurado')) + 16;
            $j['estatus'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Fecha de Primera Afiliación
            $npos = strpos($html, '<td width="20%">', strpos($html, 'Primera Afiliaci&oacute;n')) + 16;
            $j['afiliacion'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Fecha de Contingencia
            $npos = strpos($html, '<td width="28%">', strpos($html, 'Contingencia')) + 16;
            $j['contingencia'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Total Semanas Cotizadas
            $npos = strpos($html, '<td width="19%" align="center">', strpos($html, 'TOTAL SEMANAS COTIZADAS')) + 31;
            $j['semanas'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            #Obtener Total Salarios Cotizados
            $npos = strpos($html, '<td colspan="3" align="center">', strpos($html, 'TOTAL SALARIOS COTIZADOS')) + 31;
            $j['salarios'] = trim(substr($html, ($npos), (strpos($html, '<', ($npos)) - ($npos))));
            return $j;
        }        
    }
    function obtenerDeudaCorpoelec($nic){
        $url = "http://cobrosweb.cadafe.com.ve/enlinea/consultadeuda.aspx?nic=$nic";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER,'http://cadafe.com.ve');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,50);
        curl_setopt($ch,CURLOPT_TIMEOUT,300);
        $html=curl_exec($ch);
        if($html==false){
            $m=curl_error(($ch));
            curl_close($ch);
            $j['error'] = true;
            $j['descripcion'] = $m;
            return $j;
        } else {
            curl_close($ch);
            #Obtener NIC
            $npos = strpos($html, 'TextBox1') + 29;
            $j['nic'] = trim(substr($html, ($npos), (strpos($html, '"', ($npos)) - ($npos))));
            #Obtener USUARIO
            $npos = strpos($html, 'TextBox2') + 29;
            $j['usuario'] = trim(substr($html, ($npos), (strpos($html, '"', ($npos)) - ($npos))));
            #Obtener PAGO PENDIENTE
            $npos = strpos($html, 'TextBox7') + 29;
            $j['pendiente'] = trim(substr($html, ($npos), (strpos($html, '"', ($npos)) - ($npos))));
            #Obtener PAGO VENCIDO
            $npos = strpos($html, 'TextBox5') + 29;
            $j['vencido'] = trim(substr($html, ($npos), (strpos($html, '"', ($npos)) - ($npos))));
            # Obtener Error
            $j['error'] = ($j['usuario'] == 'y=' ? true : false);
            $j['descripcion'] = ($j['usuario'] == 'y=' ? 'El Usuario no esta Registrado....' : "/corpoelec/deuda");
            return $j;
        }        
    }
    function obtenerSeguimientoZOOM($guia) {
        $url = "https://www.grupozoom.com/tracking/consultarope.php3?tipo=guia&txtcodguias=$guia";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER,'https://www.grupozoom.com/');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686; rv:32.0) Gecko/20100101 Firefox/32.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $html=curl_exec($ch);
        $html = str_replace("\n", "", str_replace("\r", "", str_replace("\t", "", $html)));
        if($html==false){
            $m=curl_error(($ch));
            error_log($m);
            curl_close($ch);
            $j['error'] = true;
            $j['descripcion'] = $m;
            return $j;
        } else {
            $j['error'] = false;
            $j['descripcion'] = "/zoom/seguimiento";
            $npos = strpos($html, 'Referencia</B></td>') + 62;
            $j['referencia'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            $npos = strpos($html, 'Estatus</B></td>') + 47;
            $j['estatus'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            $npos = strpos($html, 'Tipo de env') + 60;
            $j['tipoenvio'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            
            $npos = strpos($html, 'Fecha</B></td>') + 52;
            $j['fecha'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            $npos = strpos($html, 'Origen</B></td>') + 46;
            $j['origen'] = trim(substr($html, ($npos), (strpos($html, '</td>', ($npos)) - ($npos))));
            $npos = strpos($html, 'Destino</B></td>') + 47;
            $j['destino'] = trim(substr($html, ($npos), (strpos($html, '</TD>', ($npos)) - ($npos))));
            preg_match('/Oficina<\/B><\/td><\/tr>(.*)<\/table><\/td>/i', $html, $coincidencias);
            $coincidencias2 = preg_grep('/<td class=normal>(.*)<\/td>/i', explode("\n", str_replace("tr><tr", "tr>\n<tr", str_replace("td><td", "td>\n<td", $coincidencias[1]))));
            $seguimiento = array_reverse($coincidencias2);
            $j['seguimiento'] = array();
            $i = 0;
            foreach($seguimiento as $v) {
                $i++;
                $h = str_replace("</tr>", "", str_replace("</td>", "", str_replace("<td class=normal>", "", str_replace("<tr>", "",$v))));
                switch($i) {
                    case 1:
                        $k["oficina"] = $h;
                        break;
                    case 2:
                        $k["motivo"] = $h;
                        break;
                    case 3:
                        $k["estatus"] = $h;
                        break;
                    case 4:
                        $k["fecha"] = $h;
                        $i = 0;
                        $j['seguimiento'][] = $k;
                        $k = null;
                        break;
                }
            }
        }
        return $j;
    }
        /*
    * Método: obtenerDeudaCANTV
    * Descripción: obtiene la deuda del telefono indicado
    * Parámetros:
    * $codigo: Código de area del número de teléfono
    * $telefono: Número de teléfono
    *
    * Retorna: cadena json con los siguientes datos
    * saldoactual: Saldo Actual
    * ultimafacturacion: Ultima Facturación
    * fechacorte: Fecha de Corte
    * fechavencimiento: Fecha de vencimiento
    * saldovencido: Saldo vencido
    * ultimopago: Monto del último pago realizado
    */
    public function obtenerDeudaCANTV($codigo = "", $telefono = "") {
        $url = "http://www.cantv.com.ve/seccion.asp?pid=1&sid=450";
        $params = "sarea=".$codigo."&stelefono=".$telefono."&Submit=Consultar";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch,CURLOPT_REFERER,'http://www.cantv.com.ve');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,100);
        curl_setopt($ch,CURLOPT_TIMEOUT,500);
        $html=curl_exec($ch);
        
        if($html==false){
            $m=curl_error(($ch));
            error_log($m);
            curl_close($ch);
            $j["error"] = true;
            $j["descripcionx"] = $m;
            return $j;
        } else {
            curl_close($ch);
            $j['error'] = false;
            $j["descripcion"] = "/cantv/deuda";
            // Obtener Saldo Actual
            $npos = strpos($html, 'Saldo actual Bs.') + 118;
            $j['saldoactual'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            // Obtener Ultima Facturación
            $npos = strpos($html, 'Fecha de &uacute;ltima facturaci&oacute;n:') + 132;
            $j['ultimafacturacion'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            // Obtener Fecha de Corte
            $npos = strpos($html, 'Fecha corte:') + 102;
            $j['fechacorte'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            // Obtener Fecha de vencimiento
            $npos = strpos($html, 'Fecha de vencimiento:') + 111;
            $j['fechavencimiento'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            // Obtener Saldo vencido
            $npos = strpos($html, 'Saldo vencido:') + 116;
            $j['saldovencido'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            // Obtener Monto del último pago realizado:
            $npos = strpos($html, 'Monto del &uacute;ltimo pago realizado:') + 130;
            $j['ultimopago'] = trim(substr($html, ($npos), (strpos($html, '</font>', ($npos)) - ($npos))));
            return $j;
        }
    }
}