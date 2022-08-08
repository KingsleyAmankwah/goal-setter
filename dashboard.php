<?php 

include './config/db.php';
session_start();
if(!$_SESSION['user']) { header("Location: index.php"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>You're welcome <?php echo $_SESSION['user']; ?></h1>
    <a href="logout.php">logout</a>
</body>
</html>
