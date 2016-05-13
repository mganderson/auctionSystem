<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/6/16
 * Time: 4:19 PM
 */

include_once '../classes/dbConnect.php';

print_r($_POST);

/*
 * Query www.zipcodeapi.com to get list of zip codes within radius of user zip
 * Query database for auctions where auction zip code matches zip codes returned by www.zipcodeapi.com
 * Construct Auction object for each result of DB query
 * Display
 */
