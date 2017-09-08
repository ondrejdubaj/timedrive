<?php include_once "header.php" ?>

	<header class="container">
		<!--div class="obr">
			<img src="AAEAAQAAAAAAAAN6AAAAJDBlNmM2NzI1LTExOTgtNDRjYi04MmQ4LTA0ZTkzNmE3YWRlOA.png" width="75%" height="75%">
		</div-->

		<div class='row'>
			<div class="dropdown">
			    <button class="btn btn-default" style='float: right; margin-top: 17px; margin-left: 15px' type="button" data-toggle="dropdown">Možnosti
			    <span class="caret"></span></button>
			    <ul class="dropdown-menu dropdown-menu-right">
			      <li><a href='logout.php'>Odhlásiť</a></li>
			      <li><a href='pass_change.php'>Zmeniť heslo</a></li>
			    </ul>
			</div>

			<p class='text-right' style='float: right; margin-top: 22px; font-size: 120%;'>Užívateľ: <strong><?= $_SESSION['name']?></strong></p>
		</div>
		
		<div class='row' style='float: right; margin-top: 17px;'>
			<a href="view.php" class="btn btn-default"> Záznamy </a>
			<a href="add_new.php" class="btn btn-default"> Nový záznam </a>
			<a href='register.php' class='btn btn-default'> Registrácia užívateľa </a>
			<a href='undone.php' class='btn btn-default'> Nedokončené záznamy </a>
		</div>
		<br>
		
	</header>

	<?php
		//session_start();
		if(!isset($_SESSION['name']) || empty($_SESSION['name']))
		{
			header('Location: login.php');
        	exit();
		}


	?>

	<main class="container">
		<div class='row'>
			<h2 style="text-align: center;">Registrácia nového užívateľa</h2>
		</div>
		<form class="formular" method="post" action="register_logic.php">
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group">
				<label for="pwd">Heslo:</label>
				<input type="password" class="form-control" name="pwd">
			</div>
			<div class="form-group">
				<label for="pwd">Potvrďte heslo:</label>
				<input type="password" class="form-control" name="pwd2">
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="" name="veduci">Vedúci</label>
			</div>
			<button type="submit" class="btn btn-default" style="margin-bottom: 25px;">Registrovať</button>
		</form>	
	</main>

<?php include_once "footer.php" ?>