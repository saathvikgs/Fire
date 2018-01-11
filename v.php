<?php
error_reporting(0);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
include('ulfiles/categories.php');
$ccat = "";
foreach($category as $key => $value)
{
$ccat.='<a href="search.php?c='.$key.'">'.$value.'</a>';
}

$flag = 0;
$pid = 0;
$pn = "";
$md = "";
$cat = 1;
$catg = "Accessories";
$scat = 0;
$sel = "";
$stk = 1;
$stks = "In Stock";
$nstk = "";
$prc = 1;
$firstImg = "1.jpg";
$thumbs = "";

$ds = "";
$kf = "";
$kfp = "";

$ftr = "";
if(isset($_GET['pid']) && is_numeric($_GET['pid'])){
	$pid=$_GET['pid'];
	
	$test = $conn->query('select * from products where pid='.$pid.' LIMIT 1');
	$count = $test->num_rows;
	if($count){
		
		$data = $test->fetch_array();
		$pn = $data['pname'];
		$md = $data['mname'];
		$cat = $data['category'];
		$ssc = (int)$data['subcategory'];
		if($ssc){
		    $scat = $ssc;
		}
		if($cat==2){
			$catg = "Clothing";
		}else if($data['category']==3){
			$catg = "Groceries";	
		}else if($data['category']==4){
			$catg = "Food";	
		}
		$sel = $data['seller'];
		$stk = $data['stock'];
		if($stk==2){
		$stks = "Out of Stock";
		}
		$nstk = $data['numStock'];
		$prc = $data['price'];
		
		$test2=$conn->query('select imageName,addedon from prodimage where pid='.$pid.'');
		$count2 = $test2->num_rows;
		if($count2){
			for($i=0;$i<$count2;$i++){
				$dt=$test2->fetch_array();
$thumbs.='<div id="I1'.$pid.$dt['addedon'].'" class="dispblk smallImg" onClick="loadImg(\'bigImage/'.$dt['imageName'].'\')"><img src="smallImage/'.$dt['imageName'].'" style="min-height:80px;width:80px" alt="" /></div>';
$thumbs2.='<div id="I1'.$pid.$dt['addedon'].'" class="dispblk smallImg" onClick="loadImg2(\'bigImage/'.$dt['imageName'].'\')"><img src="smallImage/'.$dt['imageName'].'" style="min-height:80px;width:80px" alt="" /></div>';
$firstImg='bigImage/'.$dt['imageName'];	
			}
		}
		$qr3='select description,keyFeature from prodkeyfeature where pid='.$pid.' LIMIT 1';
		$test3=$conn->query($qr3);
		$count2=$test3->num_rows;
		if($count2){
		$dt=$test3->fetch_array();
		$ds=$dt['description'];
		$kf=$dt['keyFeature'];
		$arr=explode(';',$kf);	
		$kfc=count($arr);
			for($i=0;$i<$kfc;$i++)
			{
				$kfp.='<li>'.$arr[$i].'</li>';
			}
			$kfp='<ul>'.$kfp.'</ul>';
		}
		$qr4='select addedon,title,feature from prodfeature where pid='.$pid.'';
		$test4=$conn->query($qr4);
		$count3=$test4->num_rows;
		if($count3){
			for($i=0;$i<$count3;$i++)
			{
		$dt=$test4->fetch_array();
		$iid=$dt['addedon'];
		$ttl=$dt['title'];
		$fre=$dt['feature'];
		$ftr.='<tr><td style="max-width:200px">'.$ttl.'</td><td>'.$fre.'</td></tr>';
			
			}
		}
	}
	
}

$listFt = "";
if($scat!=0)
{
	$qr='select pid,pname,price,displayImage from products where pid!='.$pid.' and category='.$cat.' and subcategory='.$scat.' order by addedon desc LIMIT 4';
}else
{
	$qr='select pid,pname,price,displayImage from products where pid!='.$pid.' and category='.$cat.' order by addedon desc LIMIT 4';
}
			$test=$conn->query($qr);
			$count=$test->num_rows;
			if($count){
				for($i=0;$i<$count;$i++){					
					$dt=$test->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;width:120px" alt="" />';
					}else{
					$img='';	
					}
					if($listFt=="")
					{
						$listFt='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}else{
					$listFt.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}
				}
			
			}



?>
<html>
<head>
<title><?php echo $pn; ?></title>
<script language="javascript">
function loadImg(img){	
	document.getElementById('Bigg').style.display='none';
	document.getElementById('bMig').src='';
	document.getElementById('bMig').src=img;
	document.getElementById('BiggLoad').style.display='block';
	setTimeout('loadIm()',200);
}
function loadIm(){
	var igdv = document.getElementById('bMig');
	var idv = document.getElementById('Bigg');
	var lidv = document.getElementById('BiggLoad');	
	if(igdv.complete){		
		idv.style.display='table';
		lidv.style.display='none';
		return;
	}else{
		setTimeout('loadIm()',200);	
	}	
}

function loadImg2(img){	
document.getElementById('pout').style.display='block';
	document.getElementById('bMig2').style.display='none';
	document.getElementById('bMig2').src='';
	document.getElementById('bMig2').src=img;
	document.getElementById('BiggLoad2').style.display='block';
	setTimeout('loadIm2()',200);
}
function loadIm2(){
	var igdv = document.getElementById('bMig2');
	var lidv = document.getElementById('BiggLoad2');	
	if(igdv.complete){		
		igdv.style.display='table';
		lidv.style.display='none';
		return;
	}else{
		setTimeout('loadIm2()',200);	
	}	
}
function loadRe(d,pid,p){
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var res = req.responseText;
			document.getElementById(d).innerHTML=res;
		}else{
document.getElementById(d).innerHTML='<div style="text-align:center"><div>Loading...</div><br/><img src="frmgIa/smallLoader.gif" alt="" /></div>';
		}
	}
	req.open("GET","rev.php?pid="+pid+"&p="+p,true);
	req.send('');
	
}
function pcart(id,ut,a)
{var p=document.getElementById("cartid");
var pi=document.getElementById("prodisp");
if(p){p.style.display="block";}
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
		}else if(a==1){
			if(pi){pi.innerHTML='<img src="frmgIa/smallLoader.gif" alt="" />';}
			}
	  }
  }
	   http.open("GET","prodcart.php?pid="+id+"&qt="+ut+"&act="+a,true);
	   http.send("");
	
	
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body onLoad="loadImg('<?php echo $firstImg; ?>');loadRe('revis',<?php echo $pid; ?>,1)">
<div id="cartid" class="cart">
	<div class="name" style="width:780px;height:500px;background:#fff;margin:0 auto;padding:10px;margin-top:50px;border:10px #787878 solid ">
         <div class="mycart">MY CART <div style="position:absolute;top:0;right:-28px">
         <input style="width:25px;height:25px;border-radius:5px;background:#ddd;color:#666;border:1px #eee solid;padding:5px" type="button" value="X" onclick='document.getElementById("cartid").style.display="none"' /></div></div>                 
     <div style="height:390px;overflow:auto;margin-left:28px"><div id="prodisp"></div></div>
         <div class="further">
         	<a class="bak" onclick='document.getElementById("cartid").style.display="none"'>Continue Shopping</a>
             <a href="checkout.php" class="bak1">Proceed to Checkout</a>
         </div>
    </div>  
</div>
<div id="pout" style="display:none;width:100%;height:100%;text-align:center;z-index:100;position:fixed;background:rgba(160,160,160,0.8);overflow:auto">
	<div style="width:800px;max-width:800px;height:800px;max-height:800px;margin:0 auto;margin-top:40px;margin-bottom:40px;text-align:center">
    <div style="text-align:center;position:relative;background:#fff;border:10px #fff solid">
     <div id="BiggLoad2" style="display:none;position:absolute;top:45%;left:45%;z-index:1"><img src="frmgIa/smallLoader.gif" alt="" /></div>
  <div style="margin:0 auto;display:table;text-align:center;min-width:600px;min-height:600px;max-width:600px;max-height:600px;overflow:hidden">
                <div style="display:table-cell;vertical-align:middle"><img id="bMig2" src="" style="width:600px" alt="" /></div>
  </div>
            <div style="text-align:center">
            	<div style="height:80px;padding:10px"> 
                <?php echo $thumbs2; ?>
                </div>
            </div>
    <input style="position:absolute;top:10;right:10;border-radius:5px;width:25px;height:25px;border:1px #ddd solid;background:#ddd;padding:5px;color:#666" type="button" value="X" onclick='document.getElementById("pout").style.display="none"' />
    </div>
    </div>
</div> 
<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="navigateLink" style="margin:10px 0 -4px 0"><a href="./main.php">Home</a> > <a href="search.php?c=<?php echo $cat; ?>"><?php echo $catg; ?></a> > <?php echo $pn; ?></div>

<div>
	<div style="text-align:center"><fieldset class="prodName"><legend><?php echo $pn; ?></legend></fieldset></div>
    <div>
    	<div class="dispblk" style="min-width:400px;min-height:500px;max-width:400px">
        	<div class="dispblk" style="position:relative;min-width:400px;min-height:400px;max-width:400px;max-height:400px">
            	<div id="BiggLoad" style="display:none;position:absolute;top:45%;left:45%;z-index:1"><img src="frmgIa/smallLoader.gif" alt="" /></div>
                <div id="Bigg" style="display:table;text-align:center;min-width:400px;min-height:400px;max-width:400px;max-height:400px;overflow:hidden">
                <div style="display:table-cell;vertical-align:middle"><img id="bMig" onMouseOver="this.style.cursor='pointer'" onClick="loadImg2(this.src)" src="" style="width:300px" alt="" /></div>
                </div>
            </div>
            <div style="text-align:center">
            	<div style="text-align:left;min-height:80px;width:400px;padding:6px"> 
                <?php echo $thumbs; ?>
                </div>
            </div>
        </div>
        <div class="dispblk" style="width:480px;margin-left:8px">
        	<div class="dispblk" style="width:250px">            	
                <div class="fontblack font14">Model : <?php echo $md; ?></div>
                <div class="fontblack font14" style="margin-top:5px">Sold by : <?php echo $sel; ?></div>
                <?php $qr5='select b.type,b.val,b.val2 from poffers as a,offers as b where a.pid="'.$pid.'" and b.offid=a.offid';
					$test5=$conn->query($qr5);
					$count5=$test5->num_rows;
					$ofv = "";	
					$strike = "font-weight:bold";
					$prc2=$prc;
					if($count5){
						$strike = 'text-decoration:line-through';
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
				?>
                <div class="fontblack" style="margin-top:50px;font-size:35px;<?php echo $strike; ?>">Rs. <?php echo $prc; ?></div>
                <div class="fontblack font14" style="margin-bottom:8px">(free home delivery)</div>
                <?php
				if($ofv != "") { ?>
                <div class="fontgrey" style="color:#00BB5E;border:1px #ddd dashed;padding:6px">OFFERS:<?php echo $ofv; ?></div>
                <div class="fontblack" style="margin-top:10px;font-size:30px; font-weight:bold;">Rs. <?php echo $prc2; ?></div>
				<?php }
				?>
                <form onSubmit="return false">
                <div style="margin-top:25px">
                	<div  class="dispblk">Units : </div><div class="dispblk"><input style="margin-left:10px;margin-top:-8px;border:1px #666 dashed;background:#dcdcdc;width:70px;min-height:25px;padding:10px" type="text" name="unit" value="1" />
                    </div>
                </div>
                <div style="margin-top:25px"><?php if($stk==1){?><input class="inputBuy" type="button" value="Buy now" onClick="pcart(<?php echo $pid; ?>,unit.value,1)" /><?php } ?></div></form>
               
                
            </div>
            <div class="dispblk" style="width:220px">
            <div class="fontblack" style="color:#3CF;font-size:30px"><?php echo $stks; ?></div>
            <div class="fontdarkgrey font14" style="margin-top:50px">Delivered in 5-7 business days</div>
            <div class="fontdarkgrey font14" style="margin-top:5px">Standard Delivery in 2-3 business days</div>
            </div>
        </div>
    </div>
    <div>
    <?php if($kf != ""){?>
    	<div class="fontblack fonthead" style="margin-top:5px;border-top:4px #000 solid">Key Feature</div>
            <div class="fontdarkgrey" style="padding:10px">
              <?php echo $kfp; ?>
            </div>
    	</div>
    <?php }
			if($ds != ""){
		 ?>
    <div>
    	<div class="fontblack fonthead" style="margin-top:5px;border-top:4px #000 solid">Description</div>
        <div class="fontdarkgrey font14" style="padding:10px"><?php echo $ds; ?></div>
    </div>
    <?php }
			if($ftr != ""){ ?>
    <div class="fontblack fonthead" style="margin-top:5px;border-top:4px #000 solid">Features</div>
            <div class="keyTab" style="padding:10px">
                <table style="min-width:500px">
                <?php echo $ftr; ?>
                </table>
            </div>
         <?php } ?> 
    	</div>
       
    <div style="width:100%">
    	<div class="fontblack fonthead" style="text-align:left;margin-top:5px;border-top:4px #000 solid">Quick Links</div>
        <div class="dispBlk" style="width:200px;text-align:left;padding:8px">
        <div class="fontblack font16"><b>Goto</b></div>
        <div class="dispBlk navigateBox" style="padding-left:8px">
        <?php echo $ccat; ?>        
        </div>        
        </div>
        <div class="dispBlk" style="border-left:1px #ccc solid;text-align:left;padding-left:10px">
        	<?php  if($listFt!='')
				   { echo '<div class="fontblack font16"><b>Other products</b></div><div>'.$listFt.'</div>'; } ?>
        </div>
    </div>
        <div style="width:100%;border-top:4px #000 solid;margin-top:10px">
        <div style="color:#000;text-align:left;margin:10px 0;font-size:18px;text-transform:uppercase;color:#666"><b>Reviews of <?php echo $pn.' (Rs.'.$prc.')'; ?></b></div>      
    <div id="revis">
    </div>
</div>
</div>

</div>
	</div>	
<?php include('./footer.php'); ?>
</body>
</html>