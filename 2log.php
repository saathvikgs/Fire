<?php
session_start();
include('conn.php');
if(!isset($_SESSION["uid"]))
{
$rdct='';
if(isset($_POST['rdct']) && $_POST['rdct']!=''){
$rdct='&rdct='.$_POST['rdct'];	
}
	if(isset($_POST['usr']))
	 {
		 $user = $_POST['usr'];
		 $psw=$_POST['pwd'];
		 
		 if($user == "")
		 {
			 echo '<META http-equiv="refresh" content="0;URL=login.php?e=1'.$rdct.'">';
			 exit;
		 }else if($psw == "")
		 {
			 echo '<META http-equiv="refresh" content="0;URL=login.php?e=1'.$rdct.'">';
			 exit;
		 }
		 //$qur = "select * from logusers where uname='$user' and upass='$psw' LIMIT 1";
		 $qur = "select uid from loguser where email='$user' and upass='$psw' LIMIT 1";
		 $test = $conn->query($qur);
		 $count = $test->num_rows;
			 if($count)
				 {
					 $arr = $test->fetch_array();
					 $_SESSION["uid"] = $arr['uid'];
					 $_SESSION["username"]=$user;
					 	if(isset($_POST['rdct']) && $_POST['rdct']!=''){
						echo '<META http-equiv="refresh" content="0;URL='.$_POST['rdct'].'">';
					 	exit;	
						}else{
					 echo '<META http-equiv="refresh" content="0;URL=login.php?a=1'.$rdct.'">';
					 exit;
						}
				 }else{
					 
					 echo '<META http-equiv="refresh" content="0;URL=login.php?e=2'.$rdct.'">';
					 exit;
				 }
	 }
}
echo '<META http-equiv="refresh" content="0;URL=login.php?e=3'.$rdct.'">';
exit;
?>