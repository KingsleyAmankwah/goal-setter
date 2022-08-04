<?php  
$username = 'localhost';
$server = 'root';
$database = 'login_system';
$password = '';


try {
    
    $conn = new PDO("mysql:host=$username; dbname=$database", $server, $password);
    //var_dump($conn);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>