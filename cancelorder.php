<?php
session_start();
include("conn.php");
$ret = "";
if(isset($_SESSION['uid']))
{
	if(isset($_GET['oid']))
	{
		$ordid = $_GET['oid'];
		$usrid = $_SESSION['uid'];
		$upd = 'update orders set status=4 where oid="'.$ordid.'" and uid="'.$usrid.'"';
		$upd2 = $conn->query($upd);
		//$cnt = $upd2->num_rows;
		if($upd2)
		{
			echo "Cancelled";	
		}
	}
			
}

?>