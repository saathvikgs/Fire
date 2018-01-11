<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$q = "";
$dvv = "";
if(isset($_GET['q'])){
	$q = strtolower($_GET['q']);
}

if($q == ''){
 die('<div class="fontblack font14" style="height:100px;line-height:100px;text-align:center">Type to search</div>');	
}
		$qr='select pid,pname,category from products where pname like \''.$q.'%\' order by pname asc LIMIT 5';
			$test = $conn->query($qr);
			$count = $test->num_rows;
			if($count){
				for($i=0;$i<$count;$i++){					
					$dt = $test->fetch_array();
					$cat = 'Accessories';
					$c=$dt['category'];
						if($c==2){
							$cat = 'Clothing';
						}else if($c==3){
							$cat = 'Groceries';
						}else if($c==4){
							$cat = 'Food';
						}
					if($dvv == ""){
						$dvv = '<a href="search.php?c='.$c.'&q='.$q.'">'.$dt['pname'].'<br/><span style="color:#900;font-size:12px">'.$cat.'</span></a>';
					}else{
						$dvv .= '<a href="search.php?c='.$c.'&q='.$q.'">'.$dt['pname'].'<br/><span style="color:#900;font-size:12px">'.$cat.'</span></a>';
					}
				}
			}
				
				if($dvv != ""){
					$dvv = '<div class="srcLink" style="width:380px;max-width:380px">'.$dvv.'</div>';	
				}else{
					$dvv = 	'<div class="fontblack font14" style="height:100px;line-height:100px;text-align:center">Your search returned nothing</div>';
				}			
echo $dvv;	
$conn->close();
?>