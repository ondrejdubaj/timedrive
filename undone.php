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

	<script type="text/javascript">
	
	 		var $table = $('#table');
		     $table.bootstrapTable({
			      url: 'view.php',
			      search: true,
			      pagination: true,
			      buttonsClass: 'primary',
			      showFooter: true,
			      minimumCountColumns: 11,
			      columns: [{
			          field: 'num',
			          title: '#',
			          sortable: true,
			      },{
			          field: 'meno',
			          title: 'firstname',
			          sortable: true,
			      },{
			          field: 'priezvisko',
			          title: 'lastname',
			          sortable: true,
			          
			      },{
			          field: 'kod',
			          title: 'carcode',
			          sortable: true,
			          
			      },{
			          field: 'SPZ',
			          title: 'SPZ',
			          sortable: true,
			          
			      },{
			          field: 'cas1',
			          title: 'cas1',
			          sortable: true,
			          
			      },{
			          field: 'cas2',
			          title: 'cas2',
			          sortable: true,
			          
			      },{
			          field: 'cas3',
			          title: 'cas3',
			          sortable: true,
			          
			      },{
			          field: 'datum1',
			          title: 'datum1',
			          sortable: true,
			          
			      },{
			          field: 'datum2',
			          title: 'datum2',
			          sortable: true,
			          
			      },{
			          field: 'depo',
			          title: 'depo',
			          sortable: true,
			          
			      },{
			          field: 'partner',
			          title: 'partner',
			          sortable: true,
			          
			      }, ],
 
  			 });
		 
		</script>

		<?php 

			include_once "db.php";

			//session_start();
			if(!isset($_SESSION['name']) || empty($_SESSION['name']))
			{
				header('Location: login.php');
            	exit();
			}

			$sql = "SELECT * FROM data WHERE (time3 IS NULL OR date2 IS NULL)";

			if(isset($_POST['hladaj']) && ($_POST['mesto'] != "-- Vyber depo --"))
			{

				$mesto = $_POST['mesto'];
				//echo $mesto;

				$sql = $sql." AND depo='$mesto'";
			}

			if(isset($_POST['zobraz']))
			{
				unset($_POST['mesto']);

			}

			$sql = $sql." ORDER BY date1 DESC";

			$_SESSION['sql'] = $sql;
	 		
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
	 		
			$i=1;
	 		while ($rowList = mysqli_fetch_array($sqltran)) 
	 		{

	 			//print_r($rowList);
	 								 
				$name = array(
						'num' => $i,
							'id'=> $rowList['ID'],
 		 	 				'meno'=> $rowList['name'],
		 	 				'priezvisko'=> $rowList['surname'],
		 	 				'kod'=> $rowList['car_code'],
		 	 				'SPZ'=> $rowList['SPZ'], 
		 	 				'cas1'=> $rowList['time1'],
		 	 				'cas2'=> $rowList['time2'],
		 	 				'cas3'=> $rowList['time3'],
		 	 				'datum1'=> $rowList['date1'],
		 	 				'datum2'=> $rowList['date2'],
		 	 				'depo'=> $rowList['depo'],
		 	 				'partner'=> $rowList['partner']
 		 	 			);		

				//print_r($name);


					array_push($arrVal, $name);	
				$i++;			
		 	}

		 	mysqli_close($con);
	?>

		

		 
		 
				<div class="panel panel-primary" style="margin:20px;">
					<div class="panel-heading "> 
						<h3 class="panel-title">Záznamy</h3>
					 	
					</div>
								 
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 table-responsive">

							<form method="post">
						      	<div class="form-group col-md-6 col-sm-6 ">
									<label for="depo">Depo</label>
							   		<select id="singleSelectExample" class="form-control input-sm" name="mesto">

										<option>-- Vyber depo --</option>
										<option value="Nitra" <?= isset($_POST['mesto']) ? ($_POST['mesto'] == "Nitra" ? "selected" : "") : "" ?> >Nitra</option>
										<option value="Zilina" <?= isset($_POST['mesto']) ? ($_POST['mesto'] == "Zilina" ? "selected" : "") : "" ?> >Žilina</option>
										<option value="Krupina" <?= isset($_POST['mesto']) ? ($_POST['mesto'] == "Krupina" ? "selected" : "") : "" ?> >Krupina</option>
										<option value="Presov" <?= isset($_POST['mesto']) ? ($_POST['mesto'] == "Presov" ? "selected" : "") : "" ?> >Prešov</option>

								    </select>
								</div>
						      	<br>
						      	<div class="form-group col-md-6 col-sm-6" style="margin-left: 0.1%;"> <!-- Submit button -->
						        	<button class="btn btn-primary " name="hladaj" type="submit">Hľadaj</button>
						        	<button class="btn btn-default" name="zobraz" style="margin-left: 1.5%;" type="submit">Zobraz všetko</button>
						      	</div>
						    </form>

								<table 	id="table"
					                	data-show-columns="true"
		 				                data-height="460"
		 				                class="table table-striped">


		 				                <thead>

		 				                <div class="col-md-6 col-sm-6">	
										    <tr>
										      <th>#</th>
										      <th>Meno</th>
										      <th>Priezvisko</th>
										      <th>Kód auta</th>
										      <th>ŠPZ</th>
										      <th>Dátum nakládky</th>
										      <th>Čas pristavenia k rampe</th>
										      <th>Čas odchodu z nakládky</th>
										      <th>Dátum vykládky</th>
										      <th>Čas príchodu tovaru na depo</th>
										      <th>Depo</th>
										      <th>Partner</th>
										     
										     
										    </tr>

										</div>
										</thead>

										<tbody>

										  	<?php foreach ($arrVal as $item) : ?>
										  	
										  	<div class="col-md-6 col-sm-6">	
										  	<tr>
										      <th scope="row"><?= $item['num'] ?></th>
										      <td><?= $item['meno'] ?></td>
										      <td><?= $item['priezvisko'] ?></td>
										      <td><?= $item['kod'] ?></td>
										      <td><?= $item['SPZ'] ?></td>
										      <td><?= $item['datum1'] ?></td>
										      <td><?= $item['cas1'] ?></td>
										      <td><?= $item['cas2'] ?></td>
										      <td><?= $item['datum2'] ?></td>
										      <td><?= $item['cas3'] ?></td>
										      <td><?= $item['depo'] ?></td>
										      <td><?= $item['partner'] ?></td>
										      <td>
										      	<form action='edit.php?id=<?= $item['id'] ?>' method="post">
										      		<button class="btn-link" name="edit" value=<?= $item['id'] ?> type="submit">editovať</button>
										      	</form>
										      </td>
										    
										    </tr>
										    </div>

										  	<?php endforeach ?>
										    
										</tbody>
								</table>
								
							</div>
						</div>
					</div>				
				</div>
  
		
	</main>


<?php include_once "footer.php" ?>