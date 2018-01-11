<?php 
session_start();
include('conn.php');
$cct = "";
$act = 0;
$qtt = 1;
if (isset($_GET['act'])) {
	$act = (int)$_GET['act'];
}
	switch($act){
		case 1:
if (isset($_GET['pid'])) {		
$pid = filter_var($_GET['pid'], FILTER_SANITIZE_NUMBER_INT);
}
if (isset($_GET['qt'])) {
$qtt = filter_var($_GET['qt'], FILTER_SANITIZE_NUMBER_INT);
}
    $results = $conn->query('SELECT pname,price,displayImage FROM products WHERE pid='.$pid.' LIMIT 1');    
   
    if ($results) { 
      $obj = $results->fetch_object(); 
	  $qr5='select b.type,b.val,b.val2 from poffers as a,offers as b where a.pid='.$pid.' and b.offid=a.offid';
					$test5=$conn->query($qr5);
					$count5=$test5->num_rows;
					$ofv = "";
					$cut = 0;
					$prc2=$obj->price;
					if($count5){
					for($j=0;$j<$count5;$j++)
					{
					$ofv1 = $test5->fetch_array();
						if($ofv1['type'] == 1)
						{
							$dratio = ($ofv1['val']/100);
							$cut = ($prc2*$dratio);
							$cut = floor($cut);
							$refcut = $cut;
							$prc2 = floor(($prc2-$cut));
							$ofv .= '<font style="color:#00BB5E">Discount <b>'.$ofv1['val'].'%</b></font><br/>'; 
						}
					}
					}
        $new_product = array(array('name'=>$obj->pname, 'pid'=>$pid, 'img'=>$obj->displayImage, 'qtt'=>$qtt, 'prc'=>$obj->price, 'prc2'=>$prc2, 'off'=>$ofv, 'cut'=>$cut));
		
        if(isset($_SESSION['cart']))
        {
            $found = false;
            $product=array();
            foreach ($_SESSION['cart'] as $item)
            {
                if($item['pid'] == $pid){ 

                    $product[] = array('name'=>$item['name'], 'pid'=>$item['pid'], 'img'=>$item['img'], 'qtt'=>$qtt, 'prc'=>$item['prc'], 'prc2'=>$item['prc2'], 'off'=>$item['off'], 'cut'=>$item['cut']);
                    $found = true;
                }else{
                    $product[] = array('name'=>$item['name'], 'pid'=>$item['pid'], 'img'=>$item['img'], 'qtt'=>$item['qtt'], 'prc'=>$item['prc'], 'prc2'=>$item['prc2'], 'off'=>$item['off'], 'cut'=>$item['cut']);
                }
            }
           
            if($found == false)
            {
                $_SESSION['cart'] = array_merge($product, $new_product);
            }else{
 
                $_SESSION['cart'] = $product;
            }
           
        }else{
            $_SESSION['cart'] = $new_product;
        }
       
    }		
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
               <div id="del'.$item['pid'].'" class="delLink" style="position:absolute;top:10px;right:10px"><a onClick="pcart('.$item['pid'].',0,2)">X</a></div>
               <div style="position:absolute;bottom:10px;right:10px">
               		<div class="fontblack font15">Sub Total</div>
               		<div class="fontblack" style="font-size:20px">Rs.'.$subtotal.'</div>
               </div>
               </div>
            </div>';
        
        $total = ($total + $subtotal);
    }
	echo $cct;
}else{
    echo 'Your cart is empty';
}
		break;
		case 2:
if(isset($_SESSION['cart']))
{		
$pid = $_GET['pid'];
$product = array();
$cct = '';
$total = 0;
    foreach ($_SESSION['cart'] as $item) 
    {
        if($item['pid']!=$pid){ 
            $product[] = array('name'=>$item['name'], 'pid'=>$item['pid'], 'img'=>$item['img'], 'qtt'=>$item['qtt'], 'prc'=>$item['prc'], 'prc2'=>$item['prc2'], 'off'=>$item['off'], 'cut'=>$item['cut']);
			
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
               <div id="del'.$item['pid'].'" class="delLink" style="position:absolute;top:10px;right:10px"><a onClick="pcart('.$item['pid'].',0,2)">X</a></div>
               <div style="position:absolute;bottom:10px;right:10px">
               		<div class="fontblack font15">Sub Total</div>
               		<div class="fontblack" style="font-size:20px">Rs.'.$subtotal.'</div>
               </div>
               </div>
            </div>';
        
        $total = ($total + $subtotal);
			 
        }
	}
	if($cct != ''){
	echo $cct;	
	}else{echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:14px;text-align:center">Your cart is empty</div>';}
        $_SESSION['cart'] = $product;
}else{echo 'Your cart is empty';}
		break;
		case 3:
		default:
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
						<div class="dispblk fontblack" style="margin:5px 0 0 15px;font-size:20px">Rs. '.$item['prc2'].'</div> 
						<div class="dispblk fontblack font14" style="margin:5px 0 0 5px">x'.$item['qtt'].'</div> 
                    </div>
               </div>
               <div id="del'.$item['pid'].'" class="delLink" style="position:absolute;top:10px;right:10px"><a onClick="pcart('.$item['pid'].',0,2)">X</a></div>
               <div style="position:absolute;bottom:10px;right:10px">
               		<div class="fontblack font15">Sub Total</div>
               		<div class="fontblack" style="font-size:20px">Rs.'.$subtotal.'</div>
               </div>
               </div>
            </div>';
        
        $total = ($total + $subtotal);
    }
	$cct;
}else{
    echo 'Your cart is empty';
}
break;
	}//sw e
?>
   
					
					
						
				
				
