function getsrc(v){
var srr=document.getElementById('srcDv');
var srn=document.getElementById('srcIn');
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){

var res = req.responseText;
srr.style.display='block';
srn.innerHTML=res;	

		}else{
srr.style.display='block';
srn.innerHTML='<img src="frmgIa/smallLoader.gif" alt="" />';
		}
	}
	req.open("GET","srcMin.php?q="+v,true);
	req.send("");
	
}
var timer = 0;
function dropMenu(dv,num)
{
	cancel();
	document.getElementById(dv).style.display="block";
	if(num==1)
	{
	document.getElementById(dv).innerHTML='<a href="#">Clothing</a><a href="">Grocessories</a><a href="">Food</a><a href="">Accessories</a>';	
	}
	else if(num==2)
	{
		document.getElementById(dv).innerHTML='<a href="">Men</a><a href="">Women</a><a href="">Kids</a>';
	}
	else if(num==4)
	{
		document.getElementById(dv).innerHTML='<a href="">Cakes</a><a href="">Chocolates</a><a href="">Beverages</a>';
	}
	else if(num==3)
	{
		document.getElementById(dv).innerHTML='<a href="">Dal</a><a href="">Oil</a><a href="">Vegetables</a>';
	}
	else if(num==5)
	{
		document.getElementById(dv).innerHTML='<a href="">Belt</a><a href="">Shoes</a><a href="">Jewels</a>';
	}
}
function dropOut(dv)
{
	timer = window.setTimeout(function(){dropFinal(dv);},300);
}
function dropFinal(dv)
{
		document.getElementById(dv).style.display="none";

}
function cancel()
{
	timer=window.clearTimeout(timer);
	timer=0;
	
}
var fip='';
function fxd(dv){
	if(document.getElementById(dv))
	{	
	var topy=window.pageYOffset?window.pageYOffset:(document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop)
var vPos=onp(dv);
	if(divPos){fip=vPos;}		
if((topy) > vPos){
  document.getElementById(dv).style.position="fixed";
  document.getElementById(dv).style.top="0";
  document.getElementById(dv).style.left="0";
  document.getElementById(dv).style.width="100%";
  document.getElementById(dv).style.zIndex="50";
}else if(topy < fixPos){
  document.getElementById(dv).style.position="relative";
  document.getElementById(dv).style.zIndex="0";
 }
	}
}

function onp(v)
{
var obj = document.getElementById(v);	var op = 0;
	if (obj.offsetParent) {
		do {
			op += obj.offsetTop;
		} while (obj = obj.offsetParent);
	return op;
}
}
function gtp()
{
	window.scrollTo(0,0);	

}