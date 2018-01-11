<?php
session_start();
include('conn.php');
	$usrid = 0;
	$flag = 0;
	$msg = "";
	$msg2 = "";
	$cct = "";
	$fgo = 0;
########
if(isset($_POST['txnid'])){
$fgo = 1;	
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=strtoupper($_POST["txnid"]);
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$ship='';
$bill='';
$salt="GQs7yium";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  } else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
		   $flag = 2;
	       $msg2 = '<font color="red">Invalid Transaction. Please try again</font>';
		   } else {
           $flag = 1;	              
		   }
		$oqry = $conn->query('select email,ship,bill,Date from orders where oid="'.$txnid.'" LIMIT 1'); 
		$oitem=$oqry->fetch_array();   
		$qry = $conn->query('select a.pid,a.units,a.price,b.pname from orderlist a,products b where a.oid="'.$txnid.'" and b.pid=a.pid'); 
		$cnt = $qry->num_rows;
		if($cnt){
			for($i=0;$i<$cnt;$i++){
				$item=$qry->fetch_array();
		   $subtotal = ($item['price']*$item['units']);       		
			  $cct.='<tr><td>'.$item['pid'].'</td>
                <td>'.$item['pname'].'</td>
                 <td>'.$item['price'].'</td>
				<td>'.$item['units'].'</td>
                <td>'.$subtotal.'</td>
            </tr>';
			}
		}
	   }
########	
	if($flag==1){
			$msg ='<font style="color:#6c0">Order Placed</font>';
			$msg2 ='Thank You for your order.<br/><br/>Your Transaction ID for this transaction is '.$txnid.'.<br/><br/>We have received a payment of Rs. ' . $amount . '.<br/><br/>Your order will soon be shipped.<br/><br/>You will receive an E-mail regarding the details of your order to the email address you have provided.';
			unset($_SESSION['old_cart']);
	}

	
?>
<html>
<head>
<title>Order details</title>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<script language="javascript" src="scripts/glfx14.js"></script>
<body>
<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="fontblack" style="font-size:32px">Place Order</div>
	 <div class="ordmsg">   
        <div class="fontblack" style="font-size:20px;padding:10px"><?php echo $msg; ?></div>
        <div class="font12"><?php echo $msg2; ?></div>
          </div>
     <?php if($flag==1)
	   { ?>
    <div class="tabsty">
       <table style="width:100%">
        	<tr>
            	<th>ORDER ID</th>
                <th>EMAIL ID</th>
                <th>SHIPPING ADDRESS</th>
                <th>BILLING ADDRESS</th>
                <th>ORDER DATE</th>
            </tr>
                <tr><td><?php echo $txnid; ?></td>
                <td><?php echo $oitem['email']; ?></td>
                <td><?php echo $oitem['ship']; ?></td>
                <td><?php echo $oitem['bill']; ?></td>
                <td><?php echo date("d-l-Y, h:m:s a",$oitem['Date']); ?></td>
            </tr>
        </table>
	</div>
    <div class="fontblack font16" style="margin:15px 0">PRODUCT LIST FOR ORDER ID : <?php echo $txnid; ?></div>
    <div class="tabsty">
    <?php if($cct!=''){ ?>
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
         <?php } ?>
	</div>
    <div style="font-size:30px;margin-top:10px">FINAL TOTAL : Rs.<?php echo $amount; ?></div>
    <?php } ?>
    </div>
    
<?php include('./footer.php'); ?>
</body>
</html>