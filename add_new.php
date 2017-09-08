
<?php 
	include_once "header.php";

	function isSetSession($item)
	{
		if(isset($item))
		{
			return $item;
		}
		else
		{
			return "";
		}
	}
 ?>

	<?php 

			include_once "db.php";

			//session_start();
			if(!isset($_SESSION['name']) || empty($_SESSION['name']))
			{
				header('Location: login.php');
            	exit();
			}

			//echo "prihlaseny je uzivatel: ".$_SESSION['name'];

			$car_codes = array();

			$sql1 = "SELECT kod FROM cars GROUP BY kod";
		 		
	 		$tran = mysqli_query($con, $sql1);
	 		
	 		while ($row = mysqli_fetch_array($tran)) 
	 		{
				array_push($car_codes, intval($row['kod']));			
		 	}

			$arrCars = array();

			foreach ($car_codes as $code) 
			{

				$sql = "SELECT SPZ FROM cars WHERE kod = '$code'";
		 		
		 		$sqltran = mysqli_query($con, $sql);
				$arrVal = array();
		 		
		 		while ($rowList = mysqli_fetch_array($sqltran)) 
		 		{
						array_push($arrVal, $rowList['SPZ']);			
			 	}
			 		 
			 	array_push($arrCars, $arrVal);
			}

	?>

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

		<?php

			//session_start();
			if($_SESSION['view'] == 1)
			{
				echo "<div class='row' style='float: right; margin-top: 17px;'>
					<a href='view.php' class='btn btn-default'> Záznamy </a>
					<a href='add_new.php' class='btn btn-default'> Nový záznam </a>
					<a href='register.php' class='btn btn-default'> Registrácia užívateľa </a>
					<a href='undone.php' class='btn btn-default'> Nedokončené záznamy </a>
				</div>";
			}
			else
			{
				echo "<div class='row' style='float: right; margin-top: 17px;'>
					<a href='add_new.php' class='btn btn-default'> Nový záznam </a>
					<a href='undone.php' class='btn btn-default'> Nedokončené záznamy </a>
				</div>";
			}

		?>
		
		
		
	</header>

	<main class="container">
		<div class="panel panel-primary" style="margin:20px;">
			<div class="panel-heading">
		        	<h3 class="panel-title">Registrácia záznamu</h3>
			</div>

			<div class="panel-body">
			    <form method="post" action="add_new_logic.php">
					<div class="col-md-12 col-sm-12">
						<div class="form-group col-md-6 col-sm-6">
				            <label for="name">Meno<span style="color: red;">*</span></label>
				            <input type="text" class="form-control input-sm" value="<?= isset($_SESSION['name1']) ? $_SESSION['name1'] : "" ?>" name="name" placeholder="Meno">
				        </div>

				        <div class="form-group col-md-6 col-sm-6">
				            <label for="surname">Priezvisko<span style="color: red;">*</span></label>
				            <input type="text" class="form-control input-sm" value="<?= isset($_SESSION['surname1']) ? $_SESSION['surname1'] : "" ?>" name="surname" placeholder="Priezvisko">
				        </div>

				        <div class = "form-group col-md-6 col-sm-6">
					      	<label for="years">Kód auta<span style="color: red;">*</span></label>	 
				     
					      	<select class="form-control input-sm" id="car" name="car">

								<option>-- Vyber kód auta --</option>
								
								<?php foreach ($car_codes as $num) : ?>

							    	<option <?= (isset($_SESSION['car1']) ? (($_SESSION['car1']) == $num ? "selected" : "") : "")?> ><?= $num ?></option>
								<?php endforeach ?>

					      	</select>
						</div>

						<div class="form-group col-md-6 col-sm-6 ">
							<label for="SPZ">ŠPZ<span style="color: red;">*</span></label>
					   		<select class="form-control input-sm" name="SPZ" id="SPZ">

							    <?php 
							    	if(isset($_SESSION['SPZ1']))
					      			{
					      				echo "<option>".$_SESSION['SPZ1']."</option>";
					      			}
					      			else
					      			{
										echo "<option>-- Vyber ŠPZ auta --</option>";
									}
								?>

								<script>
									$( document ).ready(function() {
									    $('#car').change(function(){
									    	//if($('#car option:selected').each(function(){
										        $.ajax({
										            type: "POST",
										            url: "ajax.php",
										            data: { car_code: $(this).val() },
										            dataType: "html"
										        })
										        .done(function( msg ) {
										            $('#SPZ').html(msg);
										        });
									    	//}));
									    });
									});
								</script>



						    </select>
						</div>

				        <div class="form-group col-md-6 col-sm-6">
		                    <label for="DatumNakladky">Dátum Nakládky<span style="color: red;">*</span></label>
		                    <input type="date" name="DatumNakladky" value="<?= isset($_SESSION['DatumNakladky1']) ? $_SESSION['DatumNakladky1'] : "" ?>" class="form-control input-sm"></input>
                		</div>
					
						<div class="form-group col-md-6 col-sm-6" id='datetimepicker3'>
				            <label for="CasPristavenia">Čas pristavenia k rampe<span style="color: red;">*</span></label>
				            <!--span class="help-block">Čas zadaj vo formáte HH:MM, (napr. 23:59, 23:01, 02:58, 06:05, ...)</span-->
				            <input type="time" class="form-control input-sm" value="<?= isset($_SESSION['CasPristavenia1']) ? $_SESSION['CasPristavenia1'] : "" ?>" name="CasPristavenia" placeholder="HH:MM"></input>
				        </div>


				        <div class="form-group col-md-6 col-sm-6" id='datetimepicker3'>
				            <label for="CasOdchodu">Čas odchodu z nakládky<span style="color: red;">*</span></label>
				            <!--span class="help-block">Čas zadaj vo formate HH:MM, (napr. 23:59, 23:01, 02:58, 06:05, ...)</span-->
				            <input type="time" class="form-control input-sm" value="<?= isset($_SESSION['CasOdchodu1']) ? $_SESSION['CasOdchodu1'] : "" ?>" name="CasOdchodu" placeholder="HH:MM"></input>
				        </div>





						<?php 

								//include_once "db.php";

								$sql = "SELECT name FROM partners";
						 		
						 		$sqltran = mysqli_query($con, $sql);
						 		/*if($sqltran)
						 		{
						 			echo "Vsetko naporiadku";
						 		}
						 		else
						 		{
						 			echo mysqli_error($con);
						 		}*/
								$arrVal = array();

								//print_r($sqltran);
						 		
						 		while ($rowList = mysqli_fetch_array($sqltran)) 
						 		{
										array_push($arrVal, $rowList['name']);			
							 	}
							 		 //echo  json_encode($arrVal);
							 		 //
							 	?>

						<div class = "form-group col-md-6 col-sm-6">
					      	<label for="years">Partner<span style="color: red;">*</span></label>	 
				     
					      	<select class="form-control input-sm" name="partner">

								<option>-- Vyber zo zoznamu partnerov --</option>

								<?php foreach ($arrVal as $item) : ?>
									
									<option <?= (isset($_SESSION['partner1']) ? (($_SESSION['partner1']) == $item ? "selected" : "") : "") ?> ><?= $item ?></option>

								<?php endforeach ?>

					      	</select>
						</div>
						
                		<div class = "form-group col-md-6 col-sm-6">
					      	<label for="years">Sklad/Depo<span style="color: red;">*</span></label><br>	 
				     
					      	<label class="checkbox-inline">
					      		<input type="checkbox" name="depo[]" value="Nitra" autocomplete="off" class="form-checkbox" <?= (isset($_SESSION['depo1']) ? (in_array("Nitra", $_SESSION['depo1']) ? "checked" : "") : "") ?> >Nitra</input>
					      	</label>
					      	<label class="checkbox-inline">
					      		<input type="checkbox" name="depo[]" value="Zilina" autocomplete="off" class="form-checkbox" <?= (isset($_SESSION['depo1']) ? (in_array("Zilina", $_SESSION['depo1']) ? "checked" : "") : "") ?> >Žilina</input>
					      	</label>
					      	<label class="checkbox-inline">
					      		<input type="checkbox" name="depo[]" value="Krupina" autocomplete="off" class="form-checkbox" <?= (isset($_SESSION['depo1']) ? (in_array("Krupina", $_SESSION['depo1']) ? "checked" : "") : "") ?> >Krupina</input>
					      	</label>
					      	<label class="checkbox-inline">
					      		<input type="checkbox" name="depo[]" value="Presov" autocomplete="off" class="form-checkbox" <?= (isset($_SESSION['depo1']) ? (in_array("Presov", $_SESSION['depo1']) ? "checked" : "") : "") ?> >Prešov</input>
					      	</label>
						</div>
                		<div class="form-group col-md-6 col-sm-6" >
		                    <label for="DatumVykladky">Dátum Vykládky</label>
		                    <input type="date" name="DatumVykladky" value="<?= isset($_SESSION['DatumVykladky1']) ? $_SESSION['DatumVykladky1'] : "" ?>" class="form-control input-sm"></input>
                		</div>

				        <div class="form-group col-md-6 col-sm-6" id='datetimepicker3'>
				            <label for="CasPrichodu">Čas príchodu tovaru do depa</label>
				        	<!--span class="help-block">Čas zadaj vo formate HH:MM, (napr. 23:59, 23:01, 02:58, 06:05, ...)</span-->
				            <input id="timepicker" type="time" class="form-control input-sm" value="<?= isset($_SESSION['CasPrichodu1']) ? $_SESSION['CasPrichodu1'] : "" ?>" name="CasPrichodu" placeholder="HH:MM"></input>
				        </div>
					</div>

					<div>
						<span class="help-block" style="color: red; margin-left: 2.5%;">Polia označené * sú povinné</span>
					</div>
					<div>
						<span class="help-block" style=" margin-left: 2.5%;">Čas zadaj vo formate HH:MM, (napr. 23:59, 23:01, 02:58, 06:05, ...)</span>
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
	include_once "functions.php";
	unsetSession1();
 ?>

