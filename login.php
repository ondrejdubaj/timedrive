<?php 
	include_once "header.php";
	session_destroy();
 ?>

	<header class="container">
		<!--div class="obr">
			<img src="AAEAAQAAAAAAAAN6AAAAJDBlNmM2NzI1LTExOTgtNDRjYi04MmQ4LTA0ZTkzNmE3YWRlOA.png" width="75%" height="75%">
		</div-->

		<h1 style="text-align: center;">Prihlásenie užívateľa</h1>
		
	</header>

	<main>
		<form class="formular" method="post" action="login_logic.php">
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group">
				<label for="pwd">Heslo:</label>
				<input type="password" class="form-control" name="pwd">
				</div>
			<button type="submit" class="btn btn-default">Prihlásiť</button>
		</form>	
	</main>

<?php include_once "footer.php" ?>