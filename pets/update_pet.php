<?php
// Johann AppStage Assessment
// update_pet.php - Displaying a form pre-loaded with the pet's data to allow the end-user to update the data

// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Variable indicating the task value - to be used in determining the validation to be performed in pet_client.php
$task = 'update';

// Retrieving the ID number of the client being updated
$pet_update = htmlspecialchars(filter_input(INPUT_GET, 'pet_update'));

// Calling the fetch_client() function
$pet = fetch_pet($pet_update);

// Assigning variables to the index as fetched from the table in the fetch_client() function
$name = $pet['name'];
$animal = $pet['animalType'];
$breed = $pet['breed'];
$id = $pet['ownerID'];
$dateI = $pet['birthdate'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Pet</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>

<main>
 <!-- Initialise the php include function for the validation php script -->   
<?php include('../util/client_validation.php');?>

    <h1>Updating Pet beloning to ID Number <b><?php echo $id; ?></b> </h1>
    
    <div class="container">
	
	<!-- Message to show when an error has been detected in user's input -->
    <span class="error"><b><?php echo $validation_error;?></b></span>
	
    <!--Form to update data in the database table with current data filled-->
    <form method="post" id="pet_update" action="pet_result.php">

   <div class="row">
    <div class="col-25">
      <label for="name">Pet Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Enter Name of Pet" value="<?php echo $name;?>"></input>
	  <span class="error"><b>*</b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="animalType">Type of Animal</label>
    </div>
    <div class="col-75">
      <input type="text" id="animalType" name="animalType" placeholder="Enter Type of Animal" value="<?php echo $animal;?>"></input>
	  <span class="error"><b>*</b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="breed">Breed</label>
    </div>
    <div class="col-75">
      <input type="text" id="breed" name="breed" placeholder="Enter Breed" value="<?php echo $breed;?>"></input>
	  <span class="error"><b>*</b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="ownerID">Owner ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="ownerID" name="ownerID" placeholder="Enter ID Number of Owner" value="<?php echo $id;?>"></input>
	  <span class="error"><b>*</b></span>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="date">Date of Birth</label>
    </div>
    <div class="col-75">
      <input type="date" id="birthdate" name="birthdate" max="<?php echo $current_date;?>" value="<?php echo $dateI;?>">
  <span class="error"><b>*</b></span>
    </div>
  </div>

 
	<div class="row">
		<br>
		<input type="submit" value="Update" style="float: left;">
	</div>
	</form>
	
  </div>
</div>
<br>
</main>
<footer>
 <a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</body>
</html>