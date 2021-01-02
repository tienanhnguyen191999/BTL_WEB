<?php 
    if (!isset($_GET['id'])) {
        header("Location: http://127.0.0.1/admin/nhataitro?error=id");
        die();
    }
    // import
    require('../../../repository/NhataitroDAO.php');
    use Repository\NhataitroDAO;

    $myNhataitroDAO = new NhataitroDAO();
    $myNhataitroDAO->delete($_GET['id']);
    header("Location: http://127.0.0.1/admin/nhataitro?success=delete");
    die();
?>