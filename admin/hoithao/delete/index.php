<?php 
    if (!isset($_GET['id'])) {
        header("Location: http://127.0.0.1/admin/hoithao?error=id");
        die();
    }
    // import
    require('../../../repository/ConferenceDAO.php');
    use Repository\ConferenceDAO;

    $myConferenceDAO = new ConferenceDAO();
    $myConferenceDAO->delete($_GET['id']);
    header("Location: http://127.0.0.1/admin/hoithao?success=delete");
    die();
?>