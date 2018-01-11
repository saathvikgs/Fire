<?php 
session_start();
if(isset($_SESSION['clog']) && $_SESSION['clog'] == '12345xyz')
{
	//logged
}
else
{
	echo '<META http-equiv="refresh" content="0;URL=cpnlm.php">';
	exit;
}
include('ulfiles/categories.php');
$ccat = "";
$scat = "";
foreach($category as $key => $value)
{
$ccat.='<option value="'.$key.'">'.$value.'</option>';	
}

foreach($sucat as $key => $value)
{
$scat.='<option value="'.$key.'">'.$value.'</option>';	
}
?>
<html>
<head>
<title>Control panel</title>
<script language="javascript">
function addProd(){
var ddv = document.getElementById('loadPlace');
var data = '<div class="nav2" style="width:100%;line-height:50px;font-size:30px; text-align:left">Add product</div><div class="fontblack" style="width:400px;text-align:right">   <form id="addFrm" onSubmit="checkProd();return false">        	<div class="font15">Product name : <input class="inputCls2" type="text" name="pname" /></div>            <div class="font15">Model : <input class="inputCls2" type="text" name="model" /></div>            <div class="font15">Category : <select class="inputCls2" name="categ"><?php echo $ccat; ?>            </select></div> <div class="font15">Sub Category : <select class="inputCls2" name="scateg"><?php echo $scat; ?>            </select></div>           <div class="font15">Seller : <input class="inputCls2" type="text" name="sellr" /></div>            <div class="font15">Stock : <select class="inputCls2" name="stk">            <option value="1" selected="selected">In stock</option><option value="2">Out of stock</option>            </select></div>            <div class="font15">Number of Stocks : <input class="inputCls2" type="text" name="numstk" /></div><div class="font15">Featured: <select class="inputCls2" name="feat"><option value="0" selected="selected">No</option>   <option value="1">Yes</option>         </select></div>            <div class="fontdarkgrey font13">Price should be in Rupees</div>            <div class="font15">Unit Price : <input class="inputCls2" type="text" name="prc" /></div>            <div><input class="inputAdd" type="button" value="ADD" onClick="checkProd()" /></div>            </form>        </div>';
ddv.innerHTML=data;
}
function viewProd(){
var ddv = document.getElementById('loadPlace');
var data = '<div style="position:relative">            <div class="nav2" style="width:100%;line-height:50px;font-size:30px; text-align:left">View/Edit products</div>            <div><form id="srcfr" onSubmit="srcProd(cat.value,sr.value,1); return false"><select class="inputCls2" name="cat" style="width:auto"><?php echo $ccat; ?></select><input class="inputCls2" type="text" name="sr" /><input class="inputWbtn" type="submit" value="Search" /></form></div>            <div id="loadView" style="text-align:left"></div>        </div>';	
ddv.innerHTML=data;
}
function slids(){
var ddv = document.getElementById('loadPlace');
var data = '<div class="nav2" style="width:100%;line-height:50px;font-size:30px; text-align:left">Add slides</div><div style="text-align:left"><div class="dispblk fontblack" style="width:400px;text-align:right">   <form id="addSld" onSubmit="return false">        	<div class="font15">Slide num:<input class="inputCls2" type="text" name="si" /></div>            <div class="font15">Title : <input class="inputCls2" type="text" name="titles" /></div>            <div class="font15">Sub tiltle : <input class="inputCls2" type="text" name="subtitle" /></div><div class="font15">Link : <input class="inputCls2" type="text" name="lnk" /></div>            <div class="font15" style="padding:10px;background:#e6e6e6">Image : <input type="file" name="imgs"/></div>   <div><input class="inputAdd" type="button" name="btn" value="ADD" onClick="addSlid(si.value,titles.value,subtitle.value,lnk.value)" /></div></form></div><div class="dispblk" style="width:300px;min-height:150px;padding:20px;margin-left:50px;background:#ccc" id="slds"></div></div>';	
ddv.innerHTML=data;
bringSlides();
}
function bringSlides()
{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			var res = req.responseText;
			document.getElementById('slds').innerHTML=res;
		}else{
document.getElementById('slds').innerHTML='<div style="text-align:center"><div>Loading...</div><br/><img src="frmgIa/smallLoader.gif" alt="" /></div>';
		}
	}
	req.open("GET","getSlides.php",true);
	req.send('');
	
}
function dlslid(id)
{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
			bringSlides();
		}else{
document.getElementById('slds'+id).innerHTML='<img src="frmgIa/smallLoader.gif" alt="" />';
		}
	}
	req.open("GET","getSlidesdel.php?id="+id,true);
	req.send('');
	
}
function feats(){
var ddv = document.getElementById('loadPlace');
var data = '<div class="nav2" style="width:100%;line-height:50px;font-size:30px; text-align:left">Featured</div><div id="feats"></div>';	
ddv.innerHTML=data;
vwFt(1);
}
function vwFt(p){
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
document.getElementById('feats').innerHTML=req.responseText;				
		}else{
document.getElementById('feats').innerHTML='<img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	req.open("GET","productFt.php?p="+p,true);
	req.send("");
	
}
function checkProd(){
var frm=document.getElementById('addFrm');
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
var ddv = document.getElementById('loadPlace');
var msg="";
var ko=0;
var pn=frm.pname.value;
var md=frm.model.value;
var cat=frm.categ.value;
var scat=frm.scateg.value;
var sel=frm.sellr.value;
var stk=frm.stk.value;
var nstk=frm.numstk.value;
var fet=frm.feat.value;
var prc=frm.prc.value;


if(pn=="" || pn.length==0)
{
	ko=1;
 	msg='Product name is empty!';
}else if(md=="" || md.length==0)
{
	ko=1;
 	msg='Model name is empty!';
}
else if(cat=="" || cat.length==0)
{
	ko=1;
 	msg='Choose a category!';
}
else if(sel=="" || sel.length==0)
{
	ko=1;
 	msg='Seller name is empty!';
}
else if(stk=="" || stk.length==0)
{
	ko=1;
 	msg='Set stock availability!';
}
else if(nstk=="" || nstk.length==0)
{
	ko=1;
 	msg='Number of stocks is empty!';
}else if(!/^[0-9]+$/.test(nstk))
{
	ko=1;
	perr.style.display='block';
 	msg='Number of stocks should be in numbers only!';
}
else if(prc=="" || prc.length==0)
{
	ko=1;
 	msg='Price not set!';
}else if(!/^[0-9]+$/.test(prc))
{
	ko=1;
 	msg='Price should be in numbers only!';
}
if(ko==1){
perr.style.display='block';	
err.innerHTML='<div>'+msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='none';
ddv.innerHTML=req.responseText;				
		}else{
perr.style.display='block';
err.innerHTML='<div>Adding product please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	pn=encodeURIComponent(pn);md=encodeURIComponent(md);cat=encodeURIComponent(cat);scat=encodeURIComponent(scat);sel=encodeURIComponent(sel);stk=encodeURIComponent(stk);nstk=encodeURIComponent(nstk);prc=encodeURIComponent(prc);
	var par="pname="+pn+"&mod="+md+"&cat="+cat+"&scat="+scat+"&sel="+sel+"&stk="+stk+"&nstk="+nstk+"&feat="+fet+"&prc="+prc;
	req.open("POST","productAction.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	}
}
function saveProd(pid){
var frm=document.getElementById('saveFrm');
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
var msg="";
var ko=0;
var pn=frm.pname.value;
var md=frm.model.value;
var cat=frm.categ.value;
var scat=frm.scateg.value;
var sel=frm.sellr.value;
var stk=frm.stk.value;
var nstk=frm.numstk.value;
var fet=frm.feat.value;
var prc=frm.prc.value;


if(pn=="" || pn.length==0)
{
	ko=1;
 	msg='Product name is empty!';
}else if(md=="" || md.length==0)
{
	ko=1;
 	msg='Model name is empty!';
}
else if(cat=="" || cat.length==0)
{
	ko=1;
 	msg='Choose a category!';
}
else if(sel=="" || sel.length==0)
{
	ko=1;
 	msg='Seller name is empty!';
}
else if(stk=="" || stk.length==0)
{
	ko=1;
 	msg='Set stock availability!';
}
else if(nstk=="" || nstk.length==0)
{
	ko=1;
 	msg='Number of stocks is empty!';
}else if(!/^[0-9]+$/.test(nstk))
{
	ko=1;
	perr.style.display='block';
 	msg='Number of stocks should be in numbers only!';
}
else if(prc=="" || prc.length==0)
{
	ko=1;
 	msg='Price not set!';
}else if(!/^[0-9]+$/.test(prc))
{
	ko=1;
 	msg='Price should be in numbers only!';
}
if(ko==1){
perr.style.display='block';	
err.innerHTML='<div>'+msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
err.innerHTML='<div>'+req.responseText+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';				
		}else{
perr.style.display='block';
err.innerHTML='<div>Saving changes please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	pn=encodeURIComponent(pn);md=encodeURIComponent(md);cat=encodeURIComponent(cat);scat=encodeURIComponent(scat);sel=encodeURIComponent(sel);stk=encodeURIComponent(stk);nstk=encodeURIComponent(nstk);prc=encodeURIComponent(prc);
	var par="pid="+pid+"&pname="+pn+"&mod="+md+"&cat="+cat+"&scat="+scat+"&sel="+sel+"&stk="+stk+"&nstk="+nstk+"&feat="+fet+"&prc="+prc;
	req.open("POST","productActionEdt.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	}
}
function kfPrev(v){
	var a = v.split(';');
	var b = a.length;
	var c = "";
	for(var i=0;i<b;i++){
	  c+='<li>'+a[i]+'</li>';	
	}
	document.getElementById('kfPrv').innerHTML='<ul>'+c+'</ul>';
}
function saveDes(pid){
var frm=document.getElementById('saveFrm2');
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
var msg="";
var ko=0;
var kf=frm.kft.value;
var ds=frm.des.value;


if(/^[ ]+$/.test(kf) || kf=="" || kf.length==0)
{
	ko=1;
 	msg='Key feature is empty!';
}else if(/^[ ]+$/.test(ds) || ds=="" || ds.length==0)
{
	ko=1;
 	msg='Description is empty!';
}
if(ko==1){
perr.style.display='block';	
err.innerHTML='<div>'+msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
err.innerHTML='<div>'+req.responseText+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';				
		}else{
perr.style.display='block';
err.innerHTML='<div>Saving key features and description please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	kf=encodeURIComponent(kf);ds=encodeURIComponent(ds);
	var par="pid="+pid+"&kf="+kf+"&ds="+ds+"&a=1";
	req.open("POST","productActionEdt2.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	}
}
function saveDes2(pid){
var frm=document.getElementById('saveFrm3');
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
var msg="";
var ko=0;
var ft=frm.ttl.value;
var ds=frm.ft.value;

if(/^[ ]+$/.test(ft) || ft=="" || ft.length==0)
{
	ko=1;
 	msg='Feature title is empty!';
}else if(/^[ ]+$/.test(ds) || ds=="" || ds.length==0)
{
	ko=1;
 	msg='Feature Description is empty!';
}
if(ko==1){
perr.style.display='block';	
err.innerHTML='<div>'+msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else{
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
var res = req.responseText;
var b = JSON.parse(res);

if(b.status==1){
	perr.style.display='none';
	frm.ttl.value="";
	frm.ft.value="";
	var tbl = document.getElementById('ftTable');
	var len = tbl.rows.length;
	len>0?len=len:len=0;
	var row = tbl.insertRow(len);
	row.id = 'ftrow'+pid+b.iid;
	var c1 = row.insertCell(0);
	var c2 = row.insertCell(1);
	var c3 = row.insertCell(2);
	c3.style.maxWidth='100px';
	c1.innerHTML = ft;
	c2.innerHTML = ds;
	c3.innerHTML = '<input class="inputWbtn" type="button" value="Delete" onclick="delFtr('+pid+','+b.iid+')" />';
}
else if(b.status==2){
perr.style.display='block';
err.innerHTML='<div>'+b.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';	
}
		}else{
perr.style.display='block';
err.innerHTML='<div>Adding new feature please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	ft=encodeURIComponent(ft);ds=encodeURIComponent(ds);
	var par="pid="+pid+"&ttl="+ft+"&ds="+ds+"&a=2";
	req.open("POST","productActionEdt2.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	}
}
function delProd(pid){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
var res = req.responseText;
var b = JSON.parse(res);

if(b.status==1){
	perr.style.display='none';
	var rr = document.getElementById('row'+pid);
	rr.parentNode.removeChild(rr);	
}
else if(b.status==2){
perr.style.display='block';
err.innerHTML='<div>'+b.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';	
}
		}else{
perr.style.display='block';
err.innerHTML='<div>Deleting product and its referencing data please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	var par="pid="+pid;
	req.open("POST","productDel.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	
}
function delFtr(pid,iid){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
var res = req.responseText;
var b = JSON.parse(res);

if(b.status==1){
	perr.style.display='none';
	var rr = document.getElementById('ftrow'+pid+iid);
	rr.parentNode.removeChild(rr);
}
else if(b.status==2){
perr.style.display='block';
err.innerHTML='<div>'+b.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';	
}
		}else{
perr.style.display='block';
err.innerHTML='<div>Deleting feature please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	var par="pid="+pid+"&iid="+iid+"&a=2";
	req.open("POST","productActionDel2.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	
}
function delImg(dv,pi,a){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');
var pp=pi.split(':');
var pid=pp[0];
var iid=pp[1];
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
perr.style.display='block';
var res = req.responseText;
var b = JSON.parse(res);

if(b.status==1){
	perr.style.display='none';
	var rr = document.getElementById(dv);
	rr.parentNode.removeChild(rr);
}
else if(b.status==2){
perr.style.display='block';
err.innerHTML='<div>'+b.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';	
}
		}else{
perr.style.display='block';
err.innerHTML='<div>Deleting image please wait...</div><br/><img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	var par="pid="+pid+"&iid="+iid+"&a="+a;
	req.open("POST","productImageDel.php",true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(par);
	
}
function addImg(pid){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd');
			var req;
			if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function()
	{if(this.readyState==4 && this.status==200){
var js=this.responseText;
var ob=JSON.parse(js);
if(ob.aq==1)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==2)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==3)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==4)
{
var dvv = document.createElement("div");
dvv.id="I1"+pid+ob.iid;
dvv.className="dispblk smallImg2"
dvv.style.position='relative';
dvv.innerHTML='<div class="delLink" style="position:absolute;top:10px;right:10px;z-index:1"><a title="Delete" onClick="delImg(\'I1'+pid+ob.iid+'\',\''+pid+':'+ob.iid+'\',1)"></div><img src="smallImage/'+ob.img+'" style="min-height:80px;min-width:100px" alt="" />';
var pr=document.getElementById('I1Thumb');
pr.appendChild(dvv);
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}
	}
	else{
perr.style.display='block';	
err.innerHTML='<div>Uploading image...</div><br/><img src="frmgIa/smallLoader.gif" alt="" />';		
	}}
			var fd = new FormData();
        fd.append("imgg", frm.imgBig.files[0]);
		fd.append("pid", pid);
		req.addEventListener("load", tCo, false);
		req.addEventListener("error", tFa, false);
		req.addEventListener("abort", tCa, false);
		req.open("POST","productImage.php",true);
		req.send(fd);
		frm.elements[0].disabled=true;
		
}
function tCo(evt) {
var perr=document.getElementById('popErr');	
var frm = document.getElementById('imgAdd');
perr.style.display='none';
frm.elements[0].disabled=false;
} 
function tFa(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd');
perr.style.display='block';	
err.innerHTML='<div>Upload failed</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.elements[0].disabled=false;
}
 
function tCa(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd');
perr.style.display='block';	
err.innerHTML='<div>Upload cancelled</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.elements[0].disabled=false;
}
function addImg2(pid){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd2');
			var req;
			if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function()
	{if(this.readyState==4 && this.status==200){
var js=this.responseText;
var ob=JSON.parse(js);
if(ob.aq==1)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==2)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==3)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==4)
{
var pr=document.getElementById('I2Thumb').innerHTML='<div id="I2'+pid+'"><div class="delLink" style="position:absolute;top:10px;right:10px;z-index:1"><a title="Delete" onClick="delImg(\'I2'+pid+'\',\''+pid+':0\',2)">X</a></div><img src="displayImage/'+ob.img+'" style="min-height:80px;min-width:100px" alt="" /></div>';
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}
	}
	else{
perr.style.display='block';	
err.innerHTML='<div>Uploading Display image...</div><br/><img src="frmgIa/smallLoader.gif" alt="" />';		
	}}
			var fd = new FormData();
        fd.append("imgg", frm.imgDisp.files[0]);
		fd.append("pid", pid);
		req.addEventListener("load", tCo2, false);
		req.addEventListener("error", tFa2, false);
		req.addEventListener("abort", tCa2, false);
		req.open("POST","productImage2.php",true);
		req.send(fd);
		frm.elements[0].disabled=true;
		
}
function tCo2(evt) {
var perr=document.getElementById('popErr');	
var frm = document.getElementById('imgAdd2');
perr.style.display='none';
frm.elements[0].disabled=false;
} 
function tFa2(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd2');
perr.style.display='block';	
err.innerHTML='<div>Upload failed</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.elements[0].disabled=false;
}
 
function tCa2(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('imgAdd2');
perr.style.display='block';	
err.innerHTML='<div>Upload cancelled</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.elements[0].disabled=false;
}
function addSlid(id,hd,sb,ln){
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('addSld');
var ko=0;
var pn=id;
var md=hd;
var cat=sb;
var scat=ln;
var sim=frm.imgs.value;
if(pn=="" || pn.length==0)
{
	ko=1;
 	msg='Slide number is empty!';
}else if(md=="" || md.length==0)
{
	ko=1;
 	msg='Title is empty!';
}
else if(cat=="" || cat.length==0)
{
	ko=1;
 	msg='Subtitle is empty!';
}
else if(scat=="" || scat.length==0)
{
	ko=1;
 	msg='Link is empty!';
}
else if(sim=="" || sim.length==0)
{
	ko=1;
 	msg='Image is empty!';
}
if(ko==1){
perr.style.display='block';	
err.innerHTML='<div>'+msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else{			var req;
			if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function()
	{if(this.readyState==4 && this.status==200){
var js=this.responseText;
if(js==""){return;}
bringSlides();
var ob=JSON.parse(js);
if(ob.aq==1)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==2)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==3)
{
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}else if(ob.aq==4)
{
var flen=frm.length-1;	
for(var i=0;i<flen;i++){
	frm.elements[i].value='';
}
perr.style.display='block';	
err.innerHTML='<div>'+ob.msg+'</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
}
	}
	else{
perr.style.display='block';	
err.innerHTML='<div>Uploading image...</div><br/><img src="frmgIa/smallLoader.gif" alt="" />';		
	}}
			var fd = new FormData();
        fd.append("imgg", frm.imgs.files[0]);
		fd.append("id", id);
		fd.append("hd", hd);
		fd.append("sb", sb);
		fd.append("lnk", ln);
		req.addEventListener("load", tCo3, false);
		req.addEventListener("error", tFa3, false);
		req.addEventListener("abort", tCa3, false);
		req.open("POST","addSlds.php",true);
		req.send(fd);
		frm.btn.disabled=true;
}
}
function tCo3(evt) {
var perr=document.getElementById('popErr');	
var frm = document.getElementById('addSld');
perr.style.display='none';
frm.btn.disabled=false;
} 
function tFa3(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('addSld');
perr.style.display='block';	
err.innerHTML='<div>Upload failed</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.btn.disabled=false;
}
 
function tCa3(evt) {
var perr=document.getElementById('popErr');
var err=document.getElementById('frmErr');	
var frm = document.getElementById('addSld');
perr.style.display='block';	
err.innerHTML='<div>Upload cancelled</div><br/><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popErr\').style.display=\'none\'" />';
frm.btn.disabled=false;
}
function srcProd(c,s,p){
	var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
document.getElementById('loadView').innerHTML=req.responseText;				
		}else{
document.getElementById('loadView').innerHTML='<img src="frmgIa/bigLoader.gif" alt="" />';
		}
	}
	c=encodeURIComponent(c);
	s=encodeURIComponent(s);
	req.open("GET","productView.php?c="+c+"&q="+s+"&p="+p,true);
	req.send("");
	
}
function edtProd(pid){
var perr=document.getElementById('popEdt');
var err=document.getElementById('frmEdt');
perr.style.display='block';
var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
err.innerHTML='<div style="text-align:right"><input class="inputWbtn" type="button" value="Close" onClick="document.getElementById(\'popEdt\').style.display=\'none\'" /></div>'+req.responseText;				
		}else{
err.innerHTML='<div>Loading</div><br/><img src="frmgIa/smallLoader.gif" alt="" />';
		}
	}
	req.open("GET","productEdit.php?pid="+pid,true);
	req.send("");
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body onLoad="<?php if(isset($_GET['a'])){ if($_GET['a']==1){echo 'addProd()';}elseif($_GET['a']==2){echo 'viewProd(1)';}elseif($_GET['a']==3){echo 'slids()';}elseif($_GET['a']==4){echo 'feats()';}} ?>" >
<div id="popErr" style="display:none;position:fixed;top:0;left:0;z-index:12;width:100%;height:100%;text-align:center;background:rgba(140,140,140,0.8)">
	<div id="frmErr" class="fontblack font16" style="width:250px;min-height:80px;text-align:center;padding:10px;margin:0 auto;margin-top:70px;background:#fff;box-shadow:0 0 10px #000">
    
    </div>
</div>
<div id="popEdt" style="display:none;position:fixed;top:0;left:0;z-index:11;width:100%;height:100%;overflow:auto;text-align:center;background:#333">
	<div id="frmEdt" class="fontblack font16" style="min-height:80px;text-align:center;padding:10px;margin:0 auto;margin-top:70px;background:#fff;box-shadow:0 0 10px #000">
    	
    </div>
</div>
    <div class="dispblk menuAlink" style="width:100%;min-height:40px;background:#999;text-align:left">
      <a href="?a=1">Add product</a>
      <a href="?a=2">View product</a>
      <a href="?a=3">Add slides</a>
      <a href="?a=4">Featured</a>
      <a href="?a=5">Advertise</a>
      <a style="float:right" href="clog.php">Logout</a>
    </div>
    <div id="loadPlace" style="text-align:left">
    	
        <div>
        	
        </div>
        
    </div>
</body>
</html>