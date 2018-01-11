<?php
sleep(5);
include('conn.php');
$flag = 0;
$msg = "";
if(isset($_POST['email']))
{
	$email= $_POST['email'];
	$cmail= $_POST['cemail'];
	$pwd=$_POST['pass'];
	$cpwd=$_POST['cpass'];
	$ph=$_POST['phone'];
	$bill=$_POST['billing'];
	$ship=$_POST['shipp'];
	 $tym=time();
	 $st=1;
	 
	 $qur1='select * from loguser where email="'.$email.'" LIMIT 1';
	 $test1=$conn->query($qur1);
	 $count=$test1->num_rows;
	 if($count==0)
	 {
		 $qur = "insert into loguser(email,upass,shipping,billing,logtime,phone,status) values('$email','$pwd','$ship','$bill',$tym,'$ph',$st)";
		 $test = $conn->query($qur);
		 if($test==true)
		 {
			 $flag = 1;
			 $msg = "Account has been registered, check your Email for activation link";
		 }
		 else
		 {
			 $flag = 2;
			 $msg = 'failed to register'.$conn->error;
			 
		 }
	 }
	 else
		 {
			 $flag = 2;
			 $msg = 'Already registered';
		 }
}
$conn->close();
echo '{"flag":"'.$flag.'","msg":"'.$msg.'"}';
?>
