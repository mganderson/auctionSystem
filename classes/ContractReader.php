<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/28/16
 * Time: 10:40 PM
 */
class ContractReader
{
    private $contractID;
    private $conn;

    /**
     * ContractReader constructor.
     * @param $contractID
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $contractPK
     * @return Contract object || false
     */
    public function getContractByContractPK($contractPK){
        $sql = "SELECT * FROM `auction_system`.`Contract` WHERE `contractPK` = $contractPK";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentContract = new Contract($row);
            return $currentContract;
        }
        else{
            return false;
        }
    }

    public function getContractByAuctionFK($auctionFK){
        $sql = "SELECT * FROM `auction_system`.`Contract` WHERE `auctionFK` = $auctionFK ORDER BY `deadline` ASC";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentContract = new Contract($row);
            return $currentContract;
        }
        else{
            return false;
        }
    }

    /**
     * @param $OwnerPK
     * @return array of Contracts || false
     */
    public function getContractsByOwnerPK($OwnerPK){
        $sql = "SELECT * FROM `auction_system`.`Contract` WHERE `consumerFK` = $OwnerPK ORDER BY `deadline` ASC";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $contractArray = array($result->num_rows);
            $i = 0;
            while($row = $result->fetch_assoc()){
                $currentContract = new Contract($row);
                $contractArray[$i] = $currentContract;
                ++$i;
            };
            return $contractArray;
        }
        else{
            return false;
        }
    }

    public function getContractsByServiceProviderPK($spPK){
        $sql = "SELECT * FROM `auction_system`.`Contract` WHERE `serviceProviderFK` = $spPK ORDER BY `deadline` ASC";
        $result=mysqli_query($this->conn, $sql);
        $currentContract = null;
        if($result->num_rows > 0) {
            $contractArray = array($result->num_rows);
            $i = 0;
            while($row = $result->fetch_assoc()){
                $currentContract = new Contract($row);
                $contractArray[$i] = $currentContract;
                $i++;
            };
            return $contractArray;
        }
        else{
            return false;
        }
    }





}