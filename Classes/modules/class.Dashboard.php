<?php
class Dashboard extends Front{
	function LoadDefault(){
		$this->smarty->assign('PageTitle', "DASHBOARD");
		$content = $this->smarty->fetch('TPL_Dashboard_LoadDefault.php');
		return $content;
	}	
}
?>