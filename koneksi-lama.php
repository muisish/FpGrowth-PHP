<?php
 $host="localhost";
  $username="root";
   $password="";
    $database="sparepart";
	$connect=mysql_connect($host,$username,$password);
	mysql_select_db($database,$connect);
	?>