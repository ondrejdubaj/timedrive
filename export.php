<?php

	include_once "db.php";
	include_once "config.php";

	session_start();

	$sql = $_SESSION['sql'];
	//echo $sql;

	//if(isset($_POST['export']))
	//{

	$result = mysqli_query($con, $sql);

	$arrVal = array();

	while ($rowList = mysqli_fetch_array($result)) 
	{
							 
		$name = array(
 	 				'meno'=> $rowList['name'],
	 				'priezvisko'=> $rowList['surname'],
	 				'kod'=> $rowList['car_code'],
	 				'SPZ'=> $rowList['SPZ'], 
	 				'cas1'=> $rowList['time1'],
	 				'cas2'=> $rowList['time2'],
	 				'cas3'=> $rowList['time3'],
	 				'datum1'=> $rowList['date1'],
	 				'datum2'=> $rowList['date2'],
	 				'depo'=> $rowList['depo'],
	 				'partner'=> $rowList['partner']
 	 			);		

	//print_r($name);


		array_push($arrVal, $name);	
			
 	}

 	mysqli_close($con);

 	$_SESSION['exp'] = $arrVal;

 	header('Location: excel.php');
    exit();
	

?>