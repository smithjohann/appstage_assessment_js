<?php
// Johann AppStage Assessment
// pet_result.php - Displaying the pet who was successfully added, updated or searched for in a neat HTML table

// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Determining the action that was performed and displaying the data accordingly
if ($_GET['new'] != '') {
	$pets = new_pet();
	foreach ($pets as $pet) {
		$pname = $pet['name'];
		$cid = $pet['ownerID'];
	}
	$result = "New Pet added for Owner with ID $cid";
	$own = retrieve_owner($cid);
} elseif ($_GET['updated'] != '') {
	$pets = update_pet();
	foreach ($pets as $pet) {
		$pname = $pet['name'];
		$cid = $pet['ownerID'];
	}
	$result = "Pets for Owner with ID $cid Successfully Updated";
	$own = retrieve_owner($cid);
} elseif  ($_GET['search'] != '') {
	$pets = search_pet();
	foreach ($pets as $pet) {
		$pname = $pet['name'];
		$cid = $pet['ownerID'];
	}
	$result = "Showing Pets of owner with ID $cid";
	$own = retrieve_owner($cid);
}

//Determining if an update was processed - Secondary Method in procesing an update using INPUT_POST
if (filter_input(INPUT_POST, 'name') != '') { 
	$name_update = filter_input(INPUT_POST, 'name');
	$animal_update = filter_input(INPUT_POST, 'animalType');
	$breed_update = filter_input(INPUT_POST, 'breed');
	$owner_update = filter_input(INPUT_POST, 'ownerID');
	$date_update = filter_input(INPUT_POST, 'birthdate');
  
	//Updating the db
			$queryU = 'UPDATE tblpets
					   SET animalType = :animalType, breed = :breed, birthdate = :birthdate
                       WHERE ownerID = :ownerID and name = :name';
			$statementU = $db->prepare($queryU);
			$statementU->bindValue(':animalType', $animal_update);
			$statementU->bindValue(':breed', $breed_update);
			$statementU->bindValue(':birthdate', $date_update);
			$statementU->bindValue(':ownerID', $owner_update);
			$statementU->bindValue(':name', $name_update);
			$statementU->execute();
			$statementU->closeCursor();
	
	//Display the updated data
	$queryAll = 'SELECT * FROM tblpets
             WHERE ownerID = :ownerID';
	$statementA = $db->prepare($queryAll);
	$statementA->bindValue(':ownerID', $owner_update);
	$statementA->execute();
	$pets = $statementA->fetchAll();
	$statementA->closeCursor();
	
	$result = "Pets for Owner with ID $owner_update Successfully Updated";
	$own = retrieve_owner($owner_update);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Information</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (nav bar) -->
<?php include '../view/navbar.html';?>

<main>
	<br>
	<!--Displaying appropriete heading using $result-->
    <h2><?php echo $result;?></h2>
	
	<!--Displaying the client in a HTML Table with two associated buttons to perform actions-->
	<div class="container">
        <table>
            <tr>
                <th>Pet Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Birthdate</th>
            </tr>

            <?php foreach ($pets as $pet) : ?>
            <tr>
                <td><?php echo $pet['name']; ?></td>
                <td><?php echo $pet['animalType']; ?></td>
                <td><?php echo $pet['breed']; ?></td>
				<td><?php echo $pet['birthdate']; ?></td>
				
				<td><form action="update_pet.php" method="get">
                    <input type="hidden" name="pet_update"
                           value="<?php echo $pet['name']; ?>"></input>
                    <input type="submit" value="Update Pet"></input>
            </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
	</div>
	
	    <div class="container">
		<h2>Owner Information</h2>
        <table>
            <tr>
                <th>Name and Surname</th>
                <th>Phone Number</th>
                <th>Email Address</th>
				<th>Postal Address</th>
            </tr>

            <?php foreach ($own as $client) : ?>
            <tr>
                <td><?php echo $client['nameSurname']; ?></td>
                <td><?php echo $client['phoneNum']; ?></td>
				<td><?php echo $client['emailAdd']; ?></td>
				<td><?php echo $client['postalAdd']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
	</div>
	
</main>
</body>
<br/>
<footer>
 <a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</html>