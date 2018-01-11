<?php
include('conn.php');
$listFt = "";
$listC = "";
$listG = "";
$listF = "";
$listA = "";
$qr='select pid,pname,price,displayImage from products order by addedon desc LIMIT 8';
$qr1='select pid,pname,price,displayImage from products where category=2 order by addedon desc LIMIT 8';
$qr2='select pid,pname,price,displayImage from products where category=3 order by addedon desc LIMIT 8';
$qr3='select pid,pname,price,displayImage from products where category=4 order  by addedon desc LIMIT 8';
$qr4='select pid,pname,price,displayImage from products where category=1 order by addedon desc LIMIT 8';
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
			$test1=$conn->query($qr1);
			$count1=$test1->num_rows;
			if($count1){
				for($i=0;$i<$count1;$i++){					
					$dt=$test1->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;width:120px" alt="" />';
					}else{
					$img='';	
					}
					if($listC=="")
					{
						$listC='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}else{
					$listC.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}
				}
			
			}
			$test2=$conn->query($qr2);
			$count2=$test2->num_rows;
			if($count2){
				for($i=0;$i<$count2;$i++){					
					$dt=$test2->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;width:120px" alt="" />';
					}else{
					$img='';	
					}
					if($listG=="")
					{
						$listG='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}else{
					$listG.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}
				}
			
			}
			$test3=$conn->query($qr3);
			$count3=$test3->num_rows;
			if($count3){
				for($i=0;$i<$count3;$i++){					
					$dt=$test3->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;width:120px" alt="" />';
					}else{
					$img='';	
					}
					if($listF=="")
					{
						$listF='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}else{
					$listF.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}
				}
			
			}
			$test4=$conn->query($qr4);
			$count4=$test4->num_rows;
			if($count4){
				for($i=0;$i<$count4;$i++){					
					$dt=$test4->fetch_array();
					if($dt['displayImage']!=""){
					$img='<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;" alt="" />';
					}else{
					$img='';	
					}
					if($listA=="")
					{
						$listA='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}else{
					$listA.='<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative;padding:0 10px" class="cartfont">Rs.'.$dt['price'].'</div>	</div>		</div>';
					}
				}
			
			}
$hed = '';			
$sub = '';
$link = '';
$img = '';
$qr2='select * from slids order by sid asc LIMIT 5';
			$test2=$conn->query($qr2);
			$count2=$test2->num_rows;
			if($count2){
				for($i=0;$i<$count2;$i++){					
					$dt=$test2->fetch_array();
					
						$hed.=',\''.$dt['heading'].'\'';
					
						$sub.=',\''.$dt['sub'].'\'';
					
						$link.=',\''.$dt['link'].'\'';
					
						$img.=',\'./sliders/'.$dt['img'].'\'';
					
					
					
					
					
					
				}
			}
?>
<html>
<head>
<title>Welcome to shop now</title>
<script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
var hd = [''<?php echo $hed;?>];
var subh = [''<?php echo $sub;?>];
var lnk = [''<?php echo $link;?>];
var slid = [''<?php echo $img;?>];
var slen = 0;
var timm = 0;
var lo=0;
function bull(t){
	for(var j=1;j<=slen;j++)
	{
		if(t==j){
			document.getElementById('blid'+j).className='dbullet2';				
		}else{
			document.getElementById('blid'+j).className='dbullet';			
			}
	}	
}
function sLd(t)
{
	var  bullets = '';
	var len = (slid.length)-1;
	slen = len;
	
	for(var j=1;j<=len;j++)
	{
		if(bullets==''){
			bullets = '<li><a id="blid'+j+'" class="dbullet" onmouseover="lo=1;SSS('+j+',1)" onmouseout="lo=0"></a></li>';
		}else{
			bullets += '<li><a id="blid'+j+'" class="dbullet" onmouseover="lo=1;SSS('+j+',1)" onmouseout="lo=0"></a></li>';
		}
	}
	bullets = '<ul>'+bullets+'</ul>';
	document.getElementById('blts').innerHTML=bullets;
	
	if(document.getElementById('iHold'))
	{	
	var ims='';
	for(var i=1;i<=len;i++)
	{
	ims+='<img id="ims'+i+'" src="'+slid[i]+'" alt="" />';	
	}
		document.getElementById('iHold').innerHTML=ims;
		SSS(t,0);
	}
}
var vw = 'slImg2';
var vwA = 'slImg2a';
function SSS(t,t2)
{
	if(t2==1){
	timm=clearTimeout(timm);
	timm=0;
	}
	if(!document.getElementById('ims'+t).complete){
		timm=setTimeout('SSS('+t+','+t2+')',200);
	}else{
var nxSlide = t;		
if(lo<=1){
	if(lo!=2){

if(t>=(slen))
{
	nxSlide=1;
}else
{
nxSlide=(t+1);
}
if(vw == 'slImg1'){
 vw = 'slImg2';
 vwA = 'slImg2a';
}else{
 vw = 'slImg1';
 vwA = 'slImg1a';
}
document.getElementById(vw).src=slid[t];
document.getElementById(vwA).href=lnk[t];
document.getElementById('slHd').innerHTML=hd[t];
document.getElementById('slSub').innerHTML=subh[t];	
bull(t);
	slide(new Date().getTime());
	}
	if(lo==1){	lo=2;}
}
		timm=setTimeout('SSS('+nxSlide+','+t2+')',4000);
	}
}
var cn=1000.0;
var cn2=400.0;
var cnDyn=400.0;
function slide(prevcount)
{ 
  var curcount = new Date().getTime();
  var used_count = curcount - prevcount;
  var element = document.getElementById('slDv1'); 
  var element2 = document.getElementById('slDv2'); 
  if(cn <= used_count)
  {
    element.style.left = vw == 'slImg1' ? '0px' : '-700px' ;
    element2.style.left = vw == 'slImg2' ? '0px' : '700px' ;
    return 1;
  } 
  cn -= used_count;
  var newht = element.offsetLeft;
  var newht2 = element2.offsetLeft;  
  if(vw=='slImg1')
  {  
  if(element.offsetLeft>=(-700)) 
  {
  	  newht = newht-used_count;
  	  newht2 = newht2-used_count;	  
  }else{cn = used_count;}
  }else if(vw=='slImg2')
  {
	if(element.offsetLeft<=(-700))
	{
	  newht = newht+used_count;
	  newht2 = newht2+used_count;	  
	}else{cn = used_count;}
  }
  element.style.left = newht+'px';
  element2.style.left = newht2+'px';
  stmr=setTimeout("slide("+curcount+")", 33);
}
var begin = 0;
function startSlide(dv,t)
{ 
 var element = document.getElementById(dv);
 var elWid =  element.offsetWidth;
 var elLe =  element.offsetLeft;
 
 if(t==0){
	 begin = (elLe-700);	 
	document.getElementById('ftDivLeft').disabled=false;
	document.getElementById('ftDivLeft').className='arrowlink';
	document.getElementById('ftDivRight').disabled=true;
	document.getElementById('ftDivRight').className='arrowlinkInactive';
 }else if(t==1){
 	begin = (elLe+700);
	document.getElementById('ftDivLeft').disabled=true;
	document.getElementById('ftDivLeft').className='arrowlinkInactive';
	 document.getElementById('ftDivRight').disabled=false;
	document.getElementById('ftDivRight').className='arrowlink';
 }
 cnDyn = cn2;
	slideDv(dv,new Date().getTime(),t);
}
function slideDv(dv,prevcount,typ)
{ 
  var curcount = new Date().getTime();
  var used_count = curcount - prevcount;
  var element = document.getElementById(dv);  
  if(cnDyn <= used_count)
  {
	  
    element.style.left = begin+'px';
    return 1;
  } 
  cnDyn -= used_count;
  var newht = element.offsetLeft;
  
  if(typ==1)
  {  
     if(element.offsetLeft<=(begin)) 
  	 {
  	   newht = newht+used_count;	  
  	 }
	 else{cnDyn = used_count;}
  }else if(typ==0)
  {
	if(element.offsetLeft>=(begin))
	{
		 newht = newht-used_count;	  
	}
	else{cnDyn = used_count;}
  }
  element.style.left = newht+'px';
  stmr=setTimeout("slideDv('"+dv+"'," + curcount + ","+typ+")", 33);
}


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
for(var i=0;i<4;i++)
{
//elems+='<div class="blk2"><div class="btm2"><div style="text-align:left">Puma Brandpack</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="text-align:left">				<a href="#">Shop now</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.1300</div>			</div>			</div>		</div>';

var imm = "";
 if(i%2==0){
	imm = "displayImage/1.gif";
}else{
	imm = "displayImage/2.png";
}
elems+='<div class="blk2"><div class="btm2"><img src="'+imm+'" style="min-height:80px;min-width:230px" alt="" /></div><div style="text-align:left;margin-top:8px;position:relative">								</div>			</div>		</div>';
}
document.getElementById('rightlist').innerHTML=elems;
}

</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body onLoad="sLd(1);list2()">
<div style="display:none" id="iHold"></div>
<?php include('./navbar.php'); ?>
	<div class="clmain">
	
	<div class="dispblk leftmain">
		<div class="main1">
			<div class ="clmain1img">
<div id="sLoader" class="logo" style="position:absolute;top:35%;left:43%;z-index:1" ></div>
<div class="divS" style="left:0" id="slDv1"><a id="slImg1a" onMouseOver="this.style.cursor='pointer'"><img id="slImg1" src="" style="min-width:700px;width:700px;min-height:300px" alt="" /></a></div>
<div class="divS" style="left:701px" id="slDv2"><a id="slImg2a" onMouseOver="this.style.cursor='pointer'"><img id="slImg2" src="" style="min-width:700px;width:700px;min-height:300px" alt="" /></a></div>

			</div>
			<div class="price">
			<div class="dispblk listcls" id="blts">
			<ul>
				<li><div class="dbullet"></div></li>
				<li><div class="dbullet2"></div></li>
				<li><div class="dbullet2"></div></li>
				<li><div class="dbullet2"></div></li>
			</ul>		
			</div>
			<div class="dispblk" style="width:500px;padding-top:10px;position:absolute;top:0;right:0;text-align:right">
			<div class="fontblack font14" id="slHd" style="font-weight:bold"></div>
			<div class="fontdarkgrey font13" id="slSub"></div>
			</div>
			</div>			
		</div>
	<div class="blkpr">  
    	<div style="background:#ddd;font-size:16px;color:#000;padding:5px">Featured</div>
		<div class="slideblocks">
        <div style="position:absolute;top:45%;left:0;z-index:1"><input id="ftDivLeft" class="arrowlinkInactive" type="button" onClick="startSlide('ftDiv',1)" value="<" disabled="disabled" /></div>
        <div style="position:absolute;top:45%;right:0;z-index:1"><input id="ftDivRight" class="arrowlink" type="button" onClick="startSlide('ftDiv',0)" value=">" /></div>
		<div id="ftDiv" class="divS2" style="position:absolute;left:0;width:1400px;padding-left:25px"><?php echo $listFt; ?></div>
        </div>
        
        <div style="background:#ddd;font-size:16px;color:#000;padding:5px">Clothing</div>
        <div id="listdiv" class="blocks"><?php echo $listC; ?></div>
        
        <div style="background:#ddd;font-size:16px;color:#000;padding:5px">Groceries</div>
        <div id="listdiv" class="blocks"><?php echo $listG; ?></div>
		
        <div style="background:#ddd;font-size:16px;color:#000;padding:5px">Food</div>
        <div id="listdiv" class="blocks"><?php echo $listF; ?></div>
        
        <div style="background:#ddd;font-size:16px;color:#000;padding:5px">Accessories</div>
        <div id="listdiv" class="blocks"><?php echo $listA; ?></div>
	</div>
	</div>
	<div class="dispblk rightmain">
    <div id="sph" class="blk2Add">
    	<img src="spImg/1.jpg" style="width:100%" alt="" />
    </div>
    <div id="rightlist"></div>
    </div>
</div>	
<?php include('./footer.php'); ?>
</body>
</html>