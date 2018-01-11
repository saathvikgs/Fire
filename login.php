<?php 
session_start();
$logged = 0;
$er = 0;
$err = "";
		if(isset($_SESSION["uid"]))
		{
			$logged = 1;
		}
if(isset($_GET['e']) && is_numeric($_GET['e'])){
		if($_GET['e']==1){
			 $er = $_GET['e'];	
			 $err = 'Username or password does not match';
		}
}
?>
<html>
<head>
<title>Login</title>
<script language="javascript" src="scripts/glfx14.js"></script>
<link href="./stle/tsxyl.css" rel="stylesheet" type="text/css"/>
<body>

<?php include('./navbar.php'); ?>
	<div class="clmain">
		<div class="fontblack" style="font-size:32px">
		<?php
		if(!$logged)
		{
			echo 'Login';		
		}
		?></div>
        <div style="text-align:center">        
        <?php
		if($logged)
		{
			
			echo '<div style="text-align:right;padding:10px 0 10px 0">Welcome '.ucfirst($_SESSION["username"]).'</div>';
			?>
            <div class="mbtn" style="background:#fff;text-align:left">
                <a href="#">Wishlist()</a>
                <a href="myaccount.php">My account</a>
                <a href="cart.php">Shopping cart</a>
                <a href="fav.php">Favourites</a>
                <a href="logout.php">Log out</a>
            </div>
		<?php	
		}
		else
		{
			?>
        	<div style="width:250px;margin:0 auto;text-align:left">
               <div id="val" style="width:250px;margin:0 auto;text-align:left;color:red;padding-bottom:10px">
               <?php 
			   if(isset($_GET['e']))
			   {
					if($_GET['e'] == 1)
					{
						echo 'One of the fields is empty';
					}
					else if($_GET['e'] == 2)
					{
						echo 'User not found';
					}
					else if($_GET['e'] == 3)
					{
						echo 'Unable to login';
					}
			   }
			   ?>
               </div> 
            <div>
            <form id="frm2" method="POST" action="2log.php">
             <input class="inputCls" type="text" name="usr" placeholder="Email Id" /><br/><br/>
             <input class="inputCls" type="password" name="pwd" placeholder="Password" /><br/><br/>
             <input class="inputBtn" type="submit" value="Login"/>
             </form>
             </div>
             <div class="blueLink" style="margin-bottom:5px"><a href="#">Forgot password</a></div>
             <div class="fontblack">Dont have account? <font class="blueLink"><a href="register.php">Register</a></font></div>                 
             </div>       
           <?php } ?>
            </div>
            
            
        </div>
<?php include('./footer.php'); ?>
</body>
</html>