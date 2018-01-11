<div class="navbar">
	<div class="nav1">
		<div class="nav1in">
		<div class="dispblk logo">WaYuNee</div>
        <div class="displblk menulink2" style="width:500px;padding-top:5px;position:absolute;top:10px;right:0;text-align:right">   
        <div>              
                <a href="checkout.php">Check out</a>
 <?php
		if(isset($_SESSION['uid']))
		{
			    echo $_SESSION["username"];
				echo ' <a href="myaccount.php">My account</a>';
				echo ' <a href="logout.php">Log out</a>';
		   
		}
        else
        {
			echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
		
		}  ?>
        </div>
        <div style="margin-top:8px"><a class="cartA" href="cart.php"><div class="dispblk cartBox"></div><div class="dispblk cartText">CART</div><div id="crtCount" class="dispblk cartCount">0</div></a></div>
        </div>
		</div>
		
	</div>
	<div class="nav2" id="nv">
		<div class="nav2in menulink">
        <div style="position:relative">
        <div id="m1" class="dd" style="position:absolute;top:46px;left:53px;min-height:100px;min-width:400px;display:none;background:#F8EFD0;z-index:10;text-align:left;border:#ccc 1px solid;border-top:none" onmouseover="cancel()" onmouseout="dropOut('m1')"></div>
			<a href="./">Home</a>
			<a onmouseover="dropMenu('m1',1);document.getElementById('srcDv').style.display='none'" onmouseout="dropOut('m1')" href="#">Browse Prodcts</a>    
			
            </div>
            <div class="dispblk" style="padding-top:5px;position:absolute;top:0;right:0;text-align:right">
            
				<form action="search.php" method="get">
				<input class="searchbar" type="text" name="q" autocomplete="off" placeholder="Search Products" onkeyup="getsrc(this.value)"/>
				<input class="searchBtn" style="margin-left:-5px;" type="submit" value="Search"/>
				</form>
                
			</div>
		</div>
    <div style="position:relative">
<div id="srcDv" class="srcdin">
            <div style="position:relative">
            <div class="delLink"  style="position:absolute;top:0;right:0"><a onClick="document.getElementById('srcDv').style.display='none'">X</a></div>
	    	<div id="srcIn" style="text-align:left"></div>
            </div>
            </div>
            </div>
</div>