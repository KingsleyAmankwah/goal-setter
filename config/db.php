<?php  
$username = 'localhost';
$server = 'root';
$database = 'goal-setter';
$password = '';


try {
    
    $conn = new PDO("mysql:host=$username; dbname=$database", $server, $password);
    //var_dump($conn);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>