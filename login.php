<?php

require_once 'src/LoginSessionHandler.php';
require_once 'src/connectToDb.php';
require_once 'src/Models/UserModel.php';


$loginSessionHandler = new LoginSessionHandler();
$loginSessionHandler->redirectIfLoggedIn();

if (isset($_POST['submit'])) {
    $db = connectToDb();
    $userModel = new UserModel($db);
    $user = $userModel->getByUsername($_POST['username']);

    if (!$user) {
        $error = 'Invalid username or password';
    } elseif (password_verify($_POST['password'], $user->password)) {
        $loginSessionHandler->setLoggedIn($user->id);

        header('Location: account.php');
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" />

    <input type="submit" name="submit" value="Login" />
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
</form>