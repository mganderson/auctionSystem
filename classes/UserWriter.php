<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 4/4/16
 * Time: 6:41 PM
 */
class userWriter
{
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
     * @param $password
     */
    public function __construct($firstName, $lastName, $address1, $address2, $city, $state, $zip, $email, $password)
    {
        //$this->userID = $numericArray[0]; not necessary, autoincremented by database
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->email = $email;
        $this->rating = null;
        $this->suspended = 0;
        $this->hashedPassword = md5($password);
    }

    public function __toString()
    {
        return "userID: $this->userID <br/> firstName: $this->firstName <br/> lastName: $this->lastName <br/>
                address1: $this->address1  <br/> address2: $this->address2  <br/> city: $this->city  <br/>
                state: $this->state  <br/> zip: $this->zip  <br/> email: $this->email  <br/> rating: $this->rating
                 <br/> suspended: $this->suspended <br/> hashedPassword: $this->hashedPassword";
    }

    public function __writeToDatabase($conn){
        //Database connection $conn must be active
        //Main method must include dbConnect.php
        //Prepare and bind prepare SQL query
        $stmt = $conn->prepare("INSERT INTO auction_system.User (firstName,lastName, address1, address2, city, state,
                zip, email, rating, suspended, hashedPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssiis", $this->firstName, $this->lastName, $this->address1, $this->address2,
            $this->city, $this->state, $this->zip, $this->email, $this->rating, $this->suspended,
            $this->hashedPassword);

        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }



}
