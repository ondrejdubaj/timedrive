<?php

include_once "db.php";

$sql = "SELECT SPZ FROM cars WHERE kod=".$_POST['car_code'];

$car = array();
$tran = mysqli_query($con, $sql);
	 		
while ($row = mysqli_fetch_array($tran)) 
{
	array_push($car, $row['SPZ']);			
}

foreach ($car as $item) 
{
	echo '<option>'.$item.'</option>';
}