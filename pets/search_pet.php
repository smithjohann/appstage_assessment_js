<?php
// Johann AppStage Assessment
//search_pet.php - End-user form for searching for pets beloning to a specific owner via his/her ID number

// Variable indicating the task value - to be used in determining the validation to be performed in validation_client.php
$task = 'search';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Client</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>

<main>
<!-- Initialise the php include function for the validation php script -->   
<?php include('../util/pet_validation.php');?>
   
  <h1><u>Search for Owner to view Pets</u></h1>

  <div class="container">
  
  <!-- Message to show when an error has been detected in user's input -->
  <span class="error"><b><?php echo $validation_error;?></b></span>
  
  <!-- Form for searching an owner -->
  <form method="post" id="search_pet" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <div class="row">
    <div class="col-25">
      <label for="ownerID">Identity Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="ownerID" name="ownerID" maxlength="13" placeholder="Enter ID Number" value="<?php echo $id;?>"></input>
	  <span class="error"><b>* <?php echo $idErr;?></b></span>
    </div>
  </div>
  
  <div class="row">
  <br>
    <input type="submit" value="Search" style="float: left;"></input>
	</div>
  </div>
  </form>
</main>
<footer>
<a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</body>
</html>