<?php

include_once "db.php";

$file = fopen('input.csv', 'r');
$objects = array();

while (($line = fgetcsv($file)) !== FALSE) 
{
  array_push($objects, $line);	
}

print_r($objects);
fclose($file);

$str = "INSERT INTO cars (kod, SPZ) VALUES ";

foreach ($objects as $car) 
{
	$str .= '('.$car[0].', "'.$car[1].'"), '; 
}

$str = substr($str, 0, -2);

echo $str."\n";

$sql = "TRUNCATE TABLE cars";

if (mysqli_query($con, $sql)) 
{
	echo "uspesne sa vymazali data\n";
} 
else 
{
    echo "nepodarilo sa vymazat data\n";
    exit();	
}

if (mysqli_query($con, $str)) 
{
	echo "uspesne sa vlozili data\n";
} 
else 
{
    echo "nepodarilo sa vlozit data\n";	
}

