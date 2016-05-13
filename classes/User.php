<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 2/29/16
 * Time: 10:45 PM
 */
class user
{
    private $userID;
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
     * user constructor.
     * @param $userID
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
     */
    public function __construct($numericArray)
    {
        $this->userID = $numericArray[0];
        $this->firstName = $numericArray[1];
        $this->lastName = $numericArray[2];
        $this->address1 = $numericArray[3];
        $this->address2 = $numericArray[4];
        $this->city = $numericArray[5];
        $this->state = $numericArray[6];
        $this->zip = $numericArray[7];
        $this->email = $numericArray[8];
        $this->rating = $numericArray[9];
        $this->suspended = $numericArray[10];
        $this->hashedPassword = $numericArray[11];
    }

    function __toString()
    {
        return "userID: $this->userID <br/> firstName: $this->firstName <br/> lastName: $this->lastName <br/>
                address1: $this->address1  <br/> address2: $this->address2  <br/> city: $this->city  <br/>
                state: $this->state  <br/> zip: $this->zip  <br/> email: $this->email  <br/> rating: $this->rating
                 <br/> suspended: $this->suspended <br/> suspended: $this->hashedPassword";
    }

    function __writeToDatabase($conn){
        //Database connection $conn must be active
        //Main method must include dbConnect.php
        $stmt = $conn->prepare("INSERT INTO auction_system.User (firstName,lastName, address1, address2, city, state,
                zip, email, rating, suspended, hashedPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssiis", $this->firstName, $this->lastName, $this->address1, $this->address2,
            $this->city, $this->state, $this->zip, $this->email, $this->rating, $this->suspended,
            $this->hashedPassword);
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    /**
     * @param mixed $suspended
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    }

    /**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @param mixed $hashedPassword
     */
    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }






}