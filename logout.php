<?php
		include_once "db.php";
        include_once "config.php";

        
        $msg->success('Boli ste úspešne odhlásený', null, true);

        header('Location: login.php');
        exit();

?>