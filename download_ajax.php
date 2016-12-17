<?php
#header('Content-Type: text/html; charset: utf-8');
include 'functions.php';


$lang 		= isset($_GET['lang']) ? trim($_GET['lang']) : 'mk';
$filename 	= $lang . ".php";


$list = getListAll('other');




$re = "<?php \n/*	NRB Language " . date('Y.m.d') . "	*/ \n/***************************************/\n";
foreach($list[$lang] as $k=>$v)
{
	$len = strlen($k);
	
	$br = 50 - $len;
	$lr = "";
	for($i=1; $i <=$br; $i++)
		$lr .=" ";
	
	$v = str_replace("<", "\<", $v);
	$v = str_replace("\n", "\\n", $v);
	$v = str_replace('"', "'", $v);
	
	$re .= '$'."fjl['" . $lang . "']['" . $k . "'] =$lr".'"' . $v . '"'. ";\n";
	
}
$re .= "\n?>";

header("Content-Type: application/php");
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Content-Length: " . strlen($re));
print $re;
exit;

?>