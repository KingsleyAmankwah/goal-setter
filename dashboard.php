<?php 
include 'goals.php';
if(!$_SESSION['user']) { header("Location: index.php"); }
include './config/db.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/sweetalert2.css">
    <link rel="shortcut icon" href="./assets/img.png" type="image/x-icon">
    <title>Dashboard</title>
</head>
<body>
   
    <header class='header'>
        
        <div class='logo'>
            <h4> GoalSetter</h4>
        </div>

        <ul>
            <li>
                 <a href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>

    </header>

<div class="container">

    <section class="heading">
            <h1>You're welcome <?php echo $_SESSION['user']; ?></h1>
            <p>Start setting goals</p>
    </section>

    <section class='form'>
      <form method="post">
        <input type="hidden" name="ID" value="<?php echo $id; ?>">
        <div class='form-group'>
          <label htmlFor='text'>Goal</label>
            <input type="text"  name="Goal" class="form-control"  value="<?php echo $name; ?>" required>
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
        $_SESSION['user_id'] = $uid;
        $count = 0;
        $query = "SELECT * FROM goals WHERE user_id=:uid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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