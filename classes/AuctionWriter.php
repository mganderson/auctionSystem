<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/6/16
 * Time: 12:34 PM
 */
class AuctionWriter
{
    private $auctionOwnerFK;
    private $maxBidAmt;
    private $lowBidFK;
    private $title;
    private $description;
    private $category;
    private $deadline;
    private $zipcode;
    private $dateCreated;
    private $auctionLength;
    private $auctionExpiration;
    private $active;
    private $successfullyCompleted;
    private $photoRefLink;

    /**
     * AuctionWriter constructor.
     * @param $auctionOwnerFK
     * @param $maxBidAmt
     * @param $lowBidFK
     * @param $title
     * @param $description
     * @param $category
     * @param $deadline
     * @param $zipcode
     * @param $dateCreated
     * @param $auctionLength
     * @param $auctionExpiration
     * @param $active
     * @param $successfullyCompleted
     * @param $photoRefLink
     */
    public function __construct($auctionOwnerFK, $maxBidAmt, $title, $description, $category, $deadline,
                                $zipcode, $auctionLength, $photoRefLink)
    {
        $this->auctionOwnerFK = $auctionOwnerFK;
        $this->maxBidAmt = $maxBidAmt;
        $this->lowBidFK = null;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->deadline = $deadline; //should be stored in seconds
        $this->zipcode = $zipcode;
        //TODO change 1 to something else
        $this->dateCreated = 1; //set to current UNIX time in SQL query
        $this->auctionLength = $auctionLength;
        //TODO change 1 to something else
        $this->auctionExpiration = $this->dateCreated + $this->auctionLength; // can be calculated based on adding auction length to dateCreated
        $this->active = 1;
        $this->successfullyCompleted = 0;
        $this->photoRefLink = $photoRefLink;
    }

    public function __writeToDatabase($conn){
        //Database connection $conn must be active
        //Main method must include dbConnect.php
        //Prepare and bind prepare SQL query
        $stmt = $conn->prepare("INSERT INTO auction_system.Auction (auctionOwnerFK,maxBidAmt, lowBidFK, title,
                description, category, deadline, zipcode, dateCreated, auctionLength, auctionExpiration, active,
                successfullyCompleted, photoRefLink) VALUES (?, ?, ?, ?, ?, ?, ?, ?, UNIX_TIMESTAMP(), ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssisiiiis",
            $this->auctionOwnerFK,
            $this->maxBidAmt,
            $this->lowBidFK,
            $this->title,
            $this->description,
            $this->category,
            $this->deadline,//should be stored in seconds
            $this->zipcode,
            //$this->dateCreated,//set to current UNIX time in SQL query
            $this->auctionLength,
            $this->auctionExpiration,// this column/attribute should be deleted.  It can be caluclated using other fields
            $this->active,
            $this->successfullyCompleted,
            $this->photoRefLink);
        //execute query
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    function __toString()
    {
        return "auctionOwnerFK: $this->auctionOwnerFK <br/> maxBidAmt: $this->maxBidAmt <br/> lowBidFK: $this->lowBidFK <br/>
                title: $this->title  <br/> description: $this->description  <br/> category: $this->category  <br/>
                deadline: $this->deadline  <br/> zipcode: $this->zipcode  <br/> dateCreated: $this->dateCreated
                <br/> auctionLength: $this->auctionLength <br/> auctionExpiration: $this->auctionExpiration <br/>
                active: $this->active <br/> successfullyCompleted: $this->successfullyCompleted
                <br/> photoRefLink = $this->photoRefLink <br/>";
    }




}