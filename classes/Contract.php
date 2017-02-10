<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 2/29/16
 * Time: 10:52 PM
 */
class Contract
{

    private $contractPK;
    private $title;
    private $auctionFK;
    private $consumerFK;
    private $serviceProviderFK;
    private $contractPrice;
    private $deadline;
    private $statusPerConsum;
    private $statusPerSP;
    private $disputedByConsum;
    private $disputedBySP;

    /**
     * Contract constructor.
     * @param $contractPK
     * @param $title
     * @param $auctionFK
     * @param $consumerFK
     * @param $serviceProviderFK
     * @param $contractPrice
     * @param $deadline
     * @param $statusPerConsum
     * @param $statusPerSP
     * @param $disputedPerConsum
     * @param $disputedPerSP
     */
    public function __construct($assocArray)
    {
        $this->contractPK = $assocArray['contractPK'];
        $this->title = $assocArray['title'];
        $this->auctionFK = $assocArray['auctionFK'];
        $this->consumerFK = $assocArray['consumerFK'];
        $this->serviceProviderFK = $assocArray['serviceProviderFK'];
        $this->contractPrice = $assocArray['contractPrice'];
        $this->deadline = $assocArray['deadline'];
        $this->statusPerConsum = $assocArray['statusPerConsum'];
        $this->statusPerSP = $assocArray['statusPerSP'];
        $this->disputedByConsum = $assocArray['disputedByConsum'];
        $this->disputedBySP = $assocArray['disputedBySP'];
    }


    function displayContractHTML()
    {

        $formattedDeadline = date("F j, Y, g:i a", $this->deadline);

        if ($this->statusPerConsum == 1 and $this->statusPerSP == 1){
            $formattedCompletionStatus = "Job complete!";
        }
        else if($this->statusPerConsum == 1 and $this->statusPerSP == 0){
            $formattedCompletionStatus = "Consumer reports job complete; Service Provider reports job incomplete";
        }
        else if($this->statusPerConsum == 0 and $this->statusPerSP == 1){
            $formattedCompletionStatus = "Consumer reports job incomplete; Service Provider reports job complete";
        }
        else {
            $formattedCompletionStatus = "Job incomplete";
        }

        if($this->disputedByConsum==1){
            $formattedDispute = "
                                <br/>
                                <img src='../images/alert-128.png'>
                                <br/>
                                <b>This job is flagged as DISPUTED by the consumer</b>
                                ";
        }
        elseif($this->disputedBySP==1){
            $formattedDispute = "
                                <br/>
                                <img src='../images/alert-128.png'>
                                <br/>
                                <b>This job is flagged as DISPUTED by the service provider</b>
                                ";
        }
        elseif($this->disputedBySP==1 and $this->disputedByConsum==1){
            $formattedDispute = "
                                <br/>
                                <img src='../images/alert-128.png'>
                                <br/>
                                <b>This job is flagged as DISPUTED by the consumer</b>
                                <b>This job is flagged as DISPUTED by the service provider</b>
                                ";
        }
        else{
            $formattedDispute = "";
        }

        return "
                <div style=\"text-align:center;\">
                <h2>$this->title</h2>
                </div>
                <b>Job status: </b> $formattedCompletionStatus<br/>
                <b>Job deadline: </b> $formattedDeadline<br/>
                <b>Job ID: </b> $this->contractPK<br/>
                $formattedDispute
                ";
    }

    /**
     * @return mixed
     */
    public function getConsumerFK()
    {
        return $this->consumerFK;
    }

    /**
     * @return mixed
     */
    public function getServiceProviderFK()
    {
        return $this->serviceProviderFK;
    }

    /**
     * @return mixed
     */
    public function getContractPK()
    {
        return $this->contractPK;
    }

    /**
     * @return mixed
     */
    public function getAuctionFK()
    {
        return $this->auctionFK;
    }

    /**
     * @return mixed
     */
    public function getDisputedByConsum()
    {
        return $this->disputedByConsum;
    }

    /**
     * @param mixed $disputedByConsum
     */
    public function setDisputedByConsum($disputedByConsum)
    {
        $this->disputedByConsum = $disputedByConsum;
    }

    /**
     * @return mixed
     */
    public function getDisputedBySP()
    {
        return $this->disputedBySP;
    }

    /**
     * @param mixed $disputedBySP
     */
    public function setDisputedBySP($disputedBySP)
    {
        $this->disputedBySP = $disputedBySP;
    }










}
