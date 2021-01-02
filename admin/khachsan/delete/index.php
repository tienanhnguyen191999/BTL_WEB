<?php 
    if (!isset($_GET['id'])) {
        header("Location: http://127.0.0.1/admin/khachsan?error=id");
        die();
    }
    // import
    require('../../../repository/HotelDAO.php');
    use Repository\HotelDAO;

    $myHotelDAO = new HotelDAO();
    $myHotelDAO->delete($_GET['id']);
    header("Location: http://127.0.0.1/admin/khachsan?success=delete");
    die();
?>