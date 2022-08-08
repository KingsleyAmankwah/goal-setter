<?php
include './config/db.php';
session_start();
if(!$_SESSION['user_id']) { header("Location: index.php"); }

$update = false;
$id = 0;
$name = "";

 $uid = $_SESSION['user_id']; 


if(isset($_POST['add'])){
    $goal = $_POST['Goal'];

    try {
        $query = "INSERT INTO goals (goal_name,user_id) VALUES(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $goal , PDO::PARAM_STR);
        $stmt->bindParam(2, $uid , PDO::PARAM_INT);
        $res =  $stmt->execute();

        if($res){
            $_SESSION['title'] = "Goal created";
            $_SESSION['icon'] = "success";
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if(isset($_GET['edit'])){
    $update = true;
    $goal_id = $_GET['edit'];
    $query = "SELECT * FROM goals WHERE goal_id=:id";
    $stmt= $conn->prepare($query);
    $stmt->bindParam(":id", $goal_id , PDO::PARAM_INT);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $id = $row['goal_id'];
        $name = $row['goal_name'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['ID'];
    $goal = $_POST['Goal'];

    try {
        $query = "UPDATE goals SET goal_name=:name WHERE goal_id=:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $goal , PDO::PARAM_STR);
        $stmt->bindParam(":id", $id , PDO::PARAM_INT);

        $res =  $stmt->execute();

        if($res){
            $_SESSION['title'] = "Goal Updated";
            $_SESSION['icon'] = "success";
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if(isset($_GET['delete'])){
    $goal_id = $_GET['delete'];

    try {
        $query = "DELETE FROM goals WHERE goal_id=:id";
        $stmt= $conn->prepare($query);
        $stmt->bindParam(":id" , $goal_id , PDO::PARAM_INT);
        $res =  $stmt->execute();

        if($res){
            $_SESSION['title'] = "Goal Deleted";
            $_SESSION['icon'] = "success";
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>