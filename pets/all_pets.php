<?php
//Johann AppStage Assessment

//all_pets.php page
//Page showing all pets present in the database. Data displayed in a neat HTML table.

//connecting to database via connection.php in the model folder
require('../model/connection.php');
	
//retrieving latest data from the tblowners table using the fetchAll method to display in a neat HTML Table
$queryAll = 'SELECT P.name, P.animalType, P.breed, P.ownerID, O.nameSurname, P.birthdate
			 FROM tblpets P
			 JOIN tblowners O
			 ON P.ownerID = O.ownerID';
$statementA = $db->prepare($queryAll);
$statementA->execute();
$pets = $statementA->fetchAll();
$statementA->closeCursor();

//Determining if a Deletion is requested and then processing the delete (using DELETE statement)
if (filter_input(INPUT_POST, 'pet_delete') != '') {
	$pet_delete = filter_input(INPUT_POST, 'pet_delete');
    $query = 'DELETE FROM tblpets
              WHERE name = :name';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $pet_delete);
    $success = $statement->execute();
    $statement->closeCursor();
	
	//refreshing the page after deletion
	header("Location: all_pets.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>All Pets</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>

<main>
    <h1><u>All Pets</u></h1>
    <section>
        <table>
            <tr>
                <th>Pet Name</th>
                <th>Type of Animal</th>
                <th>Breed</th>
                <th>Owner ID</th>
				<th>Owner Name</th>
				<th>Birthdate</th>
            </tr>

            <?php foreach ($pets as $pet) : ?>
            <tr>
                <td><?php echo $pet['name']; ?></td>
                <td><?php echo $pet['animalType']; ?></td>
                <td><?php echo $pet['breed']; ?></td>
				<td><?php echo $pet['ownerID']; ?></td>
				<td><?php echo $pet['nameSurname']; ?></td>
                <td><?php echo $pet['birthdate']; ?></td>
				

				<td><form action="all_pets.php" method="post">
                    <input type="hidden" name="pet_delete"
                           value="<?php echo $pet['name']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
				
            </tr>
            <?php endforeach; ?>
        </table><br>
    </section>
</main>

</body>
<section>
<p><a href="add_pet.php">Add New Pet</a></p>
</section>
<footer>
 <a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</html>
