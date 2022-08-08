<?php include './config/db.php'; 
session_start();

function validateUserInput($data){
    trim($data);
    strip_tags($data);
    stripcslashes($data);
    htmlspecialchars($data);

    return $data;
}

if (isset($_POST['register'])) {
    
    $fullname = validateUserInput($_POST['Fullname']);
    $email = validateUserInput($_POST['Email']);
    $password = validateUserInput($_POST['Password']);
    $confirmPassword = validateUserInput($_POST['cPassword']);

    try {
        
        $query = "SELECT email from users WHERE email=:Emailid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":Emailid", $email, PDO::PARAM_STR);

        $stmt->execute();
        if($stmt->rowCount() == 1){

            $_SESSION['title'] = "Email already exist";
            $_SESSION['icon'] = "error";

        }else{

            if(strlen($password) < 8){
                $_SESSION['title'] = "Password must be at least 8 characters";
                $_SESSION['icon'] = "error";
            }else{
                if ($password !== $confirmPassword) {
                    $_SESSION['title'] = "The two passwords do not match";
                    $_SESSION['icon'] = "error";
                }else{
                    $hashedPassword = md5($password);
                    $sql = "INSERT INTO users(fullname, email, password) VALUES(?,?,?)";
                    $statement = $conn->prepare($sql);
                    $statement->bindParam(1, $fullname , PDO::PARAM_STR);
                    $statement->bindParam(2, $email , PDO::PARAM_STR);
                    $statement->bindParam(3, $hashedPassword , PDO::PARAM_STR);

                    $statement->execute();
                    $_SESSION['title'] = "Account Successfully created";
                    $_SESSION['icon'] = "success";
                    //header('Location: dashboard.php');
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/sweetalert2.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.13.0-web/css/all.min.css">
    <title>Register</title>
</head>
<body>

    <header class='header'>
        <div class='logo'>
            <h4>GoalSetter</h4>
        </div>

        <ul>    
            <li>
                  <a href="index.php"> <i class="fas fa-sign-in-alt"></i>    Login</a>
            </li>
        </ul>
    </header>
    
    <div class="container">

        <section class="heading">
            <h1><i class="fas fa-user"></i> Register</h1>
            <p>Register and start setting goals</p>
        </section>

        <form action="" method="post">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="Fullname" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="Email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="Password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="cPassword" class="form-control" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-block" name="register">Register</button>
        </form>

        
        <a href="index.php">Already have an account?</a>
    </div>
<script src="./assets/sweetalert2.min.js"></script>
</body>
</html>

<?php 

if(isset($_SESSION['title']) && $_SESSION['title'] !== ''){

    ?>
    <script>
    Swal.fire({
        title: "<?php echo $_SESSION['title']; ?>",
        icon: "<?php echo $_SESSION['icon']; ?>",
        timer: 3000,
    })
    </script>

    <?php

    unset($_SESSION['title']);
}

?>