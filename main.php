<?php
include('conn.php');
$list1 = "";
$qr='select pid,pname,price,displayImage from products order by addedon desc LIMIT 16';
			$test=$conn->query($qr);
			$count=$test->num_rows;
			if($count){
				for($i=0;$i<$count;$i++){					
					$dt=$test->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:80px;min-width:100px" alt="" />';
					}else{
					$img='';	
					}
					$list1.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="text-align:left">				<a href="#">Add to cart</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.'.$dt['price'].'</div>			</div>			</div>		</div>';
				}
			
			}

?>
<html>
<head>
<title>Welcome to shop now</title>
<script language="javascript">
function list()
{
var elems="";
for(var i=0;i<=7;i++)
{
elems+='<div class="blk"><div class="btm"></div><div class="btm2"><div style="text-align:left"> Levis T-shirts</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="text-align:left">				<a href="#">Add to cart</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.399</div>			</div>			</div>		</div>';
}
document.getElementById('listdiv').innerHTML=elems;
}

function list2()
{
var elems="";
for(var i=0;i<=8;i++)
{
elems+='<div class="blk2"><div class="btm2"><div style="text-align:left">Puma Brandpack</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="text-align:left">				<a href="#">Shop now</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.1300</div>			</div>			</div>		</div>';
}
document.getElementById('rightlist').innerHTML=elems;
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body onLoad="list2()">

<?php include('./navbar.php'); ?>
	<div class="clmain">
	
	<div class="dispblk leftmain">
		<div class="main1">
			<div class ="clmain1img">
				<img src="1.jpg" alt="" width="700px"/>
			</div>
			<div class="price">
			<div class="dispblk listcls">
			<ul>
				<li><div class="dbullet"></div></li>
				<li><div class="dbullet2"></div></li>
				<li><div class="dbullet2"></div></li>
				<li><div class="dbullet2"></div></li>
			</ul>
		
			</div>
			<div class="dispblk" style="width:500px;padding-top:10px;position:absolute;top:0;right:0;text-align:right">
			<div class="font14 fontblack" style="font-weight:bold">T-shirts and stacks now available at $89.90</div>
			<div>
			<form>
			<input class="pbtn"type="button" name="nm4" value="Purchase"/>
			</form>
			</div>
			</div>
			</div>
			<div style="font-size:16px;color:#000;padding:5px">Featured</div>
		</div>
	<div class="blkpr">  
    	
		<div id="listdiv" class="blocks"><?php echo $list1; ?></div>
		
	</div>
	</div>
	<div class="dispblk rightmain">
    <div id="ads" class="blk2Add"></div>
    <div id="rightlist"></div>
    </div>
</div>	
<?php include('./footer.php'); ?>
</body>
</html>