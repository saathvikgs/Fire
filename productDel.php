<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$flag = 0;
$msg = "";
$pid = 0;
		if(isset($_POST['pid']) && is_numeric($_POST['pid']))
		{
			$pid = $_POST['pid'];
			$qr='select displayImage from products where pid='.$pid.' LIMIT 1';
			$test=$conn->query($qr);
			$count=$test->num_rows;
			if($count){
					$dta=$test->fetch_array();
					if($dta['displayImage']!="")
					{
						if(file_exists('displayImage/'.$dta['displayImage'])){
							unlink('displayImage/'.$dta['displayImage']);	
						}
					}
			}
			$qr2='select imageName from prodimage where pid='.$pid.'';
			$test2=$conn->query($qr2);
			$count2=$test2->num_rows;
			if($count2){
				for($i=0;$i<$count2;$i++)
				{
					$dt=$test2->fetch_array();
					$im=$dt['imageName'];
					if(file_exists('bigImage/'.$im)){
						unlink('bigImage/'.$im);
					}
					if(file_exists('smallImage/'.$im)){
						unlink('smallImage/'.$im);
					}
				}
			}
			
			
			$stmt = $conn->prepare("delete from products where pid=?");
				if ($stmt === false) {
					$flag = 2;
					$msg = trigger_error($conn->error, E_USER_ERROR);
					}
				$stmt->bind_param("i", $pid);			
				$status = $stmt->execute();
				if ($status === false) {
					$flag = 2;
					$msg = trigger_error($stmt->error, E_USER_ERROR);
				}else{
					$flag = 1;
				}
				
				
		}

$conn->close();

die('{"status":"'.$flag.'","msg":"'.$msg.'"}');
?>