<?php
session_start();
include('conn.php');
	$usrid = 0;
	$db_email = '';
	$db_ship = '';
	$db_bill = '';
	$db_phnum = '';
	$flag = 0;
	$msg = "";
	$msg2 = "";
$cct = '';
$total = 0;
$crtCnt = 0;
$MERCHANT_KEY = "JBZaLc";
$SALT = "GQs7yium";
$PAYU_BASE_URL = "https://test.payu.in";
$action = '';
$posted = array();
$formError = 0;
if(isset($_SESSION['uid']))
	{
		$usrid = $_SESSION['uid'];
	}
	if($usrid!=0){
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 	
  }
}

if(empty($posted['txnid'])) {
  $txnid = strtoupper(substr(hash('sha256', mt_rand() . microtime()), 0, 20));
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$formError = 2;
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} 
/*elseif(!empty($posted['hash'])) {
  $formError = 2;
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
*/
if(isset($_SESSION['cart']))
	{
		$crtCnt = count($_SESSION['cart']);
    foreach ($_SESSION['cart'] as $item)
    {
		$subtotal = ($item['prc2']*$item['qtt']);
		$img = "";
			  if($item['img'] != "")
			  {
				$img = '<img src="displayImage/'.$item['img'].'" style="width:120px" alt="" />';
			  }
        $cct.='<div style="background:#fff;position:relative;width:600px;text-align:left;padding:10px;border:1px #ccc solid">
               <div class="fontBT fontblack font16" style="font-weight:bold" id="proname">'.$item['name'].'</div>
               <div><a href="v.php?pid='.$item['pid'].'"><div class="dispblk cartImg" style="background:#ddd">'.$img.'</div></a>
               <div class="dispblk" style="width:450px;padding:8px">
                    <div style="margin-top:25px">
                    	<div class="dispblk fontblack" style="font-size:20px"><b>Rs. '.$item['prc'].'</b></div>        		
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px">'.$item['off'].'</div>
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px;text-decoration:line-through">'.$item['cut'].'</div>
						<div class="dispblk fontblack" style="margin:5px 0 0 15px;font-size:20px">Rs. '.$item['prc2'].'</div> 
						<div class="dispblk fontblack font14" style="margin:5px 0 0 5px">x'.$item['qtt'].'</div> 
                    </div>
               </div>
               <div style="position:absolute;bottom:10px;right:10px">
               		<div class="fontblack font15">Sub Total</div>
               		<div class="fontblack" style="font-size:20px">Rs.'.$subtotal.'</div>
               </div>
               </div>
            </div>';
        
        $total = ($total + $subtotal);
    }
	
}

if($formError == 2){

	$ordid = $txnid;
	$type = 1;
	$stat = 1;
	$date = time();
	$db_email=$posted['email'];
	$db_ship=$posted['shipping_address1'];
	$db_bill=$posted['shipping_address2'];
	$db_phnum=$posted['phone'];
	$stmt = $conn->prepare( 'insert into orders(oid,uid,typ,status,email,bill,ship,phnum,Date) values(?,?,?,?,?,?,?,?,?)');
			if ($stmt === false) {
				$msg = trigger_error($conn->error, E_USER_ERROR);
				}
			$stmt->bind_param("siiissssi", $ordid, $usrid, $type, $stat,$db_email,$db_ship,$db_bill,$db_phnum,$date);			
			$status = $stmt->execute();
			if ($status === false) {
			    $msg = trigger_error($stmt->error, E_USER_ERROR);
			}
	
	if(isset($_SESSION['cart']))
	{
			
		foreach ($_SESSION['cart'] as $item)
		{
		$flag = 1;
			$ins1 = 'insert into orderlist(oid,pid,units,price) values("'.$ordid.'",'.$item['pid'].','.$item['qtt'].','.$item['prc2'].')';
			$qy1 = $conn->query($ins1);
    	}
			
	if($flag==1){
			$_SESSION['old_cart'] = $_SESSION['cart'];
			unset($_SESSION['cart']);
	}
}	
}
	}
?> 
<html>
<head>
<title>Checkout</title>
<script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.getElementById('payForm');
      payuForm.submit();
    }
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body onLoad="submitPayuForm()">
<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="fontblack" style="font-size:32px;padding:10px"">Checkout</div>
	 <div style="width:1000px;margin:0 auto;padding:15px;background:#EBEBEB;border:1px #ccc solid;">   
     <div class="dispblk font13" style="width:380px">
     <?php 
	 	 if($usrid!=0){
		 if($crtCnt>0){
		 if($formError == 1) { ?>	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
        <form id="payForm" action="<?php echo $action; ?>" method="post">
        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
        <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" /> 
        <input type="hidden" name="amount" value="<?php echo (empty($posted['firstname'])) ? $total : $posted['amount']; ?>" />  
        <input type="hidden" name="productinfo" value="qweqwe" />    
		<input type="hidden" name="surl" value="http://127.0.0.1/fire/placeprd.php" />                       
        <input type="hidden" name="furl" value="http://127.0.0.1/fire/txfail.php" /> 
        <input type="hidden" name="curl" value="http://127.0.0.1/fire/cantx.php" />
        <input type="hidden" name="service_provider" value="payu_paisa" /> 
        <font style="font-weight:bold">Firstname:</font> <br/><input class="inputCls" type="text" name="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /><br/><br/>
        <font style="font-weight:bold">Lastname:</font> <br/><input class="inputCls" type="text" name="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /><br/><br/>
    		 <font style="font-weight:bold">Email Id:</font> <br/><input class="inputCls" type="text" name="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /><br/><br/>
             <font style="font-weight:bold">Phone:</font> <br/><input class="inputCls" type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /><br/><br/><br/>
              <font style="font-weight:bold">Shipping address:</font> <br/><textarea class="inputCls" name="shipping_address1" style="min-width:300px;max-width:300px;min-height:130px;max-height:130px"><?php echo (empty($posted['shipping_address1'])) ? '' : $posted['shipping_address1']; ?></textarea><br/><br/>
              <font style="font-weight:bold">Billing address:</font> <br/><textarea class="inputCls" name="shipping_address2" style="min-width:300px;max-width:300px;min-height:130px;max-height:130px"><?php echo (empty($posted['shipping_address2'])) ? '' : $posted['shipping_address2']; ?></textarea><br/><br/>
			  
 			 <div style="margin:0 auto;width:500px;height:70px;text-align:left">
             <?php if(!$hash) { ?>
              <input class="inputBuy" type="submit" value="Place Order" />
              <?php } ?>  
       		 </div>
       </form>	
       <?php 
	   
	   } 
	   
	   }else{?>
       <div style="padding:15px;background:#fff;border:1px #ccc solid;font-size:12px;text-align:left"><b>There are only 3 steps to go</b>
       <ul>
       <li>Login</li><li>Enter your details for shipping</li><li>Make payment</li></ul></div>
       <br/>
       <form id="frm2" method="POST" action="2log.php">
       <input type="hidden" name="rdct" value="checkout.php" />
                 <input class="inputCls" type="text" name="usr" placeholder="Username" /><br/><br/>
                 <input class="inputCls" type="password" name="pwd" placeholder="Password" /><br/><br/>
                 <input class="inputBtn" type="submit" value="Login"/>
                 </form>
       
       <?php } ?>
       </div>
       <div class="dispblk" style="width:610px" id="prodisp">
<?php
if($usrid!=0){
	
if($formError!=2 && $cct != ''){
	
	echo $cct.'<div style="background:#fff;position:relative;width:600px;height:25px;text-align:left;padding:10px"><font style="float:left">FINAL TOTAL</font> <font style="float:right">Rs.<b>'.$total.'</b></font></div>';	
	
	}else if($formError!=2){
		
		echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:14px;text-align:center">Your cart is empty</div>';
		}
}
	   ?>
       </div>
          </div>
    </div>
	
<?php include('./footer.php'); ?>
</body>
</html>