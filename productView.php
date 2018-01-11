<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$q="";
$found="";
$ctg=1;
if(isset($_GET['q']) && $_GET['q']!="")
{
$q=strtolower($_GET['q']);
$q=stripslashes($q);
}
if(isset($_GET['c']) && $_GET['c']!="")
{
$c=stripslashes($_GET['c']);
$ctg = (int)$c;
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

$pr = 25;
$pl = 'LIMIT ' .($pageno - 1) * $pr .',' .$pr;




if($q!=""){
	
$s=$conn->query('select * from products where pname LIKE \'%'.$q.'%\' and category='.$ctg.' order by pname asc '.$pl.'');
}else{
$s=$conn->query('select * from products where category='.$ctg.' order by pname asc '.$pl.'');	
}

	
$pfound=$s->num_rows;
echo $conn->error;

if($pfound)
 {
  for($i=0; $i<$pfound; $i++)
    {
    	$data=$s->fetch_array();  	
		$cat="Accessories";
		if($data['category']==2){
			$cat="Clothing";
		}else if($data['category']==3){
			$cat="Groceries";
		}
		$stk="In Stock";
		if($data['stock']==2){
		$stk="Out of stock";	
		}
		
		$found.='<tr id="row'.$data['pid'].'">
						<td id="'.$data['pid'].'">'.$data['pid'].'</td>
						<td>'.$data['pname'].'</td>
						<td>'.$data['mname'].'</td>
						<td>'.$cat.'</td>
						<td>'.$data['seller'].'</td>
						<td>'.$stk.'</td>
						<td>'.$data['numStock'].'</td>
						<td>'.$data['price'].'</td>
						<td><input type="button" class="inputWbtn" value="Edit" onClick="edtProd('.$data['pid'].')" /></td>
						<td><input type="button" class="inputWbtn" value="Delete" onClick="delProd('.$data['pid'].')" /></td>
					</tr>';
	  
	}
 }
?>
<div class="listTab">
     <table style="width:100%;height:100px">
     <tr>
     	<th>PID</th>
        <th>PRODUCT NAME</th>
        <th>MODEL NAME</th>
        <th>CATEGORY</th>
        <th>SELLER</th>
        <th>STOCK</th>
         <th>Number of Stock</th>
        <th>PRICE(Rs)</th>
        <th colspan="2"></th>
     </tr>
        
        <?php
		if($found!=""){
			echo $found;
		}else{echo '<tr>
						<td colspan="10">Nothing found</td>
					</tr>';}
       ?>
       <tr>
     	<th>
        <?php if($pageno>1){?>
        <input type="button" class="inputWbtn" value="Prev" onClick="srcProd(<?php echo $ctg; ?>,'<?php echo $q; ?>',<?php echo $pageno-1; ?>)" />
        <?php } ?>
        </th>
     	<th colspan="8"></th>
        <th>
        <?php if($pfound){?>
        <input type="button" class="inputWbtn" value="Next" onClick="srcProd(<?php echo $ctg; ?>,'<?php echo $q; ?>',<?php echo $pageno+1; ?>)" />
        <?php }?>
        </th>
     </tr>
     </table>
