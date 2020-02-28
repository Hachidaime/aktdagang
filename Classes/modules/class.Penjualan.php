<?php
class Penjualan extends Front{
    var $title = "PENJUALAN";
    var $table = "penjualan";
    var $tpl_dir = "Penjualan";
    
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
            $where = "";
        }
        
        $sql = "SELECT * FROM ".$this->table." WHERE id > 0 AND periode_id = '".$this->periode['id']."' $where ORDER BY tanggal ASC, id ASC";
        $list = $this->db->GetAll($sql);
        
        foreach($list as $idx=>$row){
            $list[$idx]['penjualan_formated'] = number_format($list[$idx]['penjualan'], 2, ',', '.');
            $list[$idx]['potongan_formated'] = number_format($list[$idx]['potongan'], 2, ',', '.');
        }
        
        $sql = "SELECT id, nomor, nama FROM akun WHERE id > 0 ORDER BY nomor ASC";
        $akun = $this->db->GetAll($sql);
        if($akun){
            foreach($akun as $idx=>$row){
                $akun_options[$row['id']] = $row['nomor'];
            }
        }
        
        $this->smarty->assign('periode', $this->periode);
        $this->smarty->assign('bulan_options', $this->config['bulan_options']);
        $this->smarty->assign('bulan3_options', $this->config['bulan3_options']);
        $this->smarty->assign('list', $list);
        $this->smarty->assign('akun_options', $akun_options);
        $this->smarty->assign($_GET);
        $template = getTemplate($this->tpl_dir, __FUNCTION__);
        $content = $this->smarty->fetch($template);
        echo json_encode($content);
        exit();
    }
    
    function LoadForm(){
        $sql = "SELECT id, nomor, nama FROM akun WHERE id > 0 ORDER BY nomor ASC";
        $akun = $this->db->GetAll($sql);
        
        $this->smarty->assign($_GET);
        $this->smarty->assign('PageTitle', $this->title);
        $this->smarty->assign('periode', $this->periode);
        $this->smarty->assign('bulan_options', $this->config['bulan_options']);
        $this->smarty->assign('akun', $akun);
        
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
        if($data['tanggal'] == 0){
			$msg['tanggal'] = "<b>Tanggal</b> tidak boleh kosong.";
            $error = 1;
		}
        
		if(empty($data['uraian'])){
			$msg['nama'] = "<b>Uraian</b> tidak boleh kosong.";
            $error = 1;
		}
		
        if($error) $this->sys_msg['error'] = $msg;
		return $error;
    }
    
    function Process($data){
        $values = array();
        $values[] = "periode_id = ".$this->periode['id'];
        foreach($data as $key=>$val){
            if($key != 'id'){
                if($key == 'penjualan' || $key == 'potongan'){
                    $values[] = $key . " = '" . (float)$val . "'"; 
                }
                else{
                    $values[] = $key . " = '" . formatSQL($val) . "'";                    
                }
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
//        echo $sql;
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