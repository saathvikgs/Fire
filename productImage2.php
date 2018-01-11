<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
if($_FILES['imgg']['name']!='')
	{
	$image1=$_FILES['imgg']['name'];
	
	if($image1)
	{
		$filename=stripslashes($_FILES['imgg']['name']);
	}
	
$exts = array("doc", "docx", "pdf","txt","jpg","jpeg","png","gif");
$temp = explode(".", $_FILES["imgg"]["name"]);
$extension = end($temp);
$extension = strtolower($extension);
	
	 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
	 {
		die('{"aq":"1","msg":"Wrong file format"}');
	 }
	
		 if($_FILES['imgg']['error']==1){
			 die('{"aq":"2","msg":"File size is too large"}');
		  }
 	if(!isset($_POST['pid']) || !is_numeric($_POST['pid']))
	{
			die('{"aq":"3","msg":"ID not set check data post"}');	
	}
	$pid=$_POST['pid'];
	$imageData=$_FILES['imgg']['tmp_name'];
	if($extension=="jpg" || $extension=="jpeg")
	{
		$do=imagecreatefromjpeg($imageData);
	}
	if($extension=="png")
	{
		$do=imagecreatefrompng($imageData);
	}
	if($extension=="gif")
	{
		$do=imagecreatefromgif($imageData);
	}

	list($width,$height)=getimagesize($imageData);				
	
	
	$smallW=300;
	$smallH=($height/$width)*$smallW;
	$smallSize=imagecreatetruecolor($smallW,$smallH);	
	
	imagecopyresampled($smallSize,$do,0,0,0,0,$smallW,$smallH,$width,$height);
		
		 $extension='jpg';
		 $imgname=$pid.'.'.$extension;
		 	 
		 $spath='displayImage/'.$imgname;
		 
		 $done=imagejpeg($smallSize,$spath,90);
		
		 
		 imagedestroy($do);
		 imagedestroy($smallSize);
		 
		 if($done)
		 {
$added=time();			 		 
$test=$conn->query('update products set displayImage="'.$imgname.'" where pid='.$pid.'');
			if($test){
				$msg="Image added";
			}else{
				$msg=$conn->error;	
			}
			//upload done;
			echo '{"aq":"4","msg":"'.$msg.'","img":"'.$imgname.'","iid":"'.$added.'"}';
			
		 }
	}
$conn->close();


?>