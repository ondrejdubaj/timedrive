<?php 
	include_once "header.php";
	include_once "db.php";

	if(!isset($_SESSION['name']) || empty($_SESSION['name']))
	{
		header('Location: login.php');
    	exit();
	}
?>
	<header class="container">

		<div class='row' style='float: left; margin-top: 17px;'>
			<a href='add_new.php' class='btn btn-default'> Späť </a>
		</div>
		
	</header>

	<main class="container">
		<div class='row'>
			<h2 style="text-align: center;">Zmena hesla užívateľa</h2>
		</div>
		<form class="formular" method="post" action="pass_change_logic.php">
			<div class="form-group">
	            <p><strong>Email: </strong><?= $_SESSION['name']?></p>
	        </div>
			<div class="form-group">
				<label for="pwd">Nové Heslo:</label>
				<input type="password" class="form-control" name="pwd">
			</div>
			<div class="form-group">
				<label for="pwd">Potvrďte nové heslo:</label>
				<input type="password" class="form-control" name="pwd2">
			</div>
			<button type="submit" class="btn btn-default" style="margin-bottom: 25px;">Zmeniť</button>
		</form>	
	</main>


<?php include_once "footer.php" ?>



