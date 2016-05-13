<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 2/29/16
 * Time: 10:46 PM
 */
class Bid
{
    private $bidID;
    private $auctionID;
    private $bidOwner;
    private $bidAmt;
    private $dateCreated;

    /**
     * Bid constructor.
     * @param $assocArray
     */
    public function __construct($assocArray)
    {
        $this->bidID = $assocArray['bidPK'];
        $this->auctionID = $assocArray['auctionFK'];
        $this->bidOwner = $assocArray['bidOwnerFK'];
        $this->bidAmt = $assocArray['bidAmt'];
        $this->dateCreated = $assocArray['dateCreated'];
    }

    /**
     * @return string
     */
    function displayBidHTML()
    {

        $formattedCreationDate = date("F j, Y, g:i a", $this->dateCreated) . " UTC";

        return "
                <div style=\"text-align:center;\">
                <h2>You bid $$this->bidAmt</h2>
                </div>
                <b>Bid time and date:</b> $formattedCreationDate<br/>
                <b>Bid ID:  </b>$this->bidID<br/>
                <b>Auction ID:  </b>$this->auctionID<br/>
                <b>Bid Owner ID:  </b>$this->bidOwner <br/>
                ";
    }

    /**
     * @return mixed
     */
    public function getBidID()
    {
        return $this->bidID;
    }

    /**
     * @param mixed $bidID
     */
    public function setBidID($bidID)
    {
        $this->bidID = $bidID;
    }

    /**
     * @return mixed
     */
    public function getAuctionID()
    {
        return $this->auctionID;
    }

    /**
     * @param mixed $auctionID
     */
    public function setAuctionID($auctionID)
    {
        $this->auctionID = $auctionID;
    }

    /**
     * @return mixed
     */
    public function getBidOwner()
    {
        return $this->bidOwner;
    }

    /**
     * @param mixed $bidOwner
     */
    public function setBidOwner($bidOwner)
    {
        $this->bidOwner = $bidOwner;
    }

    /**
     * @return mixed
     */
    public function getBidAmt()
    {
        return $this->bidAmt;
    }

    /**
     * @param mixed $bidAmt
     */
    public function setBidAmt($bidAmt)
    {
        $this->bidAmt = $bidAmt;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }



}