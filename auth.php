<?php
require 'connexion_db/connection.php';
header("Access-Control-Allow-Origin: *");
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['projet'])) {
	$requeteUserLogin="SELECT  	Id_Agent, Log_Session, password, Id_Projet, Label_Profile FROM agents NATURAL JOIN projets NATURAL JOIN profiles WHERE Log_Session='".$_POST['username']."' AND password='".$_POST['password']."' AND Id_Projet=".$_POST['projet'];
	$resultatUser = $pdo->query($requeteUserLogin);
	$resultatUserba=$resultatUser->fetchAll(PDO::FETCH_ASSOC);
	if ($resultatUserba) {
		$detailsLog = array(
			'id_agent' => $resultatUserba['0']['Id_Agent'],
			'userSession' =>	$resultatUserba['0']['Log_Session'],
			'profile' =>	$resultatUserba['0']['Label_Profile'],
			'auth'=>"authorized"
		);
		echo $jsonDetailsLog=json_encode($detailsLog);
		
	}
	else{
		echo "no";
	}

}else{
	
	echo "No";
}




?>
