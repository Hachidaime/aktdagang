<?php
function getTemplate($dir,$method){
    return $dir."/".$method.".php";
}

function formatUpdate($table, $values, $where){
    $cond = ($where) ? "WHERE " . implode(" AND ", $where) : "";
    return "UPDATE " . $table . " SET " . implode(", ", $values) . ", update_dt=NOW() $cond";
}

function formatInsert($table, $values){
    return "INSERT INTO " . $table . " SET " . implode(", ", $values);
}

function formatSQL($string){
	global $config;
	
	return mysqli_real_escape_string($config['con'], $string);
}

function WriteSysLog($log_tag="", $log_action="", $log_msg=""){
    global $db, $login_id;
		
		$remote_ip = $_SERVER['REMOTE_ADDR'];
    $db->Execute("INSERT INTO tsystemlog SET login_id='".formatSQL($login_id)."', log_tag='".formatSQL($log_tag)."', log_action='".formatSQL($log_action)."', log_msg='".formatSQL($log_msg)."', insert_dt=NOW(), remote_ip='".$remote_ip."'");
}

function operationLog($params, $folder){	
	global $root;
	if($folder != ''){
		$path = $root."logs/".$folder;
		if(!is_dir($path)) mkdir($path);
		
		$currdate = date("Y-m-d");
		$currtime = date("H:i:s");
		
		$str = (is_array($params)) ? print_r(json_encode($params),true) : $params;
		
		$fhandle = fopen($path."/$currdate.log", "a+");
		fwrite($fhandle, "$currtime    ".$str."\n");
		fclose($fhandle);
	}
}

function processSysMsg(){
    global $sys_msg;
	
	$alert_color = array(
		"error" => "red",
		"danger" => "red",
		"warning" => "yellow",
		"info" => "blue",
		"success" => "green"
	);
		
		$result = "";
    if (count($sys_msg))
    {
        foreach ($sys_msg as $msg_type=>$msg)
        {
            $result .= "<div style='color:".$alert_color[$msg_type]."'>\n";
			$result .= "<p>\n";
            foreach ($msg as $m){
                $result .= "$m<br>\n";
            }
			$result .= "</p>\n";
            $result .= "</div>\n";
            if($msg_type == 'info'){
                $result = strip_tags($result);
                
            }
        }
    }
    return $result;
}

function formatNum($params){
	return number_format($params,2);
}

function read_csv($csv_file){
	$fp = fopen ("$csv_file","r");

	$rownum = 0;

	while ($data = fgetcsv ($fp, 2000, ",")){
		$num = count($data);
      
		if ($num < 2){
			continue;
		}
		for ($c=0; $c < $num; $c++) {
			$myarray[$rownum][$c] = mysql_escape_string($data[$c]);
		}
		$rownum++;
	}

	return $myarray;
}
?>