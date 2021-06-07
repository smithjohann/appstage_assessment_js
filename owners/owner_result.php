<?php
// Johann AppStage Assessment
// owner_result.php - Displaying the owner who was successfully added, updated or searched for in a neat HTML table


// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Determining the action that was performed and displaying the data accordingly
if ($_GET['new'] != '') {
	$clients = new_client();
	foreach ($clients as $client) {
		$clientname = $client['nameSurname'];
		$clientid = $client['ownerID'];
	}
	$result = "New Owner ($clientname) Successfully Added";
	$pets = retrieve_pets($clientid);
} elseif ($_GET['updated'] != '') {
	$clients = update_client();
	foreach ($clients as $client) {
		$clientname = $client['nameSurname'];
		$clientid = $client['ownerID'];
	}
	$result = "Patient ($clientname) Successfully Updated";
	$pets = retrieve_pets($clientid);
} elseif  ($_GET['search'] != '') {
	$clients = search_client();
	foreach ($clients as $client) {
		$clientname = $client['nameSurname'];
		$clientid = $client['ownerID'];
	}
	$result = "Showing details of $clientname";
	$pets = retrieve_pets($clientid);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Owner Information</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>

<main>
	<br>
	<!--Displaying appropriete heading using $result-->
    <h2><?php echo $result;?></h2>
	
	<!--Displaying the client in a HTML Table with two associated buttons to perform actions-->
    <div class="container">
        <table>
            <tr>
                <th>ID Number</th>
                <th>Name and Surname</th>
                <th>Phone Number</th>
                <th>Email Address</th>
				<th>Postal Address</th>
            </tr>

            <?php foreach ($clients as $client) : ?>
            <tr>
                <td><?php echo $client['ownerID']; ?></td>
                <td><?php echo $client['nameSurname']; ?></td>
                <td><?php echo $client['phoneNum']; ?></td>
				<td><?php echo $client['emailAdd']; ?></td>
				<td><?php echo $client['postalAdd']; ?></td>
			
			<td><form action="update_owner.php" method="get">
                    <input type="hidden" name="owner_update"
                           value="<?php echo $client['ownerID']; ?>"></input>
                    <input type="submit" value="Update Client"></input>
            </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
	</div>	
	<br>
	<h2>Pets Owned</h2>
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