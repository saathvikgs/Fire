<?php
sleep(3);
error_reporting(0);
include('conn.php');
$flag = 0;
$msg = "";
if(isset($_POST['pid'])){
	$pid = $_POST['pid'];
	$pn = $_POST['pname'];
	$md = $_POST['mod'];
	$cat = $_POST['cat'];
	$sel = $_POST['sel'];
	$stk = $_POST['stk'];
	$nstk = $_POST['nstk'];
	$prc = $_POST['prc'];
	
	
	$qr='update products set pname="'.$pn.'", mname="'.$md.'", category="'.$cat.'", seller="'.$sel.'", stock='.$stk.', numStock='.$nstk.', price='.$prc.' where pid='.$pid.'';
	
	$test = $conn->query($qr);
	
	if($test){
		$flag = 1;
		$msg = "Changes saved";
	}else{
		$flag = 2;
		$msg = $conn->error;	
	}
	echo $msg;
}
$conn->close();
?>