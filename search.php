<?php 
session_start();
?>
<html>
<head>
<title>Search</title><script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
var cpn = 1;
function loadPr(d,c,q,p){
	cpn=p;
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
	req.open("GET","cLoad.php?c="+c+"&q="+q+"&p="+p,true);
	req.send('');
	
}

var fixPos='';
function loadMore(){
	var dv = 'lista'+(cpn+1);
	var dvv = 'listdiv'+(cpn+1);
	if(document.getElementById(dv))
	{	
	var topy=window.pageYOffset?window.pageYOffset:(document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop)
var divPos=onpos(dv);
	if(divPos){fixPos=divPos;}		
if((topy+500) > divPos){
  document.getElementById(dv).click();
}else if(topy < fixPos){
  //document.getElementById(dv).style.position="relative";
 }
	}
}

function onpos(dv)
{
var obj = document.getElementById(dv);	var curtop = 0;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	return curtop;
}
}

window.onscroll=function(){loadMore();};
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<?php
$ctg = 1;
$q = "";
if(isset($_GET['c']) && is_numeric($_GET['c'])){
$ctg = $_GET['c'];	
}
if(isset($_GET['q']) && $_GET['q']!=""){
$q = $_GET['q'];	
}
?>
<body onLoad="<?php  echo 'loadPr(\'listdiv\','.$ctg.',\''.$q.'\',1)'; ?>">
<?php include('./navbar.php'); ?>
	<div class="clmain">
        <div style="text-align:center">
        	<div class="dispblk" style="width:150px;text-align:left">
            	<div class="navigateLinkBlack" style="margin-bottom:5px"><a href="./">Home</a></div>
            	<div class="fontblack font16"><b>CATEGORIES</b></div>
                <div class="navigateBox">
                <a href="?c=1">Accessories</a>
                <a href="?c=2">Clothing</a>
                <a href="?c=4">Food</a>
                <a href="?c=3">Groceries</a>
                </div>
            </div>
            <div id="listdiv" class="dispblk" style="width:800px;text-align:left"></div>        	
        </div>
        </div>
<?php include('./footer.php'); ?>
</body>
</html>