<?php sleep(2);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$list = "";
$ctg = 1;
$q = "";
if(isset($_GET['c']) && $_GET['c']!="")
{
$c=stripslashes($_GET['c']);
$ctg = (int)$c;
}
if(isset($_GET['q']) && $_GET['q']!="")
{
$q=stripslashes($_GET['q']);
}	
if (isset($_GET['p'])) {
   $pageno = $_GET['p'];
   $pageno = (int)$pageno;
} else {
   $pageno = 1;
} 

if ($pageno < 1) {
   $pageno = 1;
} 
$next=$pageno+1;
$pr = 1;
$pl = 'LIMIT ' .($pageno - 1) * $pr .',' .$pr;
	
	$ok = 0;
if($ctg!="" && $q!=""){	
$qr = 'select pid,pname,price,displayImage from products where pname like \''.$q.'%\' and category='.$ctg.' order by pname asc '.$pl.'';
$ok = 1;
}else if($ctg!=""){
$qr = 'select pid,pname,price,displayImage from products where category='.$ctg.' order by pname asc '.$pl.'';	
$ok = 1;
}
	if($ok == 1){
			$test = $conn->query($qr);
			$count = $test->num_rows;
			if($count){
				for($i=0;$i<$count;$i++){					
					$dt = $test->fetch_array();
					if($dt['displayImage'] != ""){
					$img = '<img src="displayImage/'.$dt['displayImage'].'" style="min-height:100px;min-width:100px;width:150px" alt="" />';
					}else{
					$img = '';	
					}
					if($list == "")
					{
						$list = '<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="padding-left:6px;text-align:left">				<a href="#">Add to cart</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.'.$dt['price'].'</div>			</div>			</div>		</div>';
					}else{
					$list .= '<div class="blk"><a href="v.php?pid='.$dt['pid'].'"><div class="btm">'.$img.'</div></a><div class="btm2"><div style="padding-left:6px;text-align:left">'.$dt['pname'].'</div><div style="text-align:left;margin-top:8px;position:relative">				<div class="dispblk abtn" style="padding-left:6px;text-align:left">				<a href="#">Add to cart</a>				</div>				<div class="dispblk cartfont" style="text-align:right;position:absolute;top:0;right:4px">Rs.'.$dt['price'].'</div>			</div>			</div>		</div>';
					}
				}
			
			}
	}
if($list == ""){
	$list = '<div class="fontblack font16" style="height:80px;line-height:80px;text-align:center">End folks</div>';
}else{
	$list=$list.'<div id="listdiv'.$next.'"><div style="text-align:center" class="loadMoreBox"><a id="lista'.$next.'" onclick="loadPr(\'listdiv'.$next.'\','.$ctg.',\''.$q.'\','.$next.')">Load more</a></div></div>';	
}
	echo $list;
$conn->close();
?>