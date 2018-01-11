<?php 
session_start();
include('conn.php');
$cct = "";

if(isset($_SESSION['cart']))
{		
$pid = $_GET['pid']; //get the product code to remove
$product = array();
$cct = '';
$total = 0;
    foreach ($_SESSION['cart'] as $item) //loop through session array var
    {
        if($item['pid']!=$pid){ //item does,t exist in the list
            $product[] = array('name'=>$item['name'], 'pid'=>$item['pid'], 'img'=>$item['img'], 'qtt'=>$item['qtt'], 'prc'=>$item['prc'], 'prc2'=>$item['prc2'], 'off'=>$item['off'], 'cut'=>$item['cut']);
			
			$subtotal = ($item['prc2']*$item['qtt']);
        $img = "";
			  if($item['img'] != "")
			  {
				$img = '<img src="displayImage/'.$item['img'].'" style="width:120px" alt="" />';
			  }
        $cct.='<div style="background:#fff;position:relative;width:600px;text-align:left;padding:10px;border:1px #ccc solid">
               <div class="fontBT fontblack font16" style="font-weight:bold" id="proname">'.$item['name'].'</div>
               <div><div class="dispblk cartImg" style="background:#ddd">'.$img.'</div>
               <div class="dispblk" style="width:450px;padding:8px">
                    <div style="margin-top:25px">
                    	<div class="dispblk fontblack" style="font-size:20px"><b>Rs. '.$item['prc'].'</b></div>        		
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px">'.$item['off'].'</div>
                        <div class="dispblk fontblack font14" style="margin:5px 0 0 15px;text-decoration:line-through">'.$item['cut'].'</div>
						<div class="dispblk fontblack" style="margin:5px 0 0 15px;font-size:20px">Rs. '.$item['prc2'].'</div> 
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
    }
	if($cct!=''){
		{
			echo $cct;
		}else{
			 echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:20px;text-align:center">Your cart is empty</div>';
		}
}else{
    echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:20px;text-align:center">Your cart is empty</div>';
}
        //create a new product list for cart
        $_SESSION['cart'] = $product;
		
?>
   
					
					
						
				
				
