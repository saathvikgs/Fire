<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function hypo(var a,var b)
{
	function square(var x)
	{
		return (x*x);	
	}
	var result = Math.sqrt(square(a) + square(b));
	document.write(result);
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<input type="button" onclick="hypo(5,12)" value="Get Value" />
 
</body>
</html>