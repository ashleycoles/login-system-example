<?php

require_once 'src/LoginSessionHandler.php';

$loginSessionHandler = new LoginSessionHandler();

if ($loginSessionHandler->isUserLoggedIn()) {
    header('Location: login.php');
}

$loginSessionHandler->logout();

header('Location: login.php');