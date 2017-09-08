
<?php 
	include_once "header.php"
 ?>

	<?php 

			include_once "db.php";

			//session_start();
			if(!isset($_SESSION['name']) || empty($_SESSION['name']))
			{
				header('Location: login.php');
            	exit();
			}

			/*$edit = $_POST['edit'];
			$_SESSION['edit'] = $edit;*/

			$id = $_GET['id'];

			$sql = "SELECT * FROM data WHERE ID='$id'";

			$sqltran = mysqli_query($con, $sql);
			$rowList = mysqli_fetch_array($sqltran);

			$_SESSION['date1'] = $rowList['date1'];
			

	?>

	<header class="container">
		<!--div class="obr">
			<img src="AAEAAQAAAAAAAAN6AAAAJDBlNmM2NzI1LTExOTgtNDRjYi04MmQ4LTA0ZTkzNmE3YWRlOA.png" width="75%" height="75%">
		</div-->

		<div class='row' style='float: left; margin-top: 17px;'>
			<a href='undone.php' class='btn btn-default'> Späť </a>
		</div>

		<?php

			//session_start();
			echo "<p class='text-right' style='font-size: 120%;'>Užívateľ: <strong>".$_SESSION['name']."</strong></p>";

		?>
		
		
	</header>

	<main>
		<div class="panel panel-primary" style="margin:20px;">
			<div class="panel-heading">
		        	<h3 class="panel-title">Editácia záznamu</h3>
			</div>

			<div class="panel-body">
			    <form method="post" action='edit_logic.php?id=<?= $id ?>'>
					<div class="col-md-12 col-sm-12">
						<div class="form-group col-md-6 col-sm-6">
				            <p><strong>Meno: </strong><em><?=$rowList['name'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Priezvisko: </strong><em><?=$rowList['surname'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Kód auta: </strong><em><?=$rowList['car_code'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>ŠPZ: </strong><em><?=$rowList['SPZ'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Dátum nakládky: </strong><em><?=$rowList['date1'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Čas pristavenia k rampe: </strong><em><?=$rowList['time1'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Čas odchodu z nakládky: </strong><em><?=$rowList['time2'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Depo: </strong><em><?=$rowList['depo'] ?></em></p>
				        </div>
				        <div class="form-group col-md-6 col-sm-6">
				            <p><strong>Partner: </strong><em><?=$rowList['partner'] ?></em></p>
				        </div>

				        <?php
				        	/*if(isset($rowList['date2']))
				        	{
				        		echo '<div class="form-group col-md-6 col-sm-6">
							            <p><strong>Dátum Vykládky: </strong><em>'.$rowList["date2"] .'</em></p>
							        </div>';
				        	}
				        	else
				        	{
				        		echo '<div class="form-group col-md-6 col-sm-6">
					                    <label for="DatumVykladky">Dátum Vykládky</label>
					                    <input type="date" name="DatumVykladky" value='.(isset($_SESSION["DatumVykladky2"]) ? $_SESSION["DatumVykladky2"] : "").' class="form-control input-sm"></input>
			                		</div>';
				        	}*/

				        ?>

				        <div class="form-group col-md-6 col-sm-6">
		                    <label for="DatumVykladky">Dátum Vykládky</label>
		                    <input type="date" name="DatumVykladky" value= '<?=(isset($_SESSION["DatumVykladky2"]) ? $_SESSION["DatumVykladky2"] : "")?>' class="form-control input-sm"></input>
                		</div>

				        <div class="form-group col-md-6 col-sm-6">
				            <label for="CasPrichodu">Čas príchodu tovaru do depa</label>
				        	<span class="help-block">Čas zadaj vo formate HH:MM, (napr. 23:59, 23:01, 02:58, 06:05, ...)</span>
				            <input type="time" class="form-control input-sm" value="<?= isset($_SESSION['CasPrichodu2']) ? $_SESSION['CasPrichodu2'] : "" ?>" name="CasPrichodu" placeholder="HH:MM"></input>
				        </div>


                		
					</div>

					<div class="col-md-12 col-sm-12">
						<div class="form-group col-md-3 col-sm-3 pull-right" >
							<input type="submit" class="btn btn-primary" value="Ulož" name="submit"/>
						</div>
					</div>
				</form>
			</div>
		</div>

	</main>

<?php include_once "footer.php";
	unset($_SESSION['CasPrichodu2']);
	unset($_SESSION['DatumVykladky2']);
 ?>

