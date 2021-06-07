<?php
// Johann AppStage Assessment
// update_owner.php - Displaying a form pre-loaded with the owner's data to allow the end-user to update the data

// Including the functions file, which also includes the connection to the db (connection.php)
include '../util/functions.php';

// Variable indicating the task value - to be used in determining the validation to be performed in validation_client.php
$task = 'update';

// Retrieving the ID number of the client being updated
$owner_update = htmlspecialchars(filter_input(INPUT_GET, 'owner_update'));

// Calling the fetch_client() function
$client = fetch_client($owner_update);

// Assigning variables to the index as fetched from the table in the fetch_client() function
$id = $client['ownerID'];
$name = $client['nameSurname'];
$telC = $client['phoneNum'];
$email = $client['emailAdd'];
$address = $client['postalAdd'];
		
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Owner</title>
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

    <h1>Updating Owner with ID Number <b><?php echo $id; ?></b> </h1>
    
    <div class="container">
	
	<!-- Message to show when an error has been detected in user's input -->
    <span class="error"><b><?php echo $validation_error;?></b></span>
	
    <!--Form to update data in the database table with current data filled-->
    <form method="post" id="owner_update" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  
	<input type="hidden" name="ownerID" value="<?php echo $id; ?>"></input>

  <div class="row">
    <div class="col-25">
      <label for="nameSurname">Name and Surname</label>
    </div>
    <div class="col-75">
      <input type="text" id="nameSurname" name="nameSurname" value="<?php echo $name;?>"></input>
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
      <label for="address">Postal Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="address" name="address" value="<?php echo $address;?>"></input>
      <span class="error"><b>* <?php echo $addressErr;?></b></span>
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