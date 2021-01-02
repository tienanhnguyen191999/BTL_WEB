<?php 
namespace Repository;

require_once('DAO.php');

use Repository\DAO;
use Model\User;

class UserDAO extends DAO 
{
    public function __construct()
    {
        $this->con = parent::getInstance()->getCon();
    }

    public function store (User $user) {
        $sql = "INSERT INTO `user` (`email`, `password`, `role`) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sss', $user->email, $user->password, $user->role); // 's' specifies the variable type => 'string'
        $stmt->execute();
    }

    public function getSelected ($id) {
        $sql = "SELECT * FROM user WHERE id=" . $id;
        $result = $this->con->query($sql);
        return $result;
    }

    public function getUserByEmail ($email) {
        $sql = "SELECT * FROM user WHERE email='".$email."'";
        $result = $this->con->query($sql);        
        return $result;
    }

    public function getAll () {
        $sql = "SELECT * FROM user";
        $result = $this->con->query($sql);
        return $result;
    }

    public function update (User $user) {
        $sql = "UPDATE `user` SET `password` = ? WHERE (`id` = ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sd', $user->password, $user->id);
        $stmt->execute();
        // die();
    }

    public function delete ($id) {
        $sql = "DELETE FROM `user` WHERE (`id` = " . $id . ")";
        $stmt = $this->con->query($sql);
    }

    public function login ($email, $password) {
        $sql = "SELECT * FROM user WHERE `email` = '". $email ."' AND `password` = '". $password ."'";
        $result = $this->con->query($sql);
        
        $user = new User();
        if ($result->num_rows > 0){
            $result = $result->fetch_assoc();
            $user->id = $result['id'];
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->role = $result['role'];
        }
        return $user;
    }
}


?>