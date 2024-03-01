<?php

require_once 'src/LoginSessionHandler.php';

$logginSessionHandler = new LoginSessionHandler();

$logginSessionHandler->redirectIfLoggedOut();

$logginSessionHandler->logout();

header('Location: login.php');