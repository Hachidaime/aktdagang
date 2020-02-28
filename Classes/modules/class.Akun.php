<?php
class Akun extends Front{
    var $title = "AKUN";
    var $table = "akun";
    var $tpl_dir = "Akun";
    
    function LoadDefault(){
        $this->smarty->assign($_GET);
        $this->smarty->assign('PageTitle', $this->title);
        $this->smarty->assign('AddNew', $this->AddNew());
        
        $template = getTemplate($this->tpl_dir, __FUNCTION__);
        $content = $this->smarty->fetch($template);
        return $content;
    }
    
    function LoadSearch(){
        if(!empty($_POST['keyword'])){
            $where = "AND nomor LIKE '%".$_POST['keyword']."%' OR nama LIKE '%".$_POST['keyword']."%'";
        }
        
        $sql = "SELECT * FROM ".$this->table." WHERE id > 0 $where ORDER BY nomor ASC";
        $list = $this->db->GetAll($sql);
        
        $this->smarty->assign('dk_options', $this->config['dk_options']);
        $this->smarty->assign('nrlr_options', $this->config['nrlr_options']);
        $this->smarty->assign('list', $list);
        $this->smarty->assign($_GET);
        $template = getTemplate($this->tpl_dir, __FUNCTION__);
        $content = $this->smarty->fetch($template);
        echo json_encode($content);
        exit();
    }
    
    function LoadForm(){
        
        $this->smarty->assign($_GET);
        $this->smarty->assign('PageTitle', $this->title);
        $this->smarty->assign('dk_options', $this->config['dk_options']);
        $this->smarty->assign('nrlr_options', $this->config['nrlr_options']);
        
        $template = getTemplate($this->tpl_dir, __FUNCTION__);
        $content = $this->smarty->fetch($template);
        return $content;
    }
    
    function Detail(){
        $detail = $this->getDetail($this->table, $_POST['id']);
        echo json_encode($detail);
        exit();
    }
    
    function Submit(){
        $data = $_POST;
        $error = $this->Validate($data);
        
		if(!$error){
			$this->Process($data);
		}
		$msg = processSysMsg();
        
        $result = array();
		$result['msg'] = $msg;
		$result['error'] = $error;
        echo json_encode($result);
    }
    
    function Validate($data){
        $error = 0;
        if(empty($data['nomor'])){
			$msg['nomor'] = "<b>Nomor Akun</b> tidak boleh kosong.";
            $error = 1;
		}
        
		if(empty($data['nama'])){
			$msg['nama'] = "<b>Nama Akun</b> tidak boleh kosong.";
            $error = 1;
		}
		
        if($error) $this->sys_msg['error'] = $msg;
		return $error;
    }
    
    function Process($data){
//        global $db;
        $values = array();
        foreach($data as $key=>$val){
            if($key != 'id'){
                $values[] = $key . " = '" . formatSQL($val) . "'";
            }
        }
        
        if($data['id'] > 0){
            $sql = formatUpdate($this->table, $values, array('id = ' . $data['id']));
            $tag = "Ubah";
        }
        else{
            $sql = formatInsert($this->table, $values);
            $tag = "Tambah";
        }
        $result = $this->db->Execute($sql);
//        $rs = $this->db->Execute("INSERT INTO akun SET nomor = '1-000', nama = 'AKTIVA'");
        
        if($result){
            $this->sys_msg['info'][] = $tag." ".$this->title." Berhasil.";
        }
        else{
            $this->sys_msg['error'][] = $tag." ".$this->title." Gagal.";
        }
        
    }
    
    function Delete(){
        
    }
}
?>