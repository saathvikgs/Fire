<?php 
session_start();
$logged = 0;
if(isset($_SESSION['clog']) && $_SESSION['clog'] == '12345xyz')
{
	echo '<META http-equiv="refresh" content="0;URL=cpnl.php">';
	exit;
}
else
{
	if(isset($_POST['pss']))
	{
		if($_POST['pss'] == '12345xyz')
		{
		$_SESSION['clog'] = '12345xyz';
		echo '<META http-equiv="refresh" content="0;URL=cpnl.php">';
	    exit;
		}
		else
		{
			$logged = 2;
		}
	}
	else
	{
		$logged = 3;
	}
}
?>
<html>
<head>
<title>Control panel</title>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

    <div class="dispblk menuAlink" style="width:100%;min-height:40px;background:#999;text-align:left">
      <a href="cpnlm.php">Control panel</a>
    </div>
    
    <div style="text-align:left;width:350px;margin:0 auto">
    <br/>
    <div class="font13"><?php if($logged == 2){echo '<font style="color:red">Wrong password</font>';}else if($logged == 3){echo '<b>Enter password</b>';} ?></div>
    <br/>
    <div>
    	<form method="post" action="cpnlm.php">
        <input type="password" name="pss" class="inputCls" placeholder="Password"/>
        <input type="submit" class="inputBtn" value="LOGIN"/>
        </form>
        </div>
        <div>
        	
        </div>
        
    </div>
</body>
</html>