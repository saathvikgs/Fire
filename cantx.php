<?php
$msg = "Transaction process canceled by user."; 
?>
<html>
<head>
<title>Transaction canceled</title>
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