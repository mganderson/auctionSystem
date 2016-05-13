<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 5/1/16
 * Time: 6:55 PM
 */
class ContractWriter
{
    private $conn;

    /**
     * ContractWriter constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateStatusPerConsum($contractPK, $statusBool){
        $conn = $this->conn;
        $sql = "UPDATE `auction_system`.`Contract`
                SET `statusPerConsum` = $statusBool
                WHERE `contractPK` = $contractPK";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStatusPerSP($contractPK, $statusBool){
        $conn = $this->conn;
        $sql = "UPDATE `auction_system`.`Contract`
                SET `statusPerSP` = $statusBool
                WHERE `contractPK` = $contractPK";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDisputedByConsum($contractPK, $statusBool){
        $conn = $this->conn;
        $sql = "UPDATE `auction_system`.`Contract`
                SET `disputedByConsum` = $statusBool
                WHERE `contractPK` = $contractPK";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDisputedBySP($contractPK, $statusBool){
        $conn = $this->conn;
        $sql = "UPDATE `auction_system`.`Contract`
                SET `disputedBySP` = $statusBool
                WHERE `contractPK` = $contractPK";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


}