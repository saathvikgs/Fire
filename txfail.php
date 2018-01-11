<?php
$msg = "";
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=strtoupper($_POST["txnid"]);

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
	       $msg = 'Invalid Transaction. Please try again';
		   }
	   else {

         $msg = 'Transaction failed for ID '.$txnid;
          
		 } 
?>
<html>
<head>
<title>Transaction failed</title>
<script language="javascript" src="scripts/glfx14.js"></script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>
<?php include('./navbar.php'); ?>
	<div class="clmain">
        <div id="prodisp">
        <div class="ordmsg">
                <div class="font12"><?php echo $msg; ?></div>
        </div> 
        </div>
	</div>	
<?php include('./footer.php'); ?>
</body>
</html>