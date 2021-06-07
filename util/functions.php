<?php
// Johann AppStage Assessment
// functions.php - Containing functions for the system

// Connecting to the database
require('../model/connection.php');


function new_client() {
	if (htmlspecialchars($_GET['new']) != '') {
	$clientid = htmlspecialchars($_GET['new']);
	global $db;
	$queryAll = 'SELECT * FROM tblowners
             WHERE ownerID = :ownerID';
	$statementB = $db->prepare($queryAll);
	$statementB->bindValue(':ownerID', $clientid);
	$statementB->execute();
	$clients = $statementB->fetchAll();
	$statementB->closeCursor();
	
	return $clients;
	}
}

function new_pet() {
	if (htmlspecialchars($_GET['new']) != '') {
	$owner = htmlspecialchars($_GET['new']);
	global $db;
	$queryAll = 'SELECT * FROM tblpets
             WHERE ownerID = :ownerID';
	$statementB = $db->prepare($queryAll);
	$statementB->bindValue(':ownerID', $owner);
	$statementB->execute();
	$pets = $statementB->fetchAll();
	$statementB->closeCursor();
	
	return $pets;
	}
}

function search_client() {
	if (htmlspecialchars($_GET['search']) != '') {
		global $db;
		$clientid = htmlspecialchars($_GET['search']);
		$queryAll = 'SELECT * FROM tblowners
					 WHERE ownerID = :ownerID';
		$statementB = $db->prepare($queryAll);
		$statementB->bindValue(':ownerID', $clientid);
		$statementB->execute();
		$clients = $statementB->fetchAll();
		$statementB->closeCursor();
		return $clients;
	}
}

function update_client() {
	if (htmlspecialchars($_GET['updated']) != '') {
		$clientid = htmlspecialchars($_GET['updated']);
		global $db;
		$queryAll = 'SELECT * FROM tblowners
					 WHERE ownerID = :ownerID';
		$statementB = $db->prepare($queryAll);
		$statementB->bindValue(':ownerID', $clientid);
		$statementB->execute();
		$clients = $statementB->fetchAll();
		$statementB->closeCursor();
		return $clients;
	}
}

function update_pet() {
	if (htmlspecialchars($_GET['updated']) != '') {
		$owner = htmlspecialchars($_GET['updated']);
		global $db;
		$queryAll = 'SELECT * FROM tblpets
					 WHERE ownerID = :ownerID';
		$statementB = $db->prepare($queryAll);
		$statementB->bindValue(':ownerID', $owner);
		$statementB->execute();
		$pets = $statementB->fetchAll();
		$statementB->closeCursor();
		return $pets;
	}
}

function fetch_client($owner_update) { 
	global $db;
	$queryAll = 'SELECT * FROM tblowners
                 WHERE ownerID = :ownerID';
	$statementA = $db->prepare($queryAll);
	$statementA->bindValue(':ownerID', $owner_update);
	$statementA->execute();
	$client = $statementA->fetch();
	$statementA->closeCursor();
	return $client;
}

function fetch_pet($pet_update) { 
	global $db;
	$queryAll = 'SELECT * FROM tblpets
                 WHERE name = :name';
	$statementA = $db->prepare($queryAll);
	$statementA->bindValue(':name', $pet_update);
	$statementA->execute();
	$pet = $statementA->fetch();
	$statementA->closeCursor();
	return $pet;
}

function search_pet() {
	if (htmlspecialchars($_GET['search']) != '') {
		global $db;
		$owner = htmlspecialchars($_GET['search']);
		$queryAll = 'SELECT * FROM tblpets
					 WHERE ownerID = :ownerID';
		$statementB = $db->prepare($queryAll);
		$statementB->bindValue(':ownerID', $owner);
		$statementB->execute();
		$pets = $statementB->fetchAll();
		$statementB->closeCursor();
		return $pets;
	}
}

function verify_client_exists($id) { 
	global $db;
	$queryAll = 'SELECT * FROM tblowners
				 WHERE ownerID = :ownerID';
	$statementB = $db->prepare($queryAll);
	$statementB->bindValue(':ownerID', $id);
	$statementB->execute();
	$clients = $statementB->fetchAll();
	$statementB->closeCursor();
	return $clients;
}

function retrieve_pets($clientid) { 
	global $db;
	$queryAll = 'SELECT * FROM tblpets
				 WHERE ownerID = :ownerID';
	$statementB = $db->prepare($queryAll);
	$statementB->bindValue(':ownerID', $clientid);
	$statementB->execute();
	$pets = $statementB->fetchAll();
	$statementB->closeCursor();
	return $pets;
}

function retrieve_owner($cid) { 
	global $db;
	$queryAll = 'SELECT * FROM tblowners
				 WHERE ownerID = :ownerID';
	$statementB = $db->prepare($queryAll);
	$statementB->bindValue(':ownerID', $cid);
	$statementB->execute();
	$own = $statementB->fetchAll();
	$statementB->closeCursor();
	return $own;
}

?>