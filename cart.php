<?php
session_start();
include('conn.php');
$cct = "";

if(isset($_SESSION['cart']))
{
    $total = 0;
    foreach ($_SESSION['cart'] as $item)
    {
		$subtotal = ($item['prc2']*$item['qtt']);
		$img = "";
			  if($item['img'] != "")
			  {
				$img = '<img src="displayImage/'.$item['img'].'" style="width:120px" alt="" />';
			  }
        $cct.='<div style="position:relative;width:700px;text-align:left;padding:10px;border:1px #ccc solid">
               <div class="fontBT fontblack font16" style="font-weight:bold" id="proname">'.$item['name'].'</div>
               <div><a href="v.php?pid='.$item['pid'].'"><div class="dispblk cartImg" style="background:#ddd">'.$img.'</div></a>
               <div class="dispblk" style="width:550px;padding:8px">
                    <div style="margin-top:25px">
                    	<div class="dispblk fontblack" style="font-size:20px"><b>Rs. '.$item['prc'].'</b></div>        		
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px">'.$item['off'].'</div>
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px;text-decoration:line-through">'.$item['cut'].'</div>
						<div class="dispblk fontblack" style="margin:0 0 0 15px;font-size:20px">Rs. '.$item['prc2'].'</div> 
						<div class="dispblk fontblack font14" style="margin:5px 0 0 5px">x'.$item['qtt'].'</div> 
                    </div>
               </div>
               <div id="del'.$item['pid'].'" class="delLink" style="position:absolute;top:10px;right:10px"><a onClick="pcart('.$item['pid'].',2)">X</a></div>
               <div style="position:absolute;bottom:10px;right:10px">
               		<div class="fontblack font15">Sub Total</div>
               		<div class="fontblack" style="font-size:20px">Rs.'.$subtotal.'</div>
               </div>
               </div>
            </div>';
        
        $total = ($total + $subtotal);
    }
	$cct;
}

?>
<html>
<head>
<title>Cart</title>
<script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
function pcart(id,a)
{
var pi=document.getElementById("prodisp");
	var http;
	if (window.XMLHttpRequest)
  {
    http=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
http.onreadystatechange=function()
  {
  if (http.readyState==4 && http.status==200)
    {
	   if(pi){pi.innerHTML=http.responseText;}
	   
	  }else{
		if(a==2){
		document.getElementById('del'+id).innerHTML='<img src="frmgIa/smallLoader.gif" alt="" />';	
		}
	  }
  }
	   http.open("GET","prodcart.php?pid="+id+"&act="+a,true);
	   http.send("");
	
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

<?php include('./navbar.php'); ?>
	<div class="clmain">
		<div class="fontblack" style="font-size:32px;padding:10px"">Cart</div>	
        <div id="prodisp">
        	<?php if($cct != ''){
	echo $cct;	
	echo '<div class="further">
             <a href="checkout.php" class="bak1">Proceed to Checkout</a>
         </div>';
	}else{echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:14px;text-align:center">Your cart is empty</div>';} ?>            
        </div>
	</div>	
<?php include('./footer.php'); ?>
</body>
</html>