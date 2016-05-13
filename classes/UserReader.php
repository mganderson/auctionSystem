<?php

class UserReader
{
    private $conn;

    /**
     * UserReader constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByUserPK($userPK){
        $sql = "SELECT * FROM `auction_system`.`User` WHERE `userPK` = $userPK";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentUser = new UserAlt($row);
            return $currentUser;
        }
        else{
            return false;
        }
    }

    public function getUserByUserEmail($userEmail){
        $sql = "SELECT * FROM `auction_system`.`User` WHERE `email` = '$userEmail'";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentUser = new UserAlt($row);
            return $currentUser;
        }
        else{
            return false;
        }
    }

    public function seeIfAccountExistsForEmail($userEmail){
        $sql = "SELECT * FROM `auction_system`.`User` WHERE `email` = '$userEmail'";
        $result=mysqli_query($this->conn, $sql);
        if($result->num_rows > 0) {
            return true;
        }
        else{
            return false;
        }
    }


}