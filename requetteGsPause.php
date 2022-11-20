    <?php
	require 'connexion_db/connection.php';
	////////////////////////////////////////////////requette recuperation de la liste de la journée /////////////////////////
	header("Access-Control-Allow-Origin: *");              // Tous les domaines
	//header("Access-Control-Allow-Origin: localhost");    // Seul monsite peut y accéder
	if (!empty($_GET['getlistpause']) && isset($_GET['getlistpause']) && $_GET['getlistpause']=="tout") {
		$requete='SELECT Id_Agent,Id_break,First_Name,Last_Name,Date_Time_Req,Date_Time_Val, Time_val_Ag FROM agents NATURAL JOIN breaks WHERE Date_Time_Req LIKE CONCAT(CURRENT_DATE,"%") ORDER BY Date_Time_Req' ;
		$resultat = $pdo->query($requete);
		$data = $resultat->fetchAll(PDO::FETCH_ASSOC);
		$jsondata=json_encode($data);
		echo $jsondata;

	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!empty($_GET['getlistpause']) && isset($_GET['getlistpause']) && $_GET['getlistpause'] && !empty($_GET['id_user'])=="nonValider") {
		$requete='SELECT Id_Agent,Id_break,First_Name,Last_Name,Date_Time_Req,Date_Time_Val,Time_val_Ag FROM agents NATURAL JOIN breaks WHERE Date_Time_Req LIKE CONCAT(CURRENT_DATE,"%") ORDER BY Date_Time_Req ASC';
		$resultat = $pdo->query($requete);
		$data = $resultat->fetchAll(PDO::FETCH_ASSOC);
		$agentBeforme=0;
			foreach ($data as $ligne_agent) {
				if ($ligne_agent['Id_Agent']!=$_GET['id_user']&&$ligne_agent['Date_Time_Val']==NULL) {
					$agentBeforme++;
				}
				elseif ($ligne_agent['Id_Agent']==$_GET['id_user']&&$ligne_agent['Date_Time_Val']==NULL) {
					break;
				}
			}
		$taleauReponse = array(
			"TableauDATA"=>$data,
			"aBM"=>$agentBeforme);
		$jsondata=json_encode($taleauReponse);
		echo $jsondata;

	}
	/////////////////////////////////////////////////////////////////////////////getlisteproject////////////////////////////////
	if (!empty($_GET['getlistproject']) && isset($_GET['getlistproject']) && $_GET['getlistproject']=="tout") {
		$requeteProjets="SELECT Id_Projet, Label FROM projets";
		$resultatProjets = $pdo->query($requeteProjets);
		$dataProjets = $resultatProjets->fetchAll(PDO::FETCH_ASSOC);
		$jsondataProjets=json_encode($dataProjets);
		echo $jsondataProjets;
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	?>