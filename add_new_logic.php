<?php 
	include_once "db.php";
    include_once "config.php";
    include_once "functions.php";

    function validTime($str)
    {
    	if((strlen($str) == 5) && ($str[2] == ":"))
    	{
    		return true;
    	}

    	return false;
    }

    function validDate($str)
    {
    	if(strlen($str) <= 6)
    	{
    		return $str;
    	}
    	
    	if($str[2] == "/" && $str[5] == "/")
    	{
    		$tmp = $str[6].$str[7].$str[8].$str[9]."-".$str[0].$str[1]."-".$str[3].$str[4];
    		return $tmp;
    	}
    	
    	return $str;
    }

			
 	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$car_code = $_POST["car"];
	$SPZ = $_POST["SPZ"];
	$time1 = $_POST["CasPristavenia"];
	$time2 = $_POST["CasOdchodu"];
	$time3 = $_POST["CasPrichodu"];
	$date1 = validDate($_POST["DatumNakladky"]);
	$date2 = validDate($_POST["DatumVykladky"]);
	if(isset($_POST["depo"]))
	{
		$depo = $_POST["depo"];
	}
	print_r($depo);
	$partner = $_POST["partner"];

	//session_start();

	$_SESSION['name1'] = $_POST['name'];
	$_SESSION['surname1'] = $_POST['surname'];
	$_SESSION['car1'] = $_POST['car'];
	$_SESSION['SPZ1'] = $_POST['SPZ'];
	$_SESSION['CasPristavenia1'] = $_POST['CasPristavenia'];
	$_SESSION['CasOdchodu1'] = $_POST['CasOdchodu'];
	$_SESSION['CasPrichodu1'] = $_POST['CasPrichodu'];
	$_SESSION['DatumNakladky1'] = $_POST['DatumNakladky'];
	$_SESSION['DatumVykladky1'] = $_POST['DatumVykladky'];
	$_SESSION['depo1'] = $_POST['depo'];
	$_SESSION['partner1'] = $_POST['partner'];

	echo $name."\n";
	echo $surname."\n";
	echo $car_code."\n";
	echo $SPZ."\n";
	echo $time1."\n";
	echo $time2."\n";
	echo $time3."\n";
	echo $date1."\n";
	echo $date2."\n";
	//echo $depo."\n";
	echo $partner."\n";

	if(count($depo) == 0)
	{
		$msg->error('Neboli zadané všetky údaje správne', null, true);
        header('Location: add_new.php');
        exit();
	}

	if(!validTime($time1) || !validTime($time2))
	{
		$msg->error('Nebol zadaný čas v správnom formáte', null, true);
        header('Location: add_new.php');
        exit();
	}

	if(!empty($time3))
	{
		if(!validTime($time3))
		{
			$msg->error('Nebol zadaný čas v správnom formáte', null, true);
	        header('Location: add_new.php');
	        exit();

		}
	}

	if(!empty($date2))
	{
		if(strtotime($date1) > strtotime($date2))
		{
			$msg->error('Zadané dátumy niesu logicky správne', null, true);
		    header('Location: add_new.php');
		    exit();
		}
	}

	if(strtotime($time1) >= strtotime($time2))
	{
		$msg->error('Zadané časy niesu logicky správne usporiadané', null, true);
	    header('Location: add_new.php');
	    exit();
	}

	for($i = 0; $i < count($depo); $i++)
	{
		$sql = "";

		if(!empty($time3) && !empty($date2))
		{
			$sql = "INSERT INTO data (name, surname, car_code, SPZ, time1, time2, time3, date1, date2, depo, partner)
			VALUES ('$name', '$surname', '$car_code', '$SPZ', TIME('$time1'), TIME('$time2'), TIME('$time3'), STR_TO_DATE('$date1', '%Y-%m-%d'), STR_TO_DATE('$date2', '%Y-%m-%d'), '".$depo[$i]."', '$partner')";
		}
		else if(empty($time3) && empty($date2))
		{
			$sql = "INSERT INTO data (name, surname, car_code, SPZ, time1, time2, date1, depo, partner)
			VALUES ('$name', '$surname', '$car_code', '$SPZ', TIME('$time1'), TIME('$time2'), STR_TO_DATE('$date1', '%Y-%m-%d'),'".$depo[$i]."', '$partner')";	
		}
		/*else if(empty($time3) && !empty($date2))
		{
			$sql = "INSERT INTO data (name, surname, car_code, SPZ, time1, time2, date1, date2, depo, partner)
			VALUES ('$name', '$surname', '$car_code', '$SPZ', TIME('$time1'), TIME('$time2'), STR_TO_DATE('$date1', '%Y-%m-%d'), STR_TO_DATE('$date2', '%Y-%m-%d'), '".$depo[$i]."', '$partner')";	
		}*/

		if($sql == "")
		{
			$msg->error('Neboli zadané všetky údaje správne', null, true);
            header('Location: add_new.php');
            exit();
		}

		if (!mysqli_query($con, $sql)) 
		{
            $msg->error('Neboli zadané všetky údaje správne', null, true);
            header('Location: add_new.php');
            exit();
            //echo mysqli_connect_error();
		}
		else 
		{
			if ($i == (count($depo)-1))
			{
				$msg->success('Nový záznam bol úspešne vložený do systému', null, true);
				unsetSession1();
				header('Location: add_new.php');
			    exit();
			}
		}

	}

	$msg->error('Neboli zadané všetky údaje správne', null, true);
    header('Location: add_new.php');
    exit();



 	mysqli_close($con);
	?>