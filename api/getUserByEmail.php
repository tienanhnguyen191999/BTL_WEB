<?php 
require('../repository/UserDAO.php');
use Repository\UserDAO;


if (isset($_GET['email'])) {
    $myUserDAO = new UserDAO();
    echo json_encode(["user" => $myUserDAO->getUserByEmail($_GET['email'])->fetch_assoc()]);
} else {
    echo "No ID Provided"; 
}

?>