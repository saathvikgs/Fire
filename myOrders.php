<?php 
session_start();
include('conn.php');
$logged = 0;
$user = 0;
$dis = "";
if(isset($_SESSION['uid']))
{
	$user = $_SESSION['uid'];
	$logged = 1;
	
}
?>

<html>
<head>
<title>My Orders</title><script language="javascript" src="scripts/glfx14.js"></script>
<script language="javascript">
function cancelord(ord)
{
var req;
	if(window.XMLHttpRequest){
	req=new XMLHttpRequest();
	}else{
	req=new ActiveXObject('Microsoft.XMLHTTP');	
	}
	req.onreadystatechange=function(){
		if(req.readyState==4 && req.status==200){
		document.getElementById("can"+ord).innerHTML = req.responseText;	
		}
	}
	req.open("GET","cancelorder.php?oid="+ord,true);
	req.send();
}
</script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

<?php include('./navbar.php'); ?>
	<div class="clmain">
<div class="fontblack" style="font-size:32px;padding:10px;border-bottom:1px #ccc solid">My Orders</div>
<?php
if($logged)
{ 
$qr='select * from orders where uid = '.$user.'';
    $test2=$conn->query($qr);
			$count2=$test2->num_rows;
			if($count2){
				for($i=0;$i<$count2;$i++){					
					$dt=$test2->fetch_array();
					$cancel = "";
					if($dt['status'] == 4)
					{
						$cancel = "Cancelled";	
					}else if($dt['status'] == 1)
					{
						$cancel = '<input class="inputBtn" type="button" value="Cancel" onclick="cancelord(\''.$dt['oid'].'\')" />';
					}
					$dis .= '
								<tr>
									<td>'.$dt['oid'].'</td>
									<td>'.$dt['email'].'</td>
									<td>'.$dt['ship'].'</td>
									<td>'.$dt['bill'].'</td>
									<td>'.date("d-l-Y, h:m:s a",$dt['Date']).'</td>
									<td><div id="can'.$dt['oid'].'">'.$cancel.'</div></td>
								</tr>';
				
					
					
				}echo '<div class="tabsty"><table>
								<tr>
									<th>ORDER ID</th>
									<th>EMAIL ID</th>
									<th>SHIPPING ADDRESS</th>
									<th>BILLING ADDRESS</th>
									<th>ORDER DATE</th>
									<th></th>
								</tr>'.$dis.'</table></div>';
			}
?>


<?php
}else{
	echo '<div style="padding:15px;background:#f8f8f8;border:1px #ccc solid;font-size:14px;text-align:center;margin-top:10px">You must login</div>';	
}
?>
	</div>	
    
  
<?php include('./footer.php'); ?>
</body>
</html>
