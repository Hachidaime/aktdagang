<?php
class User extends Front{
	public function __construct(){
		parent::__construct();
		
		//Check user Access
		if($this->login_id > 0 && ($_GET['method'] = 'UserLogin' || $_GET['method'] = 'UserLogout')){
			$sql = "SELECT permission FROM tuser WHERE id = '".$this->login_id."'";
			
			$permission = $this->db->GetOne($sql);
			
			if($permission != 1){
				header('Location: index.php?class=MissingPage&method=LoadForbidden');
			}
		}
	}
	
	function LoadDefault(){
		$sql = "SELECT * FROM tuser WHERE id > 0 ORDER BY user_name ASC";
		$list = $this->db->GetAll($sql);
		// echo $sql;
		// print_r($list);
		
		$this->smarty->assign('permission_options', $this->config['permission_options']);
		
		$this->smarty->assign('list', $list);
		$this->smarty->assign('login_id', $this->login_id);
		$this->smarty->assign('PageTitle', "MASTER USER");
		$content = $this->smarty->fetch("TPL_User_LoadDefault.php");
		return $content;
	}
	
	function LoadForm(){
		$id = ($_GET['id']) ? $_GET['id'] : $_POST['id'];
		
		if($id > 0){
			$detail = $this->GetDetail("tuser", $id);
			$this->smarty->assign($detail);
		}
		
		$this->smarty->assign('permission_options', $this->config['permission_options']);
		$this->smarty->assign('PageTitle', "MASTER USER");
		$content = $this->smarty->fetch("TPL_User_LoadForm.php");
		return $content;
	}
	
	function SubmitData(){
		$error = $this->ValidateData($_POST);
		$id = 0;
		if(!$error){
			$id = $this->ProcessData($_POST);
		}
		else{
			$this->sys_msg['error'] = $error;
		}
		
		$msg = processSysMsg();
		$result = array();
		
		$result['id'] = $id;
		$result['msg'] = $msg;
		
		echo json_encode($result);
	}
	
	function ValidateData($data){
		if($data['user_name'] == ''){
			$error[] = "<b>Username</b> tidak boleh kosong.\n";
		}
		else{
			if(!ctype_alnum($data['user_name'])){
				$error[] = "<b>Username</b> hanya boleh dalam alfanumerik.";
			}
		}
		
		if($data['user_name'] != ''){
			$sql = "SELECT COUNT(user_name) FROM tuser WHERE user_name = '".$data['user_name']."' AND id != '".$data['id']."'";
			$count = $this->db->GetOne($sql);
			
			if($count > 0){
				$error[] = "<b>Username</b> sudah ada di database.";
			}
		}
		
		if($data['id'] == ''){
			if($data['user_password'] == ''){
				$error[] = "<b>Password</b> tidak boleh kosong.\n";
			}
		}
		
		if($data['nama'] == ''){
			$error[] = "<b>Nama</b> tidak boleh kosong.\n";
		}
		
		if($data['permission'] == '0'){
			$error[] = "<b>Level Akses</b> harus dipilih.\n";
		}
		
		return $error;
	}
	
	function ProcessData($data){
		$id = (int)$data['id'];
		$cond = "";
		$cond .= "user_name = '".formatSQL($data['user_name'])."',";
		if($data['user_password'] != ''){
			$cond .= "user_password = '".formatSQL($data['user_password'])."',";
		}
		$cond .= "permission = '".formatSQL($data['permission'])."',";
		$cond .= "nama = '".formatSQL($data['nama'])."',";
		
		if($id > 0){
			$sql = "UPDATE tuser SET
				$cond
				update_dt = NOW()
				WHERE id = '".$data['id']."'
			";
			
			$tag = "Ubah";
			$result = $this->db->Execute($sql);
		}
		else{
			$sql = "INSERT INTO tuser SET
				$cond
				insert_dt = NOW()
			";
			$tag = "Buat";
			$result = $this->db->Execute($sql);
			$id = $this->db->Insert_id();
			$this->sys_msg['warning'][] = "Mohon untuk tidak menyegarkan halaman untuk mencegah data ganda.";
		}
		
		if($result){
			$this->sys_msg['info'][] = $tag." Akun [{$data['user_name']}] Berhasil.";
			WriteSysLog("Akun",$tag," id [{$id}] nama [{$data['user_name']}] berhasil");
			return $id;
		}
		else{
			$this->sys_msg['error'][] = $tag." Akun Gagal.";
		}
	}
	
	function DeleteData(){
		$id = $_POST['id'];
		$data = $this->GetDetail("tuser", $id);
		
		$sql = "DELETE FROM tuser WHERE id = '".$id."'";
		$result = $this->db->Execute($sql);
		$tag = "Hapus";
		
		if($result){
			$this->sys_msg['info'][] = $tag." Akun [{$data['user_name']}] Berhasil.";
			WriteSysLog("Akun",$tag," id [{$id}] nama [{$data['user_name']}] berhasil");
		}
		else{
			$this->sys_msg['error'][] = $tag." Akun Gagal.";
		}
		
		echo json_encode($this->sys_msg);
	}	
	
	function UserLogin(){
		if($_POST['user_name'] == ''){
			$error[] = "<b>Username</b> tidak boleh kosong.\n";
		}
		
		if($_POST['user_password'] == ''){
			$error[] = "<b>Password</b> tidak boleh kosong.\n";
		}
		
		if(!$error){
			$sql = "SELECT * FROM tuser WHERE user_name = '".formatSQL($_POST['user_name'])."' AND user_password = '".$_POST['user_password']."'";
			// echo $sql;
			$detail = $this->db->GetRow($sql);
			// print_r($detail);
			$count = count($detail);
			if($count > 0){
				session_start();
				$_SESSION['USER'] = $detail;
				
			}
			else{
				$error[] = "[Username] atau [Password] salah.";
				
			}
		}
		
		$success = "Login Success!";
		
		$result = array();
		$result['error'] = ($error) ? 1 : 0;
		$result['message'] = ($error) ? $error : $success;
		$result['message'] = is_array($result['message']) ? implode("|", $result['message']) : $result['message'];
		$result['message'] = strip_tags($result['message']);
		$result['message'] = explode("|", $result['message']);
		
		$result['session'] = $_SESSION;
		
		echo json_encode($result);
	}
	
	function UserLogout(){
		session_start();
		$result['result'] = (session_destroy()) ? 1 : 0;
		
		echo json_encode($result);
	}
}

?>