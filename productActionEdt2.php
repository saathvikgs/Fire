<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$flag = 0;
$msg = "";
if(isset($_POST['pid']) && isset($_POST['a'])){
	
	if($_POST['a']==1){
		
	$pid = $_POST['pid'];
	$kf = $_POST['kf'];
	$ds = $_POST['ds'];
	
	$test=$conn->query('select pid from prodkeyfeature where pid='.$pid.' LIMIT 1');
	$count=$test->num_rows;
		if($count){			
			$stmt = $conn->prepare("update prodkeyfeature set description=?, keyfeature=? where pid=?");
			if ($stmt === false) {
				  trigger_error($conn->error, E_USER_ERROR);
				}
			$stmt->bind_param("ssi", $ds, $kf, $pid);			
			$status = $stmt->execute();
			if ($status === false) {
				$flag = 2;
			  trigger_error($stmt->error, E_USER_ERROR);
			}else{
				$flag = 1;
				$msg="Key features saved";
			}
		}else{
			$stmt = $conn->prepare("insert into prodkeyfeature (pid, description, keyfeature) values(?, ?, ?)");
			if ($stmt === false) {
				  trigger_error($conn->error, E_USER_ERROR);
				}
			$stmt->bind_param("iss", $pid, $ds, $kf);			
			$status = $stmt->execute();
			if ($status === false) {
				$flag = 2;
			  trigger_error($stmt->error, E_USER_ERROR);
			}else{
				$flag = 1;
				$msg="Key features saved";
			}
		}
	
	
		if($flag==1){
			$msg = $msg;
		}else if($flag==2){
			$msg = $conn->error;	
		}
		echo $msg;
	
	}else if($_POST['a']==2){
		$pid = $_POST['pid'];
		$ft = $_POST['ttl'];
		$ds = $_POST['ds'];
		$stmt = $conn->prepare("insert into prodfeature (pid, addedon, title, feature) values(?, ?, ?, ?)");
			if ($stmt === false) {
				$flag = 2;
				$msg = trigger_error($conn->error, E_USER_ERROR);
				}
			$tim = time();
			$stmt->bind_param("iiss", $pid, $tim, $ft, $ds);			
			$status = $stmt->execute();
			if ($status === false) {
				$flag = 2;
			    $msg = trigger_error($stmt->error, E_USER_ERROR);
			}else{
				$flag = 1;
			}
			
			die('{"status":"'.$flag.'","iid":"'.$tim.'","msg":"'.$msg.'"}');
	}
}
$conn->close();
?>