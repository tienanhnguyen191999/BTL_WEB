<?php 
    session_start();
    require('../repository/UserDAO.php');

    unset($_SESSION['user']); 
    header("Location: http://127.0.0.1/login?error=logout");
?>