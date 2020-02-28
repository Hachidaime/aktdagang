<?php
class Front{
    
    var $db;
    var $smarty;
    var $config;
   
    function Front(){
        global $db, $smarty, $config, $sys_msg;
        $this->db = &$db;
        $this->smarty = &$smarty;
        $this->config = &$config;
        $this->sys_msg = &$sys_msg;
		$this->remote_ip = $_SERVER['REMOTE_ADDR'];
		$this->login_id = ($_SESSION['USER']['id']) ? $_SESSION['USER']['id'] : '';
        $this->periode = $this->ActivePeriod();
    }
    
    function AddNew(){
        $this->smarty->assign('class', $_GET['class']);
        $content = $this->smarty->fetch('TPL_AddNew.php');
        return $content;
    }
    
    function ActivePeriod(){
        $sql = "SELECT * FROM periode WHERE aktif = 1";
        $detail = $this->db->GetRow($sql);
        
        $total_days = date('t', mktime(0,0,0, $detail['bulan'], 1, $detail['tahun']));
        $detail['jml_hari'] = $total_days;
        
        for($i=1; $i<=$total_days; $i++){
            $list_tgl[$i] = $i;
        }
        $detail['list_tgl'] = $list_tgl;
        return $detail;
    }
	
	function GeneratePagination(){
		foreach($_POST as $key=>$val){
			$$key = $val;
		}
		
		if ($total_page <= SCROLL_PER_PAGE) {
            if ($total_page <= PAGER_PER_PAGE) {
                $loop_start = 1;
                $loop_finish = $total_page;
            }else{
                $loop_start = 1;
                $loop_finish = $total_page;
            }
        }else{
            if($page < intval(SCROLL_PER_PAGE / 2) + 1) {
                $loop_start = 1;
                $loop_finish = SCROLL_PER_PAGE;
            }else{
                $loop_start = $page - intval(SCROLL_PER_PAGE / 2);
                $loop_finish = $page + intval(SCROLL_PER_PAGE / 2);
                if ($loop_finish > $total_page) $loop_finish = $total_page;
            }
        }
		
		
		$first = 1;
		$previous = $page - 1;
		$next = $page + 1;
		$last = $total_page;
		
		$result = array();
		$result['first'] = $first;
		$result['previous'] = $previous;
		$result['next'] = $next;
		$result['last'] = $last;
		$result['loop_start'] = $loop_start;
		$result['loop_finish'] = $loop_finish;
		echo json_encode($result);
	}
	
	function ReadCSV($file){
		$fhandle = fopen($file, "r");
		$key = 0;
		while(!feof($fhandle)){
			$content = fgetcsv($fhandle);
			$data[$key] = $content;
			$key++;
		}
		fclose($fhandle);

		foreach($data[0] as $key=>$val){
			$val = preg_replace("/([\W]+)/","", $val);
			$val = preg_replace("/(![[:alnum:]]+)/","", $val);
			$header[$key] = $val;
		}

		foreach($data as $idx=>$row){
			$data[$idx] = $data[$idx+1];
			if(empty($data[$idx])) unset($data[$idx]);
		}
		
		while($idx <= count($data)){
			echo $idx;
		}

		foreach($data as $idx=>$row){
			foreach($row as $key=>$val){
				$data[$idx][$header[$key]] = $val;
				unset($data[$idx][$key]);
			}
		}

		print "<pre>";
		print_r($header);
		// print_r($data);
		print "</pre>";
	}

	function validateForm($params, $data){
        $error = array();
		
        foreach ($data as $field=>$mode){
            $name = $mode['name'];
            $req  = $mode['std'][0];
            $type = $mode['std'][1];

            $fieldvalue = $params[$field];

            $errfound = 0;

            if ($req && (trim($fieldvalue)=='' || $fieldvalue==0)){
                $error[] = "<strong>$name</strong> tidak boleh kosong.\n";
                $errfound = 1;
            }

            if (!$errfound && $type && $fieldvalue){
                if ($type == 'Numeric' && !is_numeric($fieldvalue)){
                    $error[] = "Mohon isi <strong>$name</strong> [$fieldvalue] dengan nilai numerik.\n";
                    $errfound = 1;

                }
                else if ($type == 'Email' && !$this->validate_email($fieldvalue)){
                    $error[] =  "<strong>$name</strong> [$fieldvalue] tidak valid.\n";
                    $errfound = 1;
                }
                else if ($type == 'Date' && ($this->validate_date($fieldvalue)>0)) {
                    switch($this->validate_date($fieldvalue))
                    {
                        case 1 : $error[] = "Mohon isi <strong>$name</strong> dalam format 'dd/mm/yyyy'.\n";$errfound = 1;break;
                        case 2 : $error[] = "Mohon isi <strong>$name</strong> hari, bulan atau tahun dengan nilai yang valid.\n";$errfound = 1;break;
                    }
                }
                else if($type == 'Time' && ($this->validate_time($fieldvalue)>0)){
                    switch($this->validate_time($fieldvalue))
                    {
                        case 1 : $error[] = "Mohon isi <strong>$name</strong> dalam format 24 jam 'hh:mm'.\n";$errfound = 1;break;
                        case 2 : $error[] = "Mohon isi <strong>$name</strong> dengan jam valid.\n";$errfound = 1;break;
                        case 3 : $error[] = "Mohon isi <strong>$name</strong> dengan menit valid.\n";$errfound = 1;break;
                    }
                }
            }
        }

        $error = array_unique($error);

        return $error;
    }

	// check if email address is valid
    function validate_email($val){
        if($val != ""){
            $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
            if(preg_match($pattern, $val)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

	function validate_date($strdate){
        $dateError = 0;

        if($strdate !== '')
        {
            //Check the length of the entered Date value
            if((strlen($strdate)<10) || (strlen($strdate)>10)){
                //Enter the date in 'dd/mm/yyyy' format
                $dateError = 1;

            }
            else{
                //The entered value is checked for proper Date format
                if((substr_count($strdate,"/"))<>2){
                    //Enter the date in 'dd/mm/yyyy' format
                    $dateError = 1;
                }
                else{
                    $datePart = explode("/",$strdate);

                    if(!checkdate((int)$datePart[1], (int)$datePart[0], (int)$datePart[2]))
                    	$dateError= 2;
                }
            }
        }

        return $dateError;
    }

    function validate_time($strtime){
        $timeError = 0;

        if($strtime != ''){
            //Check the length of the entered Time value
            if((strlen($strtime)<5)||(strlen($strtime)>5)){
                //Enter the time in 'hh:mm' 24 hours format
                $timeError = 1;
            }
            else{
                if((substr_count($strtime,":"))<>1){
                    //Enter the time in 'hh:mm' 24 hours format
                    $timeError = 1;
                }
                else{
                    $pos=strpos($strtime,":");
                    $hours=substr($strtime,0,($pos));
                    $result=ereg("^[0-9]+$",$hours,$trashed);

                    if(!($result))
                        //Enter a Valid hour
                        $timeError = 2;
                    else{
                        if(($hours<0) || ($hours>24))
                            //Enter a Valid hour
                            $timeError = 2;
                    }

                    $minutes=substr($strtime,($pos+1),($pos));
                    if(($minutes<0) || ($minutes>59))
                        //Enter a Valid Minute
                        $timeError = 3;
                    else{
                        $result=ereg("^[0-9]+$",$minutes,$trashed);
                        if(!($result))
                            //Enter a Valid Minute
                            $timeError = 3;
                    }
                }
            }
        }
        else
            return $timeError;

        return $timeError;
    }
	
	function Paged($sql){
		$page = $_REQUEST['page'];
		$page = ($page > 0) ? $page : 1;
		
		$list = $this->db->GetAll($sql);
		$total_rec = count($list);
		
		$per_page = PAGER_PER_PAGE;
		$total_page = ceil($total_rec/$per_page);
		$start = ($page*$per_page)-$per_page;
		
		unset($list);
		$list = $this->db->GetAll($sql." LIMIT $start,$per_page");
		
		$n = $start + 1;
		foreach ($list as $idx=>$row){
			$list[$idx]['num'] = $n;
			foreach($row as $key=>$val){
				$list[$idx][$key] = str_replace("\'","'", $val);
			}
			$n++;
		}
		return array($list,$total_rec, $total_page);
	}
	
	function GetBlank($tb_name){
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$tb_name."' AND table_schema = '".SQL_DB."'";
		$columns = $this->db->GetAll($sql);
		
		foreach($columns as $key=>$val){
			$blank[$val['COLUMN_NAME']] = '';
		}
		
		return $blank;
	}
	
	function GetDetail($tb_name, $id){
		$sql = "SELECT * FROM ".$tb_name." WHERE id = '".$id."'";
		$detail = $this->db->GetRow($sql);
		
		return $detail;
	}
	
	function CheckExist($tb_name, $field, $value, $id){
		$sql = "SELECT COUNT(*) FROM ".$tb_name." WHERE id != '".$id."' AND ".$field." = '".$value."'";
		$result = $this->db->GetOne($sql);
		return $result;
	}
	
	function SetPager($sql, $url='', $limit_per_page=0){
        if ($url == ''){
            $url = $_SERVER['REQUEST_URI'];
        }
        
        $url = preg_replace("/&page=\d+/", "", $url);
        
        
        if (!$limit_per_page|| $limit_per_page < 1){
            $limit_per_page = PAGER_PER_PAGE_CONSOLE;
        }
				
				if ( !isset($_GET['page']) )
				{
					$page = 1;
				}
				else
				{
					$page = (int)$_GET['page'];
				}
				
        // list(, $total_records) = $this->db->multiarray($sql);
				
        $total_record_sql = "SELECT COUNT(*)".substr($sql, strpos($sql, " FROM "), strlen($sql));
        $total_records = $this->db->GetOne($total_record_sql);
		// echo $total_records;
        
        $pager_url = $url."&page=";
        $kgPagerOBJ = new kgPager();
        $kgPagerOBJ->pager_set($pager_url, $total_records, PAGER_SCROLL_PAGE, $limit_per_page, $page, PAGER_INACTIVE_PAGE_TAG, PAGER_PREVIOUS_PAGE_TEXT, PAGER_NEXT_PAGE_TEXT, PAGER_FIRST_PAGE_TEXT, PAGER_LAST_PAGE_TEXT, '');
        $this->smarty->assign('pager_url', $pager_url.$page);

				$result_paging = "";
				if ($kgPagerOBJ->total_pages > 1)
				{
						$result_paging .= '<div class="w3-center">
<div class="w3-bar">'.$kgPagerOBJ->first_page.
						$kgPagerOBJ->previous_page.
						$kgPagerOBJ->page_links.
						$kgPagerOBJ->next_page.
						$kgPagerOBJ->last_page.
						'</div></div>';
				}
        if ($page <= 1){
            $this->smarty->assign('page', $page-1);
        }else{
            $this->smarty->assign('page', (($page-1)*$limit_per_page));
        }
        
        $this->smarty->assign('pager', $result_paging);
		
        
        $list = $this->db->GetAll($sql." LIMIT $kgPagerOBJ->start, $kgPagerOBJ->per_page");
        
        return $list;
    }
	
}
?>