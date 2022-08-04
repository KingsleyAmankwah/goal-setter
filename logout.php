<?php   
    //Initialize session
    session_start();
    
    //unset all session values
    $_SESSION = array();

    //destroy sessions
    session_destroy();

    //redirect to login page
    header('Location:index.php');

?>