<?php
if(isset($_GET['id'])) {
	include("../_incl/config.php");
	
	try {
		$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch(PDOException $ex) {
		die();
	}
	
	$stmt = $db->prepare("SELECT * FROM rserver_music WHERE id = :id");
   	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$sq = $stmt->execute();
	
	if($stmt->rowCount() < 1) {
		die();
	} else {
		foreach ($stmt->fetchAll() as $row) {
			if(!isset($_GET['name'])) {
				echo $row['url'];
			} else {
				echo $row['name'];
			}
		}
	}
}
?>