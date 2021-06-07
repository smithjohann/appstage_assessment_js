<?php
// Johann AppStage Assessment
// Validation script for the client/owner forms (adding, updating or searching a client)

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
$idErr = $nameErr = $addressErr = $telCErr = $emailErr = $validation_error =  ""; //DOUBLE CHECK VALIDATION ERROR

// Declare empty variables if data is being inserted or search is performed
if ($task == 'insert') {
	$id = $name = $address = $telC = $email = "";
} elseif ($task == 'search') {
	$id = '';
}

// Performing validation on each entry and performs necessary action once the form is submitted to $_SERVER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Declare empty variables when an update occurs
	if ($task == 'update') {
	$id = $name = $address = $telC = $email = "";
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
			if ($task == 'insert') {
				if (!empty($result)) {
					$idErr = "This owner already exists on the system.";
				}
			}
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
				$result = verify_client_exists_upon_insert($id);		//FUNCTION NOT FOUND	
				if (!empty($result)) {
					header('Location:owner_result.php?search='.$_POST['ownerID']);
				} else {
					$idErr = 'This owner is not registered with the veterinary';
				}
			}
		}			
	} //end of search task

	// Validating the name field
	if (empty($_POST["nameSurname"])) {
		$nameErr = "Name is required";
	} else {
		$name = ucwords(test_input($_POST["nameSurname"]));
		// check if name does not contain foreign characters
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Invalid name entered";
		}
	}
	
		// Validating the cellphone number field
	if (empty($_POST["phoneNum"])) {
		$telCErr = "Please enter a phone number";
	} else {
		$telC = test_input($_POST["phoneNum"]);
		// check if tel_cell only contains numbers
		if (!preg_match("/^[0-9 ]{7,}$/",$telC)) {
			$telCErr = "Invalid phone number entered";
		}
	}
	
		// Validating the email field
	if (empty($_POST["emailAdd"])) {
		$emailErr = "Please enter an email address";
	} else {
		// converting string to lower case
		$email = strtolower(test_input($_POST["emailAdd"])); 
		// performing email address validation by using FILTER_VALIDATE_EMAIL
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email entered";
		}
	}
	

	// Validating the address field
	if (empty($_POST["address"])) {
		$addressErr = "Address is required";
	} else {
		$address = ucwords(test_input($_POST["address"]));
	}
	
	
	// If an error is present, display a general error message to inform the user
	if ($idErr != "" || $nameErr != "" || $addressErr != "" || $telCErr != "" || $emailErr != "") {
		$validation_error = "* Required field(s) needs attention<br><br>";
	}
	
	// Determining if no error is present and to execute the relevant task
	if($idErr == "" && $nameErr == "" && $addressErr == "" && $telCErr == "" &&  $emailErr == "") {
	
	
		// determining the assigned $task variable, executing the correct sql statement and performing the correct header() execution
	
		if ($task === 'update') {
			//execute the update query
			$queryU = 'UPDATE tblowners
					   SET nameSurname = :nameSurname, phoneNum = :phoneNum, emailAdd = :emailAdd, postalAdd = :postalAdd 
                       WHERE ownerID = :ownerID';
			$statementU = $db->prepare($queryU);
			$statementU->bindValue(':nameSurname', $name);
			$statementU->bindValue(':phoneNum', $telC);
			$statementU->bindValue(':emailAdd', $email);
			$statementU->bindValue(':postalAdd', $address);
			$statementU->bindValue(':ownerID', $id);
			$statementU->execute();
			$statementU->closeCursor();
		
			header('Location:owner_result.php?updated='.$_POST['ownerID']);
		} //end of the update task
	
		if ($task === 'insert') {
			
			//excecute the insert query
			$query = 'INSERT INTO tblowners
						(ownerID, nameSurname, phoneNum, emailAdd, postalAdd)
					  VALUES
						(:ownerID, :nameSurname, :phoneNum, :emailAdd, :postalAdd)';
			$statementA = $db->prepare($query);
			$statementA->bindValue(':ownerID', $id);
			$statementA->bindValue(':nameSurname', $name);
			$statementA->bindValue(':phoneNum', $telC);
			$statementA->bindValue(':emailAdd', $email);
			$statementA->bindValue(':postalAdd', $address);
			$statementA->execute();
			$statementA->closeCursor();
		
			header('Location:owner_result.php?new='.$_POST['ownerID']);
			}
			
		} //end of the insert task
	
	} //end of executions
	
//end of $_POST
?>