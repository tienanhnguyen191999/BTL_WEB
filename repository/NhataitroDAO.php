<?php 
namespace Repository;

require_once('DAO.php');
use Repository\DAO;
use Model\Nhataitro;

class NhataitroDAO extends DAO 
{
    public function __construct()
    {
        $this->con = parent::getInstance()->getCon();
    }

    public function store (Nhataitro $ntt) {
        $sql = "INSERT INTO `nhataitro` (`name`, `des`) VALUES (?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ss', $ntt->name, $ntt->des); // 's' specifies the variable type => 'string'
        $stmt->execute();
    }

    public function getSelected ($id) {
        $sql = "SELECT * FROM nhataitro WHERE id =" . $id;
        $result = $this->con->query($sql);
        return $result;
    }

    public function getAll () {
        $sql = "SELECT * FROM nhataitro";
        $result = $this->con->query($sql);
        return $result;
    }

    public function update (Nhataitro $ntt) {
        $sql = "UPDATE `nhataitro` SET `name` = ?, `des` = ? WHERE (`id` = ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ssd', $ntt->name, $ntt->des, $ntt->id);
        $stmt->execute();
    }

    public function delete ($id) {
        $sql = "DELETE FROM `nhataitro` WHERE (`id` = " . $id . ")";
        $stmt = $this->con->query($sql);
    }
}
?>