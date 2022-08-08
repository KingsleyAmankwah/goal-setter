<?php   
    //Initialize session
    session_start();
    
    //unset all session value
    $_SESSION = array();

    //destroy sessions
    session_destroy();

    //redirect to login page
    header('Location:index.php');

?>