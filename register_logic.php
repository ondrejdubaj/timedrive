<?php
		include_once "db.php";
        include_once "config.php";


        if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pwd']) && !empty($_POST['pwd']) AND isset($_POST['pwd2']) && !empty($_POST['pwd2']))
		{
			if($_POST['pwd'] != $_POST['pwd2'])
			{
				$msg->warning('Zadané heslá sa nezhodujú', null, true);
	            header('Location: register.php');
	            exit();
			}

			$user = ($_POST['email']);
            $pass = md5($_POST['pwd']);
            $veduci = 5;

            if(isset($_POST['veduci']))
            	$veduci = 1;
            else
            	$veduci = 0;

            $sql = "SELECT * FROM employees WHERE name='$user'";

            $search = mysqli_query($con, $sql);
            if(!$search)
            {
                echo mysqli_error($con);
            }

            $match  = mysqli_num_rows($search);
            if($match > 0)
            {
            	$msg->warning('Užívateľ s týmto e-mailom je už registrovaný', null, true);
	            header('Location: register.php');
	            exit();
            }

            $sql = "INSERT INTO employees (name, pass, view_list)
					VALUES ('$user', '$pass', '$veduci')";

			if (mysqli_query($con, $sql)) {
			    $msg->success('Nový pracovník bol úspešne vložený do systému', null, true);
			    header('Location: register.php');
	            exit();
			} else {
			    echo "je tu chyba: ".mysqli_error($con);	
			}


		}
		else
		{
			$msg->error('Nezadali ste všetky potrebné údaje', null, true);
            header('Location: register.php');
            exit();
		}

?>