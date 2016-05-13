<?php
/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/28/16
 * Time: 7:01 PM
 */
session_start();
session_destroy();
header('Location: ../publicHTML/logoutSuccess.php');
