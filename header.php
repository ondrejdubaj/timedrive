
<!DOCTYPE html>
<html>
	<head>
		<title>INCAR s.r.o</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="select2.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<!--link rel="stylesheet" href="jquery.timepicker.css"-->
		<link rel="stylesheet" href="main.css">

		<script src="bootstrap-select.js"></script>

		<!--script type="text/javascript">
			// Setting default configuration here or you can set through configuration object as seen below
			$.fn.select2.defaults = $.extend($.fn.select2.defaults, {
			    allowClear: true, // Adds X image to clear select
			    closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
			    placeholder: 'Select...',
			    minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
			});

			$(document).ready(

			function () {

			    // Single select example if using params obj or configuration seen above
			    var configParamsObj = {
			        placeholder: 'Select an option...', // Place holder text to place in the select
			        minimumResultsForSearch: 3 // Overrides default of 15 set above
			    };
			    $("#singleSelectExample").select2(configParamsObj);
			});

		</script-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

		<!--script src="jquery.timepicker.min.js"></script-->
		<script>
			var isIE = /*@cc_on!@*/false || !!document.documentMode;
			var isFirefox = typeof InstallTrigger !== 'undefined';

			if((isFirefox) ||(isIE))
			{	
			    $(function(){
			         // Find any date inputs and override their functionality
			         $('input[type="date"]').datepicker();
			    });
			}
		</script>

		<!--script>
			var isIE = /*@cc_on!@*/false || !!document.documentMode;
			var isFirefox = typeof InstallTrigger !== 'undefined';

			if((isFirefox) ||(isIE))
			{	
			    $(function(){
			         // Find any date inputs and override their functionality
			         $('input[type="time"]').timepicker(appendTo);
			    });
			}
		</script-->

		<?php include_once "config.php" ?>

	</head>

	<body>




