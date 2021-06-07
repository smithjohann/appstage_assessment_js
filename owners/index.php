<?php
//Johann AppStage Assessment

//index.php page for the Owner Management section of the application
?>
<html>

<head>
    <title>Owner Management</title>
	<link rel="shortcut icon" type="image/x-icon" href="../view/logo3.gif" />
    <link rel="stylesheet" type="text/css" href="../view/main.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<!-- The header of the HTML page (displaying nav bar) -->
<?php include '../view/navbar.html';?>
    <main>
	 <h1><u>Owner Management</u></h1>
	 <br>
	<a href="add_owner.php">Add a New Owner</a>
	<br><br>
	<a href="search_owner.php">Search & Modify an Owner</a>
	<br><br>
	<a href="all_owners.php">View All Owners</a>
    </main>
    <br>
</body>

<footer>
 <a class="logo"><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
</footer>
</html>
