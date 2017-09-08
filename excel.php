<?php

 	function xlsBOF() {
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
	}

	function xlsEOF() {
		echo pack("ss", 0x0A, 0x00);
	}

	function xlsWriteNumber($Row, $Col, $Value) {
		echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
		echo pack("d", $Value);
	}

	function xlsWriteLabel($Row, $Col, $Value) {
		$L = strlen($Value);
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
		echo $Value;
	} 

	session_start();
	$arrVal = $_SESSION['exp'];

	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment; filename=\"export_".date("Y-m-d").".xls\"");
	header("Content-Transfer-Encoding: binary");
	header("Pragma: no-cache");
	header("Expires: 0");

	xlsBOF();	

	xlsWriteLabel(0, 0, "Meno");
	xlsWriteLabel(0, 1, "Priezvisko");
	xlsWriteLabel(0, 2, "Kod auta");
	xlsWriteLabel(0, 3, "SPZ");
	xlsWriteLabel(0, 4, "Cas pristavenia k rampe");
	xlsWriteLabel(0, 5, "Cas odchodu z nakladky");
	xlsWriteLabel(0, 6, "Cas prichodu tovaru na depo");
	xlsWriteLabel(0, 7, "Datum nakladky");
	xlsWriteLabel(0, 8, "Datum vykladky");
	xlsWriteLabel(0, 9, "Depo");
	xlsWriteLabel(0, 10, "Partner");

 	$i = 1;
 	foreach ($arrVal as $item) 
 	{
 		xlsWriteLabel($i, 0, $item['meno']);
		xlsWriteLabel($i, 1, $item['priezvisko']);
		xlsWriteLabel($i, 2, $item['kod']);
		xlsWriteLabel($i, 3, $item['SPZ']);
		xlsWriteLabel($i, 4, $item['cas1']);
		xlsWriteLabel($i, 5, $item['cas2']);
		xlsWriteLabel($i, 6, $item['cas3']);
		xlsWriteLabel($i, 7, $item['datum1']);
		xlsWriteLabel($i, 8, $item['datum2']);
		xlsWriteLabel($i, 9, $item['depo']);
		xlsWriteLabel($i, 10, $item['partner']);

		$i++;
 	}

 	xlsEOF();