<?php 
namespace Repository;

require_once('DAO.php');
use Repository\DAO;
use Model\Khachsan;

class HotelDAO extends DAO 
{
    public function __construct()
    {
        $this->con = parent::getInstance()->getCon();
    }

    public function store (Khachsan $ks) {
        $sql = "INSERT INTO `hotel` (`name`, `des`) VALUES (?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ss', $ks->name, $ks->des); // 's' specifies the variable type => 'string'
        $stmt->execute();
    }

    public function getSelected ($id) {
        $sql = "SELECT * FROM hotel WHERE id =" . $id;
        $result = $this->con->query($sql);
        return $result;
    }

    public function getAll () {
        $sql = "SELECT * FROM hotel";
        $result = $this->con->query($sql);
        return $result;
    }

    public function update (Khachsan $ks) {
        $sql = "UPDATE `hotel` SET `name` = ?, `des` = ? WHERE (`id` = ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ssd', $ks->name, $ks->des, $ks->id);
        $stmt->execute();
    }

    public function delete ($id) {
        $sql = "DELETE FROM `hotel` WHERE (`id` = " . $id . ")";
        $stmt = $this->con->query($sql);
    }
}
?>