<?php 
namespace Repository;

require_once('DAO.php');
use Repository\DAO;
use Model\Hoithao;

class ConferenceDAO extends DAO 
{
    public function __construct()
    {
        $this->con = parent::getInstance()->getCon();
    }

    public function store (Hoithao $ht) {
        $sql = "INSERT INTO conference (name, diadiem, thoigian, nhataitro_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sssd', $ht->name, $ht->diadiem, $ht->thoigian, $ht->nhataitro_id);
        $stmt->execute();
    }

    public function getSelected ($id) {
        $sql = "SELECT * FROM conference WHERE id =" . $id;
        $result = $this->con->query($sql);
        return $result;
    }

    public function getAll () {
        $sql = "SELECT * FROM conference";
        $result = $this->con->query($sql);
        return $result;
    }

    public function update (Hoithao $ht) {
        $sql = "DELETE FROM `conference` WHERE (`id` = " . $id . ")";
        $stmt = $this->con->query($sql);
    }

    public function delete ($id) {
        $sql = "DELETE FROM `conference` WHERE (`id` = " . $id . ")";
        $stmt = $this->con->query($sql);
    }

    public function saveRelationship ($user_id, $conference_id, $hotel_id) {
        $sql = "INSERT INTO user_conference (`user_id`, `conference_id`, `hotel_id`) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ddd', $user_id, $conference_id, $hotel_id);
        $stmt->execute();
    }
}

?>