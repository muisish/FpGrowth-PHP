<?php

$data="";
$count = 5;
for ($a = 1; $a <= $count; $a++)
{
    if($a != $count)
	{
		$data .="$a,";
    }
	else 
	{
		$data .= $a;
	}
}

echo $data;

?>