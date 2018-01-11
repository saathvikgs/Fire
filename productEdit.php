<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
include('conn.php');
$flag = 0;
$msg = "";
	$pn = "";
	$md = "";
	$cat = "";
	$sel = "";
	$stk = "";
	$nstk = "";
	$prc = "";
	$dImg = "";
	$thumbs = "";
	
	$kf = "";
	$ds = "";
	$kfp = "";
	
	$ftr = "";
if(isset($_GET['pid'])){	
	
	$pid = $_GET['pid'];
	$qr='select * from products where pid='.$pid.' LIMIT 1';
	$qr2='select imageName,addedon from prodimage where pid='.$pid.'';
	$qr3='select description,keyFeature from prodkeyfeature where pid='.$pid.' LIMIT 1';
	$qr4='select addedon,title,feature from prodfeature where pid='.$pid.'';
	
	$test = $conn->query($qr);
	
	if($test){
		$flag = 1;
		$data=$test->fetch_array();
		$pn=$data['pname'];
		$md=$data['mname'];
		$cat=$data['category'];
		$sel=$data['seller'];
		$stk==$data['stock'];
		$nstk=$data['numStock'];
		$prc=$data['price'];
		if($data['displayImage']!=""){
			$dImg = '<div id="I2'.$pid.'"><div class="delLink" style="position:absolute;top:10px;right:10px;z-index:1"><a title="Delete" onClick="delImg(\'I2'.$pid.'\',\''.$pid.':0\',2)">X</a></div><img src="displayImage/'.$data['displayImage'].'" style="min-height:80px;min-width:100px" alt="" /></div>';	
		}
		
		$test2=$conn->query($qr2);
		$count=$test2->num_rows;
		for($i=0;$i<$count;$i++)
		{
			$dt=$test2->fetch_array();
$thumbs.='<div id="I1'.$pid.$dt['addedon'].'" class="dispblk smallImg2" style="position:relative"><div class="delLink" style="position:absolute;top:10px;right:10px;z-index:1"><a title="Delete" onClick="delImg(\'I1'.$pid.$dt['addedon'].'\',\''.$pid.':'.$dt['addedon'].'\',1)">X</a></div><img src="smallImage/'.$dt['imageName'].'" style="min-height:80px;min-width:100px" alt="" /></div>';
		}
		
		$test3=$conn->query($qr3);
		$count2=$test3->num_rows;
		if($count2){
		$dt=$test3->fetch_array();
		$ds=$dt['description'];
		$kf=$dt['keyFeature'];
		$arr=explode(';',$kf);	
		$kfc=count($arr);
			for($i=0;$i<$kfc;$i++)
			{
				$kfp.='<li>'.$arr[$i].'</li>';
			}
			$kfp='<ul>'.$kfp.'</ul>';
		}
		
		$test4=$conn->query($qr4);
		$count3=$test4->num_rows;
		if($count3){
			for($i=0;$i<$count3;$i++)
			{
		$dt=$test4->fetch_array();
		$iid=$dt['addedon'];
		$ttl=$dt['title'];
		$fre=$dt['feature'];
		$ftr.='<tr id="ftrow'.$pid.$iid.'"><td style="max-width:200px">'.$ttl.'</td><td>'.$fre.'</td><td style="max-width:100px"><input class="inputWbtn" type="button" value="Delete" onclick="delFtr('.$pid.','.$iid.')" /></td></tr>';
			
			}
		}
		
	}else{
		$flag = 2;
		$msg = $conn->error;	
	}
	
}
$conn->close();
?>
<div>
<div class="dispblk fontblack" style="width:350px;text-align:right;padding:10px">
        	<div style="font-size:30px; text-align:left">Product id : <?php echo $pid ?></div>
<form id="saveFrm" onSubmit="saveProd(<?php echo $pid; ?>);return false">
<div class="font15">Product name : <input class="inputCls2" type="text" name="pname" value="<?php echo $pn; ?>" /></div>
<div class="font15">Model : <input class="inputCls2" type="text" name="model" value="<?php echo $md; ?>" /></div>
<div class="font15">Category : <select class="inputCls2" name="categ">
            <option value="1" <?php if($cat==1){ echo 'selected="selected"'; } ?>>Accessories</option>
            <option value="2" <?php if($cat==2){ echo 'selected="selected"'; } ?>>Clothing</option>
            <option value="3" <?php if($cat==3){ echo 'selected="selected"'; } ?>>Groceries</option>
            <option value="3" <?php if($cat==4){ echo 'selected="selected"'; } ?>>Food</option>
                        </select>
</div>
<div class="font15">Seller : <input class="inputCls2" type="text" name="sellr" value="<?php echo $sel; ?>" /></div>
<div class="font15">Stock : <select class="inputCls2" name="stk">
            <option value="1" <?php if($stk==1){ echo 'selected="selected"'; } ?>>In stock</option>
            <option value="2" <?php if($stk==2){ echo 'selected="selected"'; } ?>>Out of stock</option>
                        </select>
</div>
<div class="font15">Number of Stocks : <input class="inputCls2" type="text" name="numstk" value="<?php echo $nstk; ?>" /></div>
<div class="fontdarkgrey font13">Price should be in Rupees</div>
<div class="font15">Unit Price : <input class="inputCls2" type="text" name="prc" value="<?php echo $prc; ?>" /></div>
<div><input class="inputAdd" type="button" value="SAVE" onClick="saveProd(<?php echo $pid; ?>)" /></div>
</form>
</div>
<div class="dispblk fontblack" style="width:450px;text-align:right;padding:10px">
	<div style="border:1px #ccc solid;text-align:center">
            	<div id="I1Thumb" style="min-height:100px;padding:10px">
                	<div class="dispblk smallImg2"><input class="inputWbtn" type="button" value="Add image" onclick="document.getElementById('imgAdd').imgBig.click()" />
  <div style="display:none"><form id="imgAdd" onsubmit="return false"><input type="file" name="imgBig" onchange="addImg(<?php echo $pid; ?>)" /></form></div>
                    </div>
                    <?php echo $thumbs; ?>
            	</div>
    		
				</div>
    
    <div>
    	<div class="fontblack font14" style="margin:10px 0;border-top:1px #ccc solid">Display image</div>
    	<div id="I2Thumb" class="displayImg" style="position:relative"><?php echo $dImg; ?></div>
        <div style="display:none"><form id="imgAdd2" onsubmit="return false"><input type="file" name="imgDisp" onchange="addImg2(<?php echo $pid; ?>)" /></form></div>
        <div><input class="inputWbtn" type="button" value="Add image" onclick="document.getElementById('imgAdd2').imgDisp.click()" /></div>
    </div>
</div>
</div>

<div>
<div style="font-size:30px; text-align:left;border-top:1px #ccc solid">Briefing</div>
<div style="margin:0 auto;background:#f8f8f8;width:80%;max-width:800px;min-height:120px">
<div class="fontgrey font13">Key features preview</div>
<div id="kfPrv" class="fontdarkgrey" style="padding:10px;text-align:left"><?php echo $kfp; ?></div>
</div>
<form id="saveFrm2" onSubmit="saveDes(<?php echo $pid; ?>,1);return false">
<div><div class="fontdarkgrey font15">Key features (use ; (semicolon) to make bulleted list</div><textarea class="inputCls2" style="width:80%;max-width:800px;height:120px;max-height:120px" name="kft" onkeyup="kfPrev(this.value)"><?php echo $kf; ?></textarea></div>
<div class="font15">Description : <br/><textarea class="inputCls2" style="width:80%;max-width:800px;height:120px;max-height:120px" name="des"><?php echo $ds; ?></textarea></div>
<div><input class="inputAdd" type="button" value="SAVE" onClick="saveDes(<?php echo $pid; ?>,1)" /></div>
</form>
</div>

<div>
<div style="font-size:30px; text-align:left;border-top:1px #ccc solid">Features</div>
<div style="margin:0 auto;background:#f8f8f8;width:80%;max-width:800px;min-height:120px">
<div class="fontgrey font13">Features preview</div>
<div class="keyTab" style="padding:10px">
                <table style="min-width:500px" id="ftTable">
                <?php echo $ftr; ?>
                </table>
</div></div>
<div style="margin:0 auto;width:80%;max-width:800px">
<form id="saveFrm3" onSubmit="saveDes2(<?php echo $pid; ?>);return false">
<div class="fontdarkgrey font15" style="text-align:left">Title : <input class="inputCls2" type="text" name="ttl" /></div>
<div class="fontdarkgrey font15" style="text-align:left">Feature :</div>
<div style="text-align:left">
  <textarea class="inputCls2" style="width:80%;max-width:800px;height:80px;max-height:80px" name="ft" onkeyup="kfPrev(this.value)"></textarea>
</div>
<div><input class="inputAdd" type="button" value="SAVE" onClick="saveDes2(<?php echo $pid; ?>)" /></div>
</form>
</div>
</div>