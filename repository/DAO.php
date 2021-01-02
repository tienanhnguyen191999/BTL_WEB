<?php 

namespace Repository;

class DAO {
    private static $instance;
    protected $con;

    // Only can call this function one times (When init Instance)
    private function __construct()
    {
        $this->con = new \mysqli("127.0.0.1:3306", "root", "", "btl_web"); 
        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    public static function getInstance()
    {   
        if (self::$instance == null) {
            // Create connection
            self::$instance = new DAO();
        }
        return self::$instance;
    }

    public function getCon () 
    {
        return $this->con;
    }

}
    
?>