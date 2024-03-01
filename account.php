<?php

require_once 'src/LoginSessionHandler.php';
require_once 'src/connectToDb.php';
require_once 'src/Models/UserModel.php';

$loginSessionHandler = new LoginSessionHandler();
$loginSessionHandler->redirectIfLoggedOut();

$uid = $loginSessionHandler->getCurrentUserId();

$db = connectToDb();
$userModel = new UserModel($db);

$user = $userModel->getById($uid);

?>

<h1>Account page for <?php echo $user->username; ?></h1>

<p><?php echo $user->bio; ?></p>

<a href="logout.php">Logout</a>