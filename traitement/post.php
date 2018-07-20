<?php

//suppression des ordinateurs
if(isset($_POST['supprimer']) && isset($_POST['ordinateurs'])){
	$ordis = $_POST['ordinateurs'];
	foreach($ordis as $ordi){
		$client->CallAPI(
			'https://webapi.teamviewer.com/api/v1/devices/'.$ordi,
			'DELETE', array(), array('FailOnAccessError'=>true), $ordinateurs);
	}
}