<?php
// Johann AppStage Assessment
// Validation script for the pet forms (adding, updating or searching a client)

// initialising the database connection
require('../model/connection.php');

// Function to ensure no whitespace or or is present in user's input
 function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function verify_client_exists_upon_insert($id) {
	global $db;
	$queryAll = 'SELECT ownerID FROM tblowners
						 WHERE ownerID = :ownerID';
			$statementB = $db->prepare($queryAll);
			$statementB->bindValue(':ownerID', $id);
			$statementB->execute();
			$result = $statementB->fetch();
			$statementB->closeCursor();
			return $result;
}


// Declaring empty error variables 
$idErr = $nameErr = $animalErr = $breedErr = $dateErr = $validation_error = ""; //DOUBLE CHECK VALIDATION ERROR

// Declare empty variables if data is being inserted or search is performed
if ($task == 'insert') {
	$id = $name = $animal = $breed = $dateI = "";
} elseif ($task == 'search') {
	$id = '';
}

// Performing validation on each entry and performs necessary action once the form is submitted to $_SERVER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Declare empty variables when an update occurs
	if ($task == 'update') {
	$id = $name = $animal = $breed = $dateI = "";
	}
	
	// Validating the ID Number field
	if (empty($_POST["ownerID"])) {
		$idErr = "SA ID Number required";
	} else {
		$id = test_input($_POST["ownerID"]);
		// check if ID number only contains a number input and contains 13 digits
		if (!preg_match('/^[0-9]{13}$/', $id)) { 
			$idErr = "Invalid ID Number";
		} else {
			// validating if a valid birthdate (first 6 digits of ID) is present
			$date = substr($id, 0, 6);
			$year = substr($date, 0, 2);
			$month = substr($date, 2, 2);
			$day = substr($date, 4, 6);
			if (checkdate($month, $day, $year) === FALSE) {
				$idErr = "Invalid ID Number due to incorrect Date of Birth";
			}
			$result = verify_client_exists_upon_insert($id);

		} 
	}

	// Validating if the owner is on the system when performing a search
	if ($task == 'search') {
		if (empty($_POST["ownerID"])) {
			$idErr = "SA ID Number required";
		} else {
			$id = test_input($_POST["ownerID"]);
			// check if ID number only contains a number input and contains 13 digits
			if (!preg_match('/^[0-9]{13}$/', $id)) { 
				$idErr = "Invalid ID Number";
			} else {
				// validating if a valid birthdate (first 6 digits of ID) is present
				$date = substr($id, 0, 6);
				$year = substr($date, 0, 2);
				$month = substr($date, 2, 2);
				$day = substr($date, 4, 6);
				if (checkdate($month, $day, $year) === FALSE) {
					$idErr = "Invalid ID Number due to incorrect Date of Birth";
				}
				// validating if the id number exists on the system
				$result = verify_client_exists_upon_insert($id);		
				if (!empty($result)) {
					header('Location:pet_result.php?search='.$_POST['ownerID']);
				} else {
					$idErr = 'This owner is not registered with the veterinary';
				}
			}
		}			
	} //end of search task


	// Validating the name field
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = ucwords(test_input($_POST["name"]));
		// check if name does not contain foreign characters
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Invalid name entered";
		}
	}
	
	// Validating the type of animal field
	if (empty($_POST["animalType"])) {
		$animalErr = "Type is required";
	} else {
		$animal = ucwords(test_input($_POST["animalType"]));
		// check if name does not contain foreign characters
		if (!preg_match("/^[a-zA-Z ]*$/",$animal)) {
			$animalErr = "Invalid type entered";
		}
	}
	
	// Validating the breed field
	if (empty($_POST["breed"])) {
		$breedErr = "Breed is required";
	} else {
		$breed = ucwords(test_input($_POST["breed"]));
		// check if name does not contain foreign characters
		if (!preg_match("/^[a-zA-Z ]*$/",$breed)) {
			$breedErr = "Invalid breed entered";
		}
	}
	

	// Validating the address field
	if (empty($_POST["postalAdd"])) {
		$addressErr = "Address is required";
	} else {
		$address = ucwords(test_input($_POST["postalAdd"]));
	}
	
	$dateI = ucwords(test_input($_POST["birthdate"]));
	
	// If an error is present, display a general error message to inform the user
	if ($idErr != "" || $dateErr != "" || $breedErr != "" || $animalErr != "" || $nameErr != "") {
		$validation_error = "* Required field(s) needs attention<br><br>";
	}
	
	// Determining if no error is present and to execute the relevant task
	if($idErr == "" && $dateErr == "" && $breedErr == "" && $animalErr == "" &&  $nameErr == "") {
	
	
		// determining the assigned $task variable, executing the correct sql statement and performing the correct header() execution
	
		if ($task === 'update') {
			//execute the update query
			$queryU = 'UPDATE tblpets
					   SET animalType = :animalType, breed = :breed, birthdate = :birthdate
                       WHERE ownerID = :ownerID and name = :name';
			$statementU = $db->prepare($queryU);
			$statementU->bindValue(':animalType', $animal);
			$statementU->bindValue(':breed', $breed);
			$statementU->bindValue(':birthdate', $dateI);
			$statementU->bindValue(':ownerID', $id);
			$statementU->bindValue(':name', $name);
			$statementU->execute();
			$statementU->closeCursor();
		
			header('Location:pet_result.php?updated='.$_POST['ownerID']); 
		} //end of the update task
	
		if ($task === 'insert') {
			
			//excecute the insert query
			$query = 'INSERT INTO tblpets
						(name, animalType, breed, ownerID, birthdate)
					  VALUES
						(:name, :animalType, :breed, :ownerID, :birthDate)';
			$statementA = $db->prepare($query);
			$statementA->bindValue(':name', $name);
			$statementA->bindValue(':animalType', $animal);
			$statementA->bindValue(':breed', $breed);
			$statementA->bindValue(':ownerID', $id);
			$statementA->bindValue(':birthDate', $dateI);
			$statementA->execute();
			$statementA->closeCursor();
		
			header('Location:pet_result.php?new='.$_POST['ownerID']);
			}
			
		} //end of the insert task
	
	} //end of executions
	
//end of $_POST
?>