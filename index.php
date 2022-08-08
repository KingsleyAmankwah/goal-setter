<?php include './config/db.php'; 
session_start();

function validateUserInput($data){
    trim($data);
    strip_tags($data);
    stripcslashes($data);
    htmlspecialchars($data);

    return $data;
}

if(isset($_POST['login'])){

    $email = validateUserInput($_POST['Email']);
    $password = validateUserInput($_POST['Password']);

    try {
        $hashedPassword = md5($password);
        $query = "SELECT * FROM users WHERE email=:emailid AND password=:pwd";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":emailid", $email , PDO::PARAM_STR);
        $stmt->bindParam(":pwd", $hashedPassword , PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            if($row = $stmt->fetch()){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user'] = $row['fullname'];
                header('Location: dashboard.php');
            }else{
                $_SESSION['title'] = "Page not found";
                $_SESSION['icon'] = "warning";
            }
        }else{
            $_SESSION['title'] = "Invalid credentials";
            $_SESSION['icon'] = "error";
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
<<<<<<< HEAD
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.13.0-web/css/all.min.css">
=======
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
    <title>Login System</title>
</head>
<body>
    <header class='header'>
        
        <div class='logo'>
            <h4> GoalSetter</h4>
        </div>

        <ul>
            <li>
                 <a href="register.php"> <i class="fas fa-user"></i>   Register</a>
            </li>
        </ul>

    </header>

    <div class="container">
<<<<<<< HEAD
        <section class="heading">
            <h1> <i class="fas fa-sign-in-alt"></i> Login</h1>
            <p>Login and start setting goals</p>
        </section>
    
        <section class="form">
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" id="email" class='form-control' name='Email' placeholder="Enter Email..." onChange={onChange} />
                </div>
                <div class="form-group">
                    <input type="password" id="password" class='form-control' name='Password' placeholder="Enter Password..." onChange={onChange} />
                </div>
               
    
                <div class='form-group'>
                    <button type="submit" class='btn btn-block' name='login'>Submit</button>
                </div>
            </form>
        </section>

        <a href="register.php">Do not have an account?</a>
=======
        <form action="" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="Email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="email" name="Password" class="form-control" placeholder="Enter Password">
            </div>

            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
    </div>
    <script src="./assets/sweetalert2.min.js"></script>
</body>
</html>


<?php 

<<<<<<< HEAD
if(isset($_SESSION['title']) && $_SESSION['title'] !== ''){
=======
if(isset($_SESSION['msg']) && $_SESSION['msg'] !== ''){
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4

    ?>
    <script>
    Swal.fire({
<<<<<<< HEAD
        title: "<?php echo $_SESSION['title']; ?>",
=======
        title: "<?php echo $_SESSION['msg']; ?>",
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
        icon: "<?php echo $_SESSION['icon']; ?>",
        timer: 3000,
    })
    </script>

    <?php

<<<<<<< HEAD
    unset($_SESSION['title']);
=======
    unset($_SESSION['msg']);
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
}

?>