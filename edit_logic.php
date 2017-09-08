<?php
include_once "db.php";
include_once "config.php";

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


session_start();
if(!isset($_SESSION['name']) || empty($_SESSION['name']))
{
	header('Location: login.php');
	exit();
}



echo $_POST['CasPrichodu'];
echo $_POST['DatumVykladky'];
echo $_SESSION['edit'];
echo $_SESSION['date1'];

$_SESSION['CasPrichodu2'] = $_POST['CasPrichodu'];
$_SESSION['DatumVykladky2'] = $_POST['DatumVykladky'];

$time3 = $_POST['CasPrichodu'];
$date2 = validDate($_POST['DatumVykladky']);
//$id = $_SESSION['edit'];
$id = $_GET['id'];

if(!validTime($time3))
{
	$msg->error('Nebol zadaný čas v správnom formáte', null, true);
    header('Location: edit.php?id='.$id);
    exit();
}

if(strtotime($_SESSION['date1']) > strtotime($date2))
{
	$msg->error('Zadaný dátum nieje logicky správne', null, true);
    header('Location: edit.php?id='.$id);
    exit();
}


$sql = "UPDATE data
SET time3=TIME('$time3'), date2=STR_TO_DATE('$date2', '%Y-%m-%d')
WHERE ID='$id'";

if (!mysqli_query($con, $sql)) 
{
    $msg->error('Neboli zadané všetky údaje správne', null, true);
    header('Location: edit.php?id='.$id);
    exit();
    //echo mysqli_connect_error();
}
else
{
	$msg->success('Záznam bol úspešne editovaný do systému', null, true);
	unset($_SESSION['CasPrichodu2']);
    unset($_SESSION['DatumVykladky2']);
	header('Location: undone.php');
    exit();
}

