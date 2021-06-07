<?php
// Johann AppStage Assessment
// add_pet.php - Displaying the form to record a new pet into the db

// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Variable indicating the task value - to be used in determining the validation to be performed in validation_client.php
$task = 'insert';

// Initialisng the current date - used to restrict the datepicker not to accept a date before today's date
$current_date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Pet</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (displaying logo and nav bar) -->
<?php include '../view/navbar.html';?>

<main>
<!-- Initialise the php include function for the validation php script -->   
<?php include('../util/pet_validation.php');?>
   
  <h1><u>Add a New Pet</u></h1>
	
  <div class="container">
  
  <!-- Message to show when an error has been detected in user's input-->
  <span class="error"><b><?php echo $validation_error;?></b></span>
  
  <!-- Form for adding a pet -->
  <form method="post" id="add_pet" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-25">
      <label for="name">Pet Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Enter Name of Pet" value="<?php echo $name;?>"></input>
	  <span class="error"><b>* <?php echo $nameErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="animalType">Type of Animal</label>
    </div>
    <div class="col-75">
      <input type="text" id="animalType" name="animalType" placeholder="Enter Type of Animal" value="<?php echo $animal;?>"></input>
	  <span class="error"><b>* <?php echo $animalErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="breed">Breed</label>
    </div>
    <div class="col-75">
      <input type="text" id="breed" name="breed" placeholder="Enter Breed" value="<?php echo $breed;?>"></input>
	  <span class="error"><b>* <?php echo $breedErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="ownerID">Owner ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="ownerID" name="ownerID" placeholder="Enter ID Number of Owner" value="<?php echo $id;?>"></input>
	  <span class="error"><b>* <?php echo $idErr;?></b></span>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="date">Date of Birth</label>
    </div>
    <div class="col-75">
      <input type="date" id="birthdate" name="birthdate" max="<?php echo $current_date;?>" value="<?php echo $dateI;?>">
  <span class="error"><b>* <?php echo $dateErr;?></b></span>
    </div>
  </div>
  

  <div class="row">
	<br>
    <input type="submit" value="Submit" style="float: left;">
  </div>
	
  </div> <!-- end of the container-->
  </form>
  
</main>
<footer>
	<a class="logo" ><img src="../view/logo2.jpg" style="padding: 5px 5px 5px 5px; float: right;"></a>
</footer>
</body>
</html>