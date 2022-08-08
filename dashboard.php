<?php 

<<<<<<< HEAD
include 'goals.php';
include './config/db.php';
=======
include './config/db.php';
session_start();
if(!$_SESSION['user']) { header("Location: index.php"); }
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="./assets/sweetalert2.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.13.0-web/css/all.min.css">
    <title>Dashboard</title>
</head>
<body>


<header class='header'>
  
        <div class='logo'>
            <h4>GoalSetter</h4>
        </div>

        <ul>
          <li>
              <a href="logout.php" class="btn">  <i class="fas fa-sign-out-alt"></i> Logout </a>
          </li>
        </ul>
</header>

<div class="container">
    <section class='heading'>
        <h1>Welcome <?php echo $_SESSION['user']; ?></h1>
        <p>Goals Dashboard</p>
</section>


    <section class='form'>
      <form method="post" action="">

        <input type="hidden" name="ID" value="<?php echo $id; ?>">
        <div class='form-group'>
          <label htmlFor='text'>Goal</label>
            <input type="text" name="Goal" value="<?php echo $name; ?>" placeholder="Enter your goal..." required>
        </div>
        <div class='form-group'>

          <?php if($update): ?>
          <button class='btn' name="update" type='submit'>
            Update
          </button>

          <?php else: ?>

          <button class='btn btn-block' name="add" type='submit'>
            Add Goal
          </button>

          <?php endif; ?>
        </div>
      </form>
    </section>

    <?php 
    $uid = $_SESSION['user_id'];
      $sql = "SELECT * FROM goals WHERE user_id=:user";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":user", $uid, PDO::PARAM_INT);
       $stmt->execute();

       $results = $stmt->fetchAll();
        $count = 0;
        foreach($results as $row){
    ?>


   <div class='goal'>
      <p> <?php echo ++$count; ?> </p>
      <h2> <?php echo $row['goal_name']; ?> </h2>
      <a href="dashboard.php?edit=<?php echo $row['goal_id']; ?>"> <i class="fas fa-edit"></i> </a>
      <a href="dashboard.php?delete=<?php echo $row['goal_id']; ?>"> <i class="fas fa-trash"></i> </a>
    </div>
  

    <?php } ?>
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
    }).then(function () {
      window.location = "dashboard.php";
    })
    </script>

    <?php

    unset($_SESSION['title']);
}

?>
=======
    <title>Dashboard</title>
</head>
<body>
    <h1>You're welcome <?php echo $_SESSION['user']; ?></h1>
    <a href="logout.php">logout</a>
</body>
</html>
>>>>>>> 5b30df1c01f5e99942b64354251fed3712583ef4
