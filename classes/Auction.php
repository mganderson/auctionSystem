<?php
include "../classes/dbConnect.php";
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 2/29/16
 * Time: 10:45 PM
 */
class auction
{
    private $auctionPK;
    private $auctionOwnerFK;
    private $maxBidAmt;
    private $lowBid; #bidID of low bid
    private $title;
    private $description;
    private $category;
    private $deadline;
    private $zipcode; #location of job
    private $dateCreated;
    private $auctionLength;
    private $auctionExpiration;
    private $active;
    private $successfullyCompleted;
    private $photoRefLink;

    /**
     * auction constructor.
     * @param $auctionPK
     * @param $auctionOwnerFK
     * @param $maxBidAmt
     * @param $lowBid
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
    public function __construct($assocArray)
    {
        $this->auctionPK = $assocArray[auctionPK];
        $this->auctionOwnerFK = $assocArray[auctionOwnerFK];
        $this->maxBidAmt = $assocArray[maxBidAmt];
        $this->lowBid = $assocArray[lowBidFK];
        $this->title = $assocArray[title];
        $this->description = $assocArray[description];
        $this->category = $assocArray[category];
        $this->deadline = $assocArray[deadline];
        $this->zipcode = $assocArray[zipcode];
        $this->dateCreated = $assocArray[dateCreated];
        $this->auctionLength = $assocArray[auctionLength];
        $this->auctionExpiration = $assocArray[auctionExpiration];
        $this->active = $assocArray[active];
        $this->successfullyCompleted = $assocArray[successfullyCompleted];
        $this->photoRefLink = $assocArray[photoRefLink];
    }

    public function toString()
    {
        return "auctionPK: $this->auctionPK <br/>
                auctionOwnerFK: $this->auctionOwnerFK <br/>
                maxBidAmt: $this->maxBidAmt <br/>
                lowBid: $this->lowBid <br/>
                title: $this->title <br/>
                description: $this->description <br/>
                category: $this->category <br/>
                deadline: $this->deadline <br/>
                zipcode: $this->zipcode <br/>
                dateCreated: $this->dateCreated <br/>
                auctionLength: $this->auctionLength <br/>
                auctionExpiration: $this->auctionExpiration <br/>
                active: $this->active <br/>
                successfullyCompleted: $this->successfullyCompleted <br/>
                photoRefLink: $this->photoRefLink <br/>
                ";
    }

    function displayAuctionHTML()
    {
        $formattedLowBid = "";
        if (is_null($this->getLowBid())){
            $formattedLowBid = "None";
        }
        else {
            $formattedLowBid = $this->getLowBid();
        }

        $formattedCreationDate = date("F j, Y, g:i a", $this->dateCreated);
        $formattedAuctionExpyDate = date("F j, Y, g:i a", ($this->dateCreated + $this->auctionLength));
        $formattedJobDeadlineDate = date("F j, Y, g:i a", ($this->dateCreated + $this->auctionLength + $this->deadline));

        $formattedAuctionStatus = "";
        if ($this->active == 1){
            $formattedAuctionStatus = "Active";
        }
        else {
            $formattedAuctionStatus = "Inactive";
        }

        $formattedCompletionStatus = "";
        if ($this->active == 1){
            $formattedAuctionStatus = "Active listing";
        }
        else if($this->successfullyCompleted == 1){
            $formattedAuctionStatus = "Auction ended with successful bid(s)";
        }
        else {
            $formattedAuctionStatus = "Auction ended; no successful bid(s)";
        }

        $formattedPhoto = "";
        if (empty($this->photoRefLink)){
            $formattedPhoto = "No photo provided <br/>";
        }
        else{
            $formattedPhoto = "<br/><a href='$this->photoRefLink'><img src='$this->photoRefLink'></a>";
        }

        return "
                <div style=\"text-align:center;\">
                <h2>$this->title</h2>
                </div>
                <b>Description:  </b>$this->description<br/>
                <b>Auction ID:  </b>$this->auctionPK <br/>
                <b>Max Bid:  </b>$$this->maxBidAmt.00<br/>
                <b>Auction Category:  </b>$this->category <br/>
                <b>Auction created on: </b>$formattedCreationDate UTC <br/>
                <b>Auction ends on:  </b>$formattedAuctionExpyDate UTC<br/>
                <b>Job deadline: </b> $formattedJobDeadlineDate UTC<br/>
                <b>Job location zip:  </b> $this->zipcode <br/>
                <b>Auction status:  </b> $formattedAuctionStatus<br/>
                <b>Photo:  </b> $formattedPhoto <br/>
                ";
    }

    function displayAuctionHTMLasContractdetails()
    {

        $formattedCreationDate = date("F j, Y, g:i a", $this->dateCreated);

        $formattedPhoto = "";
        if (empty($this->photoRefLink)){
            $formattedPhoto = "No photo provided <br/>";
        }
        else{
            $formattedPhoto = "<br/><a href='$this->photoRefLink'><img src='$this->photoRefLink'></a>";
        }

        return "
                <b>Description:  </b>$this->description<br/>
                <b>Job Category:  </b>$this->category <br/>
                <b>Job location zip:  </b> $this->zipcode <br/>
                <b>Photo:  </b> $formattedPhoto <br/>
                ";
    }

    /**
     * @return mixed
     */
    public function getAuctionPK()
    {
        return $this->auctionPK;
    }

    public function getFormattedLowBid(){
        $formattedLowBid = "";
        if (is_null($this->lowBid)){
            $formattedLowBid = "No bids yet";
            return $formattedLowBid;
        }
        else {
            $formattedLowBid = "$" . $this->lowBid . ".00";
            return $formattedLowBid;
        }
    }



    /**
     * @param mixed $auctionPK
     */
    public function setAuctionPK($auctionPK)
    {
        $this->auctionPK = $auctionPK;
    }

    /**
     * @return mixed
     */
    public function getAuctionOwnerFK()
    {
        return $this->auctionOwnerFK;
    }

    /**
     * @param mixed $auctionOwnerFK
     */
    public function setAuctionOwnerFK($auctionOwnerFK)
    {
        $this->auctionOwnerFK = $auctionOwnerFK;
    }

    /**
     * @return mixed
     */
    public function getMaxBidAmt()
    {
        return $this->maxBidAmt;
    }

    /**
     * @param mixed $maxBidAmt
     */
    public function setMaxBidAmt($maxBidAmt)
    {
        $this->maxBidAmt = $maxBidAmt;
    }

    /**
     * @return mixed
     */
    public function getLowBid()
    {
        return $this->lowBid;
    }

    /**
     * @param mixed $lowBid
     */
    public function setLowBid($lowBid)
    {
        $this->lowBid = $lowBid;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param mixed $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
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

    /**
     * @return mixed
     */
    public function getAuctionLength()
    {
        return $this->auctionLength;
    }

    /**
     * @param mixed $auctionLength
     */
    public function setAuctionLength($auctionLength)
    {
        $this->auctionLength = $auctionLength;
    }

    /**
     * @return mixed
     */
    public function getAuctionExpiration()
    {
        return $this->auctionExpiration;
    }

    /**
     * @param mixed $auctionExpiration
     */
    public function setAuctionExpiration($auctionExpiration)
    {
        $this->auctionExpiration = $auctionExpiration;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getSuccessfullyCompleted()
    {
        return $this->successfullyCompleted;
    }

    /**
     * @param mixed $successfullyCompleted
     */
    public function setSuccessfullyCompleted($successfullyCompleted)
    {
        $this->successfullyCompleted = $successfullyCompleted;
    }

    /**
     * @return mixed
     */
    public function getPhotoRefLink()
    {
        return $this->photoRefLink;
    }

    /**
     * @param mixed $photoRefLink
     */
    public function setPhotoRefLink($photoRefLink)
    {
        $this->photoRefLink = $photoRefLink;
    }




}
