<?php
		include_once "db.php";
        include_once "config.php";
        
        if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pwd']) && !empty($_POST['pwd']))
		{

			$user = ($_POST['email']);
            $pass = md5($_POST['pwd']);

            $sql = "SELECT * FROM employees WHERE name='".$user."' AND pass='".$pass."'";

            $search = mysqli_query($con, $sql);
            if(!$search)
            {
                echo mysqli_error($con);
            }

            $match  = mysqli_num_rows($search);
            $rowList = mysqli_fetch_array($search);
            if($match > 0)
            {
                session_start();
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['view'] = $rowList['view_list'];
                $msg->success('Boli ste úspešne prihlásený', null, true);
                header('Location: add_new.php');
                exit();
            }
            else
            {
                $msg->error('Zadaný nesprávny e-mail alebo heslo', null, true);
                header('Location: login.php');
                exit();
            }
        }
        else
        {
        	$msg->warning('Nebol zadaný e-mail alebo heslo', null, true);
            header('Location: login.php');
            exit();
        }
	?>