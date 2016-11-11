<?php

$r=file_get_contents('http://ws.ovh.ca/dedicated/r2/ws.dispatcher/getAvailability2?callback=Request.JSONP.request_map.request_0');
$dic=file_get_contents('x.txt');
$dic2=file_get_contents('z.txt');
$t=explode(PHP_EOL, $dic);
$lookup=array();
$i=0;

foreach($t as $xd)
{

	$ell=explode(' ', $xd);

	if($ell[0]!='')
		$lookup["{$ell[1]}"]=$ell[0];


}
$t=explode(PHP_EOL, $dic2);
$lookup2=array();
$i=0;

foreach($t as $xd)
{

	$ell=explode(' ', $xd);

	if($ell[0]!='')
		$lookup2["{$ell[0]}"]=$ell[1];


}
$arr=explode('reference', $r);

unset($arr[0]);
$out='NOTHING';
foreach($arr as $a)
{

	$b=explode('availability":"', $a);
	unset($b[0]);
	$mname=explode('"', $a);


	foreach($b as $bb)
	{


		$c=explode('"', $bb);
		if( array_key_exists($mname[2], $lookup))
			if($c[4]=='bhs' && $c[0]!='unavailable' && substr($lookup["{$mname[2]}"],0,2)!='BK')
			{
				$out.="Machine {$lookup["{$mname[2]}"]} in zone {$c[4]} is {$c[0]} with price of \${$lookup2["{$lookup["{$mname[2]}"]}"]}.00" . PHP_EOL;
				echo "Machine {$lookup["{$mname[2]}"]} in zone {$c[4]} is {$c[0]} with price of \${$lookup2["{$lookup["{$mname[2]}"]}"]}.00" . PHP_EOL;
			}

	}


}
//echo $out;
//you can send yourself an email with content of $out if response is meaningful
?>
