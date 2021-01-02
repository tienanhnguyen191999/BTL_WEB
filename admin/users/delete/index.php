<?php 
    if (!isset($_GET['id'])) {
        header("Location: http://127.0.0.1/admin/users?error=id");
        die();
    }
    // import
    require('../../../repository/UserDAO.php');
    use Repository\UserDAO;

    $myUserDao = new userDAO();
    $myUserDao->delete($_GET['id']);
    header("Location: http://127.0.0.1/admin/users?success=delete");
    die();
?>