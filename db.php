<?php

$host='localhost';
$dbuser='root';
$dbpw='';
$dbname='bettia';
$link=mysqli_connect($host,$dbuser,$dbpw,$dbname);

if($link)
{
	mysqli_query($link,"SET NAMES utf8");
	//echo "correct";
}
else
{
	echo "wrong";
    mysqli_connect_error();
}

?>



