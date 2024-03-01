<?php

require_once 'src/LoginSessionHandler.php';
require_once 'src/Entities/User.php';
require_once 'src/connectToDb.php';
require_once 'src/Models/UserModel.php';

$loginSessionHandler = new LoginSessionHandler();

if ($loginSessionHandler->isUserLoggedIn()) {
    header('Location: account.php');
}

if (isset($_POST['submit'])) {
    $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $user = new User($_POST['username'], $hashedPassword, $_POST['bio']);

    $db = connectToDb();
    $userModel = new UserModel($db);

    if (
            $userModel->isUsernameUnique($user->username) &&
            $userModel->addUser($user)
    ) {
        $createdUser = $userModel->getByUsername($user->username);
        $loginSessionHandler->setLoggedIn($createdUser->id);

        header('Location: account.php');
    } else {
        $error = 'Sorry, username already taken';
    }
}

?>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" />

    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio"></textarea>

    <input type="submit" name="submit" value="Sign up" />
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
</form>
