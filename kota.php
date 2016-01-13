<?php

$tanya_ = "jakarta & depok";
$tanya = explode("&" , $tanya_);
// ngilangin sepasi
for($i = 0; $i < count($tanya); $i++) 
    $tanya[$i] = trim($tanya[$i]);

$kota = array("jakarta","depok","bogor","bekasi,");
$d;
foreach($kota as $a => $b){
	foreach($tanya as $t)
    if($t == $b) $d[] = $a;
}

$kondisi = in_array(1,$d) && in_array(3,$d) && in_array(0,$d) ? "A" : (in_array(0,$d) && in_array(1,$d) ? "B" : 0);
echo "\n\n\tKota $tanya_ : $kondisi\n\n";
echo count($kondisi);