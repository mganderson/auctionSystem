<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/24/16
 * Time: 5:12 PM
 */

function getLowBidAmt($currentAuction, $conn){
    $bidPK = $currentAuction->getLowBid();
    if(is_null($bidPK)){
        return false;
    }
    else{
        //echo $currentAuction->toString();
        //echo "</br>bidPK: " . $bidPK;
        $sql = "SELECT * FROM auction_system.Bid
                    WHERE bidPK = $bidPK";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row);
                //print "<br/><br/> Trying to instantiate Bid object...";
                $myBidObject = new Bid($row);
                //echo $myBidObject->displayBidHTML();
                $lowBidAmt = $myBidObject->getBidAmt();
                return $lowBidAmt;
                //return $lowBidAmt;
            }
        } else {
            return false;
            //return false;
        }
    }
}

function getFormattedLowBid($currentAuction, $conn){
    $bidPK = $currentAuction->getLowBid();
    if(is_null($bidPK)){
        return "No bid received";
    }
    else{
        //echo $currentAuction->toString();
        //echo "</br>bidPK: " . $bidPK;
        $sql = "SELECT * FROM auction_system.Bid
                    WHERE bidPK = $bidPK";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row);
                //print "<br/><br/> Trying to instantiate Bid object...";
                $myBidObject = new Bid($row);
                //echo $myBidObject->displayBidHTML();
                $lowBidAmt = $myBidObject->getBidAmt();
                return "$" . $lowBidAmt . ".00";
                //return $lowBidAmt;
            }
        } else {
            return "Error in trying to get bid amount";
            //return false;
        }
    }
}