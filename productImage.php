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
	
		if($width>800)
		{
			$bigW=800;
		}else{
				$bigW=$width;
		}
		
	$bigH=($height/$width)*$bigW;
	$bigSize=imagecreatetruecolor($bigW,$bigH);
	
	$smallW=275;
	$smallH=($height/$width)*$smallW;
	$smallSize=imagecreatetruecolor($smallW,$smallH);	
	
	imagecopyresampled($bigSize,$do,0,0,0,0,$bigW,$bigH,$width,$height);
	
	imagecopyresampled($smallSize,$do,0,0,0,0,$smallW,$smallH,$width,$height);
		
		 //all photos are converted to jpg
		 $extension='jpg';
		 $imgname=time().'_'.$pid.'.'.$extension;
		 	 
		 $bpath='bigImage/'.$imgname;
		 $spath='smallImage/'.$imgname;
		 
		 $done=imagejpeg($bigSize,$bpath,90);
		 imagejpeg($smallSize,$spath,90);
		
		 
		 imagedestroy($do);
		 imagedestroy($bigSize);
		 imagedestroy($smallSize);
		 
		 if($done)
		 {
$added=time();			 		 
$test=$conn->query('insert into prodImage(pid,imageName,addedon) values('.$pid.',"'.$imgname.'",'.$added.')');
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