<!DOCTYPE html>
<html>

<head>
    <title>DB Error</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css" /> <!-- Styles for the page -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> <!-- used for the navbar styling -->
</head>

<body>
<?php include '../view/navbar.html';?>
    <header><h1>Error: Connecting to the database</h1></header>

    <main>
        <p>There was an error connecting to the database. This may be due to a system error or the database (MySQL) is not running.</p>
        <p>Please contact the system administrator for assitance.</p>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>

    <footer>
         <a class="logo" ><img src="../view/logo2.jpg" style="padding: 12px 12px 12px 5px; float: right;"></a>
    </footer>
</body>
</html>