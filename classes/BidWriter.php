<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/11/16
 * Time: 10:27 PM
 */
class BidWriter
{
    private $auctionFK;
    private $bidOwnerFK;
    private $bidAmt;

    /**
     * BidWriter constructor.
     * @param $auctionFK
     * @param $bidOwnerFK
     * @param $bidAmt
     */
    public function __construct($auctionFK, $bidOwnerFK, $bidAmt)
    {
        $this->auctionFK = $auctionFK;
        $this->bidOwnerFK = $bidOwnerFK;
        $this->bidAmt = $bidAmt;
    }

    /**
     * @param $conn
     * @return bool
     */

    public function writeToDatabase($conn){
        //Database connection $conn must be active
        //Main method must include dbConnect.php
        //Prepare and bind prepare SQL query
        $stmt = $conn->prepare("INSERT INTO auction_system.Bid (auctionFK, bidOwnerFK, bidAmt, dateCreated)
                VALUES (?, ?, ?, UNIX_TIMESTAMP())");
        $stmt->bind_param("iii",
            $this->auctionFK,
            $this->bidOwnerFK,
            $this->bidAmt);
        //execute query
        if($stmt->execute()) {
            $auctionFK = $this->auctionFK;
            $newBidPK = $conn->insert_id;
            //TEST SECTION!
            $sql = "UPDATE auction_system.Auction SET lowBidFK=$newBidPK WHERE auctionPK=$auctionFK";
            if ($conn->query($sql) === TRUE) {
                return $newBidPK;
            }
            else{
                echo "Error updating record: " . $conn->error;
            }

            //END TEST SECTION

        }
        else{
            return false;
        }

    }

    public function getNewBidPK($conn){
        return $conn->insert_id;
    }


}