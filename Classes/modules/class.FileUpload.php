<?php
class FileUpload extends Front{
	function UploadData(){
		$output_dir = "upload/temp/";
		if(isset($_FILES["myfile"]))
		{
			$ret = array();
			
		//	This is for custom errors;	
		/*	$custom_error= array();
			$custom_error['jquery-upload-file-error']="File already exists";
			echo json_encode($custom_error);
			die();
		*/
			$error =$_FILES["myfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES["myfile"]["name"])) //single file
			{
				$fileName = $_FILES["myfile"]["name"];
				move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
				$ret[]= $fileName;
			}
			else  //Multiple files, file[]
			{
			  $fileCount = count($_FILES["myfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
				$fileName = $_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
				$ret[]= $fileName;
			  }
			
			}
			echo json_encode($ret);
		}
	}
	
	function Deletedata(){
		$output_dir = "upload/temp/";
		
		if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
		{
			$fileName =$_POST['name'];
			$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
			$filePath = $output_dir. $fileName;
			if (file_exists($filePath)) 
			{
				unlink($filePath);
			}
			echo "Deleted File ".$fileName."<br>";
		}
	}
}
?>