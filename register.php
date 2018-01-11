<html>
<head>
<title>Register</title>
<script language="javascript">
function valid()
{
	var frm=document.getElementById('frm1');
	var eml=frm.email.value;
	var ceml=frm.cemail.value;
	var pwd=frm.pass.value;
	var cpwd=frm.cpass.value;
	var ph=frm.phone.value;
	var billing=frm.billing.value;
	var shipping=frm.shipp.value;
	document.getElementById('val').innerHTML='';
	
    if(eml=='')
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Provide an email id</div>';

	}
	else if(eml!=ceml)
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Emails do not match</div>';
	
	}
	else if(pwd=="")
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Provide password</div>';
		
	}
	
	else if(pwd!=cpwd)
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Passwords do not match</div>';
	
	}
	else if(ph=='' ||ph.length!=10)
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Provide proper Phone number</div>';
		
	}
	else if(billing=="")
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Provide billing address</div>';
		
	}
	else if(shipping=="")
	{
		document.getElementById('val').innerHTML='<div style="color:#f00">Provide shipping address</div>';
		
	}
	else
	{
	send(eml,ceml,pwd,cpwd,ph,billing,shipping);
	}
  }  
  function send(eml,ceml,pwd,cpwd,ph,billing,shipping)
		{
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var obj = xmlhttp.responseText;
				var ob = JSON.parse(obj);
				if(ob.flag == 1)
				{
					document.getElementById("val").innerHTML='<div style="color:#000;font-size:14px">'+ob.msg+'</div><div class="mbtn"><a href="login.php">Login</a></div>';
					document.getElementById("div1").style.display = 'none';
				}
				else if(ob.flag == 2)
				{
					document.getElementById("val").innerHTML='<div style="color:#f00">'+ob.msg+'</div>';
				}
				
		}}
		var cont = "email="+eml+"&cemail="+ceml+"&pass="+pwd+"&cpass="+cpwd+"&phone="+ph+"&billing="+billing+"&shipp="+shipping;
		xmlhttp.open("POST","3reg.php",true);
		xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xmlhttp.send(cont);
		}
  
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>

<body>
<?php include('./navbar.php'); ?>

<div class="clmain">
		<div class="fontblack" style="font-size:32px">Register</div>
        <div style="text-align:center">
        <div id="val" style="width:350px;margin:0 auto;text-align:left;padding-bottom:10px"></div>
        	<div id="div1" style="width:250px;margin:0 auto;text-align:left">
            
                
            <div id="" class="fontblack font14">
            <form id="frm1" onSubmit="return false">
            Email : <br/><input class="inputCls" type="text" name="email" /><br/><br/>
            Confirm email : <br/><input class="inputCls" type="text" name="cemail" /><br/><br/>
            Password : <br/><input class="inputCls" type="password" name="pass" /><br/><br/>
            Confirm password : <input class="inputCls" type="password" name="cpass" /><br/><br/>
            Phone : <br/><input class="inputCls" type="text" name="phone" /><br/><br/>
            Billing address : <br/><textarea class="inputCls" name="billing" style="min-width:200px;max-width:200px;min-height:130px;max-height:130px"></textarea><br/><br/>
            Shipping address : <br/><textarea class="inputCls" name="shipp" style="min-width:200px;max-width:200px;min-height:130px;max-height:130px"></textarea><br/><br/>
            <input type="checkbox" class="dispblk" name="chk" style="margin-top:2px" /> Do you accept terms and conditions?<br/><br/>
             <input class="inputBtn" type="button" value="Register" onClick="valid();"/>
             </form>
             </div>
             <div class="fontblack">Already registered? <font class="blueLink"><a href="register.php">Login</a></font></div>        
             </div>       
           
            </div>
        </div>
        
<?php include('./footer.php'); ?>
</body>
</html>