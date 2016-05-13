<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/30/16
 * Time: 1:18 PM
 */
class AuctionReader
{
    private $conn;

    /**
     * AuctionReader constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAuctionByAuctionPK($auctionPK){
        $sql = "SELECT * FROM `auction_system`.`Auction` WHERE `auctionPK` = $auctionPK";
        $result=mysqli_query($this->conn, $sql);
        $currentAuction = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentAuction = new Auction($row);
            return $currentAuction;
        }
        else{
            return false;
        }
    }


}