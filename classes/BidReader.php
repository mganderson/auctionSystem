<?php

class BidReader
{
    private $conn;

    /**
     * BidReader constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBidByBidPK($bidPK){
        $sql = "SELECT * FROM `auction_system`.`Bid` WHERE `bidPK` = $bidPK";
        $result=mysqli_query($this->conn, $sql);
        $currentBid = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentBid = new Bid($row);
            return $currentBid;
        }
        else{
            return false;
        }
    }

    /**
     * Check if a user is the owner of a bid.  Return true if UserPK matches BidOwnerFK; return false if not
     * @param $bidPK
     * @param $userPK
     * @return bool
     */
    public function checkIfBidOwner($bidPK, $userPK){
        $sql = "SELECT * FROM `auction_system`.`Bid` WHERE `bidPK` = $bidPK";
        $result=mysqli_query($this->conn, $sql);
        $bidOwnerFK = null;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentBid = new Bid($row);
            if($currentBid->getBidOwner() == $userPK){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }


}