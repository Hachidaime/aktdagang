<?php
class Periode extends Front{
    var $title = "PERIODE";
    var $table = "periode";
    var $tpl_dir = "Periode";
    
    function LoadDefault(){
        $this->smarty->assign($_GET);
        $this->smarty->assign('PageTitle', $this->title);
        $this->smarty->assign('AddNew', $this->AddNew());
        
        $template = getTemplate($this->tpl_dir, __FUNCTION__);
        $content = $this->smarty->fetch($template);
        return $content;
    }
    
    function LoadSearch(){
        $sql = "SELECT * FROM ".$this->table." WHERE id > 0 $where ORDER BY tahun ASC, bulan ASC";
        $list = $this->db->GetAll($sql);
        if($list){
            foreach($list as $idx=>$row){
                $list[$idx]['checked'] = ($row[aktif] == 1) ? "checked" : "";
            }
        }
        
        $this->smarty->assign('bulan_options', $this->config['bulan_options']);
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
        $this->smarty->assign('bulan_options', $this->config['bulan_options']);
        
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
        if(is_null($data['bulan'])){
			$msg['bulan'] = "<b>Bulan</b> harus dipilih.";
            $error = 1;
		}
        
		if(empty($data['tahun'])){
			$msg['tahun'] = "<b>Tahun</b> tidak boleh kosong.";
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
        
        if($result){
            $this->sys_msg['info'][] = $tag." ".$this->title." Berhasil.";
        }
        else{
            $this->sys_msg['error'][] = $tag." ".$this->title." Gagal.";
        }
        
    }
    
    function Activate(){
        $id = $_POST['id'];
        
        $detail = $this->getDetail($this->table, $id);
        $sql = formatUpdate($this->table, array('aktif = 0'), array());
        $rs = $this->db->Execute($sql);
        
        if($rs){
            $sql = formatUpdate($this->table, array('aktif = 1'), array('id = ' . $id));
            $result = $this->db->Execute($sql);
            
        }
        
        if($rs){
            $msg = "Periode Aktif: " . $this->config['bulan_options'][$detail['bulan']] . " " . $detail['tahun'];
        }
        else{
            $msg = "Ubah Periode Aktif Gagal";
        }
        
        $result = array();
        $result['msg'] = $msg;
        $result['sql'] = $sql;
        
        echo json_encode($result);
        exit();
    }
    
    function Delete(){
        
    }
}
?>