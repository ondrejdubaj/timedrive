<?php
	include_once "db.php";
    include_once "config.php";

    if(isset($_POST['pwd']) && !empty($_POST['pwd']) AND isset($_POST['pwd2']) && !empty($_POST['pwd2']))
    {
    	if($_POST['pwd'] != $_POST['pwd2'])
		{
			$msg->warning('Zadané heslá sa nezhodujú', null, true);
            header('Location: pass_change.php');
            exit();
		}

		$user = ($_SESSION['name']);
        $pass = md5($_POST['pwd']);

        $sql = "UPDATE employees
        		SET pass='$pass'
        		WHERE name='$user'";

		if (mysqli_query($con, $sql)) {
		    $msg->success('Heslo bolo úspešne zmenené', null, true);
		    header('Location: add_new.php');
            exit();
		} else {
		    echo "je tu chyba: ".mysqli_error($con);	
		}


    }
    else
	{
		$msg->error('Nezadali ste všetky potrebné údaje', null, true);
        header('Location: pass_change.php');
        exit();
	}