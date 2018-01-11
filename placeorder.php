<?php
session_start();
include('../conn.php');
$recvord = "";
if(isset($_POST['placeord']))
{
		$recvord = $_POST['placeord'];
		$recvlist = explode(':',$recvord);
		
		print_r($recvlist);
		
}


?>