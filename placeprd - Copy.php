<?php
session_start();
include('conn.php');
	$usrid = 0;
	$email = '';
	$ship = '';
	$bill = '';
	$phnum = '';
	$flag = 0;
	$msg = "";
	$total = 0;
	$msg2 = "";
	$cct = "";
	if(isset($_SESSION['uid']) && isset($_POST['email']))
	{
		$usrid = $_SESSION['uid'];
		$email = $_POST['email'];
		$ship =  $_POST['ship'];
		$bill = $_POST['bill'];
		$phnum = $_POST['phone'];
	
	$ordid = time();
	$type = 1;
	$stat = 1;
	$date = time();
	
	$stmt = $conn->prepare( 'insert into orders(oid,uid,typ,status,email,bill,ship,phnum,Date) values(?,?,?,?,?,?,?,?,?)');
			if ($stmt === false) {
				$msg = trigger_error($conn->error, E_USER_ERROR);
				}
			$stmt->bind_param("iiiissssi", $ordid, $usrid, $type, $stat,$email,$ship,$bill,$phnum,$date);			
			$status = $stmt->execute();
			if ($status === false) {
			    $msg = trigger_error($stmt->error, E_USER_ERROR);
			}
	
	if(isset($_SESSION['cart']))
	{
			
		foreach ($_SESSION['cart'] as $item)
		{
			$subtotal = ($item['prc2']*$item['qtt']);       		
			  $cct.='<tr><td>'.$item['pid'].'</td>
                <td>'.$item['name'].'</td>
                 <td>'.$item['prc2'].'</td>
				<td>'.$item['qtt'].'</td>
                <td>'.$subtotal.'</td>
            </tr>';
        
        $total = ($total + $subtotal);
		$flag = 1;
			$ins1 = 'insert into orderlist(oid,pid,units,price) values('.$ordid.','.$item['pid'].','.$item['qtt'].','.$item['prc2'].')';
			$qy1 = $conn->query($ins1);
    }
			
			
		
	if($flag==1){
			$msg ='<font style="color:#6c0">Order Placed</font>';
			$msg2 ='Thank You for your order. You will receive an E-mail regarding the details of your order to the email address you have provided.';
			unset($_SESSION['cart']);
	}
}else{
    $msg = '<div style="font-size:14px;text-align:center">Your cart is empty</div>';
}
	
	}else {$msg = '<div style="font-size:14px;text-align:center">Youre not logged</div>';}
?>
<html>
<head>
<title>My account</title>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="fontblack" style="font-size:32px">Place Order</div>
	 <div class="ordmsg">   
        <div class="fontblack" style="font-size:20px"><?php echo $msg; ?></div>
        <div><?php echo $msg2; ?></div>
          </div>
     <?php if($flag==1)
	   { ?>
    <div class="tabsty">
       <table>
        	<tr>
            	<th>ORDER ID</th>
                <th>EMAIL ID</th>
                <th>SHIPPING ADDRESS</th>
                <th>BILLING ADDRESS</th>
                <th>ORDER DATE</th>
            </tr>
                <tr><td><?php echo $ordid; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $ship; ?></td>
                <td><?php echo $bill; ?></td>
                <td><?php echo date("d-l-Y, h:m:s a",$date); ?></td>
            </tr>
        </table>
	</div>
    <div class="fontblack font16" style="margin:15px 0">PRODUCT LIST FOR ORDER ID : <?php echo $ordid; ?></div>
    <div class="tabsty">
       <table>
        	<tr>
            	<th>PRODUCT ID</th>
                <th>PRODUCT NAME</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>SUBTOTAL</th>
            </tr>
            <?php echo $cct; ?>
         </table>
	</div>
    <div style="font-size:30px;margin-top:10px">FINAL TOTAL : Rs.<?php echo $total; ?></div>
    <?php } ?>
    </div>
    
<?php include('./footer.php'); ?>
</body>
</html>