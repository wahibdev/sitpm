    <?php
	require 'connexion_db/connection.php';
	header("Access-Control-Allow-Origin: *");
	////////////////////////////////////////////////requette recuperation de la liste de la journée /////////////////////////
	if (!empty($_GET['break_requestforAgent'])) {
		$requetteDeVAA='SELECT Id_Agent,Id_break,First_Name,Last_Name,Date_Time_Req,Date_Time_Val,Time_val_Ag FROM agents NATURAL JOIN breaks WHERE Date_Time_Req LIKE (SELECT CONCAT(CURRENT_DATE,"%")) AND Id_Agent IN (SELECT Id_Agent FROM breaks WHERE Id_Agent='.$_GET['break_requestforAgent'].') ORDER BY Date_Time_Req';
		$resultatVerifA = $pdo->query($requetteDeVAA);
		$dataVerifA = $resultatVerifA->fetchAll(PDO::FETCH_ASSOC);
		 if (empty($dataVerifA)) {
		 	$requetteBreakReaquest='INSERT INTO breaks (Id_Agent, Date_Time_Req) VALUES ('.$_GET['break_requestforAgent'].', current_timestamp())';

						$requetteBreakReaquestEnv=$pdo->exec($requetteBreakReaquest);
							if ($requetteBreakReaquestEnv==1) {
								echo "1:Demande Effectuer";
								}
							else{
							echo "Erreur inconnue";
								}
		 }else{
		 		$conditionAjouter=1;
		 		foreach ($dataVerifA as $ligneData) {
		 			if (is_null($ligneData['Date_Time_Val'])) {
		 				if (is_null($ligneData['Time_val_Ag'])) {
			 				$conditionAjouter=0;
			 				echo "vous avez une pause pas encore valider";
		 				}
		 				
		 			}elseif (is_null($ligneData['Time_val_Ag'])) {
		 					$conditionAjouter=0;
		 					echo "vous disposé d'une pause non encoure approuver";
		 				}
		 		}
		 		
		 		if ($conditionAjouter==1) {
		 			$requetteBreakReaquest='INSERT INTO breaks (Id_Agent, Date_Time_Req) VALUES ('.$_GET['break_requestforAgent'].', current_timestamp())';

						$requetteBreakReaquestEnv=$pdo->exec($requetteBreakReaquest);
							if ($requetteBreakReaquestEnv==1) {
								echo "1:Demande Effectuer";
								}
							else{
							echo "Erreur inconnue";
								}
		 		}
		 	}
		
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!empty($_GET['breakValidationVigie'])&&!empty($_GET['sender'])) {
		$requettebreakValidationVigie='UPDATE breaks SET Date_Time_Val = CURRENT_TIMESTAMP,Id_Validateur ='.$_GET['sender'].' 
		WHERE Id_break='.$_GET['breakValidationVigie'];
		$requettebreakValidationVigieSent=$pdo->exec($requettebreakValidationVigie);
		if ($requettebreakValidationVigieSent==1) {
								echo "Effectuer";
								}
							else{
							echo "Erreur inconnue";
								}
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!empty($_GET['breakValidationAgent'])) {
		$requettebreakValidationVigie='UPDATE breaks SET Time_val_Ag = CURRENT_TIMESTAMP WHERE Id_break='.$_GET['breakValidationAgent'];
		$requettebreakValidationVigieSent=$pdo->exec($requettebreakValidationVigie);
		if ($requettebreakValidationVigieSent==1) {
								echo "Effectuer";
								}
							else{
							echo "Erreur inconnue";
								}
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	?>