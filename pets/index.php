<?php
//Johann AppStage Assessment

//index.php page for Pet Management
?>
<html>

<head>
    <title>New Pet</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>
<body>

<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>
    <main>
	 <h1><u>Owner Management</u></h1>
	 <br>
	<a href="add_pet.php">Add a New Pet</a>
	<br><br>
	<a href="search_pet.php">Search & Modify a Pet</a>
	<br><br>
	<a href="all_pets.php">View All Pets</a>
	<br>
    </main>
    <br>
</body>

<footer>
	<a class="logo" ><img src="../view/logo2.jpg" style="padding: 5px 5px 5px 5px; float: right;"></a>
</footer>
</html>
