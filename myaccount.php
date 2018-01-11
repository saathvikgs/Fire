<?php 
session_start();
include('conn.php');
$logged = 0;
if(isset($_SESSION['uid']))
{
	$user = $_SESSION['uid'];
	$sadd = '';
	$badd = '';
	$ph = '';
	$logged = 1;
		$qur = "select * from loguser where uid='$user'";
		$test = $conn->query($qur);
		$count = $test->num_rows;
		if($count)
		{
				$arr=$test->fetch_array();
				$sadd=$arr['shipping'];
				$badd=$arr['billing'];
				$ph=$arr['phone'];
	   					 
		 }
	
}
?>

<html>
<head>
<title>My account</title><script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
document.getElementById('ediv').style.display='none';
function updateAdd(phn,shadd,biadd)
{
		document.getElementById('svch').disabled=true;
		document.getElementById('svch').className='inputBtn2';
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
			document.getElementById('svch').disabled=false;
			document.getElementById('svch').className='inputBtn';
			document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			
		}
		else
				{
					document.getElementById("myDiv").innerHTML='<img src="frmgIa/smallLoader.gif" alt="Please wait.."/>';
					
				}
	  }
	  
	shadd=encodeURIComponent(shadd); 
	biadd=encodeURIComponent(biadd); 
	var cont="ph="+phn+"&sadd="+shadd+"&badd="+biadd;
	xmlhttp.open("POST","update.php",true);
	xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmlhttp.send(cont);
}
function changepwd(npw,pwd,opwd)
{
	 if(npw=="")
	{
		document.getElementById('myDiv2').innerHTML='<div style="color:#f00">Provide password</div>';
		return;
	}else if(pwd=="")
	{
		document.getElementById('myDiv2').innerHTML='<div style="color:#f00">Retype password</div>';
		return;
	}
	else if(npw!=pwd)
	{
		document.getElementById('myDiv2').innerHTML='<div style="color:#f00">Passwords do not match</div>';
		return;
	}
	else if(opwd=="")
	{
		document.getElementById('myDiv2').innerHTML='<div style="color:#f00">Provide current password</div>';
		return;
	}
		document.getElementById('chp').disabled=true;
		document.getElementById('chp').className='inputBtn2';
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
			document.getElementById('chp').disabled=false;
			document.getElementById('chp').className='inputBtn';
			
			var obj = xmlhttp.responseText;
				var ob = JSON.parse(obj);
				if(ob.flag == 1)
				{
					document.getElementById("cfrm").npwd.value="";
					document.getElementById("cfrm").rnpwd.value="";
					document.getElementById("cfrm").cpwd.value="";
					document.getElementById("myDiv2").innerHTML='<div style="color:#6c0;font-size:14px"><b>'+ob.msg+'</b></div>';
				}
				else if(ob.flag == 2)
				{
			document.getElementById("myDiv2").innerHTML='<div style="color:#f00;font-size:14px">'+ob.msg+'</div>';
				}
			
		}
		else
				{
					document.getElementById("myDiv2").innerHTML='<img src="frmgIa/smallLoader.gif" alt="Please wait.."/>';
					
				}
	  }
	  
	pwd=encodeURIComponent(pwd);  
	var cont="pwd="+pwd+"&opwd="+opwd;
	xmlhttp.open("POST","changepwd.php",true);
	xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmlhttp.send(cont);
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="fontblack" style="font-size:32px;padding:10px;border-bottom:1px #ccc solid">My Account</div>
<?php
if($logged)
{ 
?>
<div class="mbtn" style="margin-top:10px;background:#fff;text-align:right">
    <a href="myOrders.php">My Orders</a> <a onClick="document.getElementById('ediv').style.display='block';document.getElementById('cdiv').style.display='none';document.getElementById('dispInfo').style.display='none'">Edit My Details</a>            <a onClick="document.getElementById('cdiv').style.display='block';document.getElementById('ediv').style.display='none';document.getElementById('dispInfo').style.display='none'">Change password</a>
                </div>
                <div id="dispInfo" class="dispblk" style="width:200px;height:200px;disaply:block;margin-top:20px">
	<div style="text-align:left;display:inline-block"><b>Phone number:</b> <?php echo $ph;?></div></br></br>
    <div style="text-align:left;display:inline-block"><b>Shipping Address:</b> <?php echo $sadd;?></div></br></br>
    <div style="text-align:left;display:inline-block"><b>Billing Address:</b> <?php echo $badd; ?></div>
</div>
<div id="ediv" style="margin:0 0 0 25px;text-align:left;width:300px;display:none">
<div class="fontdarkgrey" style="font-size:20px;margin-bottom:20px">Edit My Details</div>

		<form onsubmit='return false'>
		<b>Phone number:</b> <input class="inputCls" type="text" name="ph" value='<?php echo $ph; ?>'/></br></br>
		<b>Shipping Address:</b> <textarea class="inputCls" name='sad' style="min-width:200px;max-width:200px;min-height:130px;max-height:130px"><?php echo $sadd; ?></textarea></br></br>
		<b>Billing Address:</b> <textarea class="inputCls" name='bad' style="min-width:200px;max-width:200px;min-height:130px;max-height:130px"><?php echo $badd; ?></textarea></br></br>
         <input id="svch" class="inputBtn" type='button' value='Save Changes' onclick='updateAdd(ph.value,sad.value,bad.value)'/> 
        </form>
<div id="myDiv"></div>
</div>

<div id="cdiv" style="margin:25px 0 0 25px;text-align:left;width:300px;display:none">
    <form id="cfrm" onsubmit='return false'>
        
        New password: <input class="inputCls" type="password" name='npwd'/></br>
        Retype new password: <input class="inputCls" type="password" name="rnpwd"/></br>
        current password: <input class="inputCls" type="password" name='cpwd'/></br>
        <input id="chp" type="button" class="inputBtn" value="Change Password" onclick='changepwd(npwd.value,rnpwd.value,cpwd.value)'/>
    </form>
    <div id="myDiv2"></div>
</div>

<?php        
}
else
{
	?>
			<div style="margin-top:20px">
                <form id="frm2" method="POST" action="2log.php">
                 <input class="inputCls" type="text" name="usr" placeholder="Username" /><br/><br/>
                 <input class="inputCls" type="password" name="pwd" placeholder="Password" /><br/><br/>
                 <input class="inputBtn" type="submit" value="Login"/>
                 </form>
             </div>
             <div class="blueLink" style="margin-bottom:5px"><a href="#">Forgot password</a></div>
             <div class="fontblack font13">Dont have account? <font class="blueLink"><a href="register.php">Register</a></font></div>                  
       
<?php
 }
?>
	</div>	
    
  
<?php include('./footer.php'); ?>
</body>
</html>