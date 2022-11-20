<?php
class sql extends dbconn {
	public function __construct()
	{
		$this->initDBO();
	}
public function listNotifUser($user){
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("SELECT * FROM break
				WHERE Log_Session= :user
				AND notif_loop > 0
				AND Date_Time_Val  <= CURRENT_TIMESTAMP()");
			$stmt->bindParam("user", $user);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stat[2] = $stmt->rowCount();
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}
}