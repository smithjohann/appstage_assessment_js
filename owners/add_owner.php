<?php
// Johann AppStage Assessment
// add_owner.php - Displaying the form to record a new owner into the db

// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Variable indicating the task value - to be used in determining the validation to be performed in validation_client.php
$task = 'insert';
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Owner</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>

<main>
<!-- Initialise the php include function for the validation php script -->   
<?php include('../util/client_validation.php');?>
   
  <h1><u>Add a New Owner</u></h1>
	
  <div class="container">
  
  <!-- Message to show when an error has been detected in user's input -->
  <span class="error"><b><?php echo $validation_error;?></b></span>
  
  <!-- Form for adding a client -->
  <form method="post" id="add_client" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-25">
      <label for="ownerID">Identity Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="ownerID" name="ownerID" maxlength="13" placeholder="13 Digit SA ID Number" value="<?php echo $id;?>"></input>
	  <span class="error"><b>* <?php echo $idErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="nameSurname">Name and Surname</label>
    </div>
    <div class="col-75">
      <input type="text" id="nameSurname" name="nameSurname" placeholder="Enter Name and Surname of Owner" value="<?php echo $name;?>"></input>
	  <span class="error"><b>* <?php echo $nameErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="phoneNum">Phone Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="phoneNum" name="phoneNum" placeholder="0812345678" maxlength="10" value="<?php echo $telC;?>"></input>
	  <span class="error"><b>* <?php echo $telCErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="emailAdd">E-Mail Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="emailAdd" name="emailAdd" style="text-transform:lowercase"  placeholder="example@example.co.za" value="<?php echo $email;?>"></input>
	  <span class="error"><b>* <?php echo $emailErr;?></b></span>
    </div>
  </div>
  
    <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="address" name="address" placeholder="Enter Physical Address of Client" value="<?php echo $address;?>"></input>
	  <span class="error"><b>* <?php echo $addressErr;?></b></span> <!-- Google Maps API? -->
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