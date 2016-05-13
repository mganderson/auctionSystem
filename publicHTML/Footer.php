<?php
session_start();

if (isset($_SESSION['login_user'])){
    echo '
    <div class="footer-container">
    <div class="form-text">Copyright © 2016 - Online Auction System</div>
    <div class="form-text">(Logged in as ' . $_SESSION['email'] . ')</div>
    </div>

    ';
} else{
    echo '
    <div class="footer-container">
    <div class="form-text">Copyright © 2016 - Online Auction System</div>
    <div class="form-text">(Currently logged out)</div>
    </div>
    ';
}