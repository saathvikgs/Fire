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
		$stmt = $conn->prepare("delete from prodkeyfeature where pid=?");
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
	
	
	}else if($_POST['a']==2){
		$pid = $_POST['pid'];
		$iid = $_POST['iid'];
		$stmt = $conn->prepare("delete from prodfeature where pid=? and addedon=?");
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
}
$conn->close();
?>