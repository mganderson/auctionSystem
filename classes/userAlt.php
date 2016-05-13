<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 5/1/16
 * Time: 7:46 PM
 */
class userAlt
{
    private $userPK;
    private $firstName;
    private $lastName;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $zip;
    private $email;
    private $rating;
    private $suspended;
    private $hashedPassword;

    /**
     * userAlt constructor.
     * @param $userPK
     * @param $firstName
     * @param $lastName
     * @param $address1
     * @param $address2
     * @param $city
     * @param $state
     * @param $zip
     * @param $email
     * @param $rating
     * @param $suspended
     * @param $hashedPassword
     */
    public function __construct($assocArray)
    {
        $this->userPK = $assocArray['userPK'];
        $this->firstName = $assocArray['firstName'];
        $this->lastName = $assocArray['lastName'];
        $this->address1 = $assocArray['address1'];
        $this->address2 = $assocArray['address2'];
        $this->city = $assocArray['city'];
        $this->state = $assocArray['state'];
        $this->zip = $assocArray['zip'];
        $this->email = $assocArray['email'];
        $this->rating = $assocArray['rating'];
        $this->suspended = $assocArray['suspended'];
        $this->hashedPassword = $assocArray['hashedPassword'];
    }

    public function displayBasicUserHTML(){
        $mailLink = "mailto:" . $this->email ."?Subject=Online%20Auction%20System";
        echo    "
                <b>First name: </b> $this->firstName
                </br>
                <b>Email address: </b><a href=\"$mailLink\"> $this->email</a>
                </br>
                ";
    }


}