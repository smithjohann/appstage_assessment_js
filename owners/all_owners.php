<?php
// Johann AppStage Assessment

//all_owners.php page
//Page showing all owners in the database. Data displayed in a neat HTML table.

//connecting to database via connection.php in the model folder
require('../model/connection.php');
	
//retrieving latest data from the tblowners table using the fetchAll method to display in a neat HTML Table
$queryAll = 'SELECT * FROM tblowners
             ORDER BY nameSurname';
$statementA = $db->prepare($queryAll);
$statementA->execute();
$owners = $statementA->fetchAll();
$statementA->closeCursor();

//Determining if a Deletion is requested and then processing the delete (using DELETE statement)
if (filter_input(INPUT_POST, 'owner_delete') != '') {
	$owner_delete = filter_input(INPUT_POST, 'owner_delete');
    $query = 'DELETE FROM tblowners
              WHERE OwnerID = :ownerId';
    $statement = $db->prepare($query);
    $statement->bindValue(':ownerId', $owner_delete);
    $success = $statement->execute();
    $statement->closeCursor();

	//refreshing the page after the owner has been deleted
	header("Location: all_owners.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>All Owners</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>
<main>
    <h1><u>All Owners</u></h1>
    <section>
        <table>
            <tr>
                <th>ID Number</th>
                <th>Name and Surname</th>
                <th>Phone Number</th>
                <th>Email Address</th>
				<th>Postal Address</th>
            </tr>

            <?php foreach ($owners as $owner) : ?>
            <tr>
                <td><?php echo $owner['ownerID']; ?></td>
                <td><?php echo $owner['nameSurname']; ?></td>
                <td><?php echo $owner['phoneNum']; ?></td>
				<td><?php echo $owner['emailAdd']; ?></td>
                <td><?php echo $owner['postalAdd']; ?></td>
				

				<td><form action="all_owners.php" method="post">
                    <input type="hidden" name="owner_delete"
                           value="<?php echo $owner['ownerID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table><br>
    </section>
</main>

</body>
<section>
<p><a href="add_owner.php">Add New Owner</a></p>
</section>
<footer>
 <a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</html>
