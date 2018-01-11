<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$flag = 0;
$msg = "";
if(isset($_POST['a'])){
	if($_POST['a']==1)
	{
		if(isset($_POST['pid']) && is_numeric($_POST['pid']) && isset($_POST['iid']) && is_numeric($_POST['iid']))
		{
			$pid = $_POST['pid'];
			$iid = $_POST['iid'];
			
			$qr3='select imageName from prodimage where pid='.$pid.' and addedon='.$iid.' LIMIT 1';
			$test3=$conn->query($qr3);
			$count2=$test3->num_rows;
			if($count2){
			$dt=$test3->fetch_array();
			$im=$dt['imageName'];
				if(file_exists('bigImage/'.$im)){
					unlink('bigImage/'.$im);
				}
				if(file_exists('smallImage/'.$im)){
					unlink('smallImage/'.$im);
				}
			}
			
			
			$stmt = $conn->prepare("delete from prodimage where pid=? and addedon=?");
				if ($stmt === false) {
					$flag = 2;
					$msg = trigger_error($conn->error, E_USER_ERROR);
					}
				$stmt->bind_param("ii", $pid, $iid);			
				$status = $stmt->execute();
				if ($status === false) {
					$flag = 2;
					$msg = trigger_error($stmt->error, E_USER_ERROR);
				}else{
					$flag = 1;
				}
				
				die('{"status":"'.$flag.'","msg":"'.$msg.'"}');
		}
	}else if($_POST['a']==2){
		if(isset($_POST['pid']) && is_numeric($_POST['pid']))
		{
			$pid = $_POST['pid'];
			$ds = "";
			$qr3='select displayImage from products where pid='.$pid.' LIMIT 1';
			$test3=$conn->query($qr3);
			$count2=$test3->num_rows;
			if($count2){
			$dt=$test3->fetch_array();
			$im=$dt['displayImage'];
				if(file_exists('displayImage/'.$im)){
					unlink('displayImage/'.$im);
				}
				$stmt = $conn->prepare("update products set displayImage=? where pid=?");
			if ($stmt === false) {
				  trigger_error($conn->error, E_USER_ERROR);
				}
			$stmt->bind_param("si", $ds, $pid);			
			$status = $stmt->execute();
			if ($status === false) {
				$flag = 2;
			  trigger_error($stmt->error, E_USER_ERROR);
			}else{
				$flag = 1;
			}
			}
			die('{"status":"'.$flag.'","msg":"'.$msg.'"}');
		}
	}
}
$conn->close();


?>