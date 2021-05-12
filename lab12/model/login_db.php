<?php
function checkUsername($username) {
    $db = Database::getDB();
    $query = 'SELECT ID FROM UserAccountInformation WHERE USERNAME = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $success = $statement->execute();

    if ($statement->errorCode() !== 0 && $success === false) {
        $sqlError = $statement->errorInfo();
        $error = 'The query to check if a username exists did not work because: ' . $sqlError[2];
        logErrorMessage($error);
    }
    $statement->closeCursor();
    return $statement->rowCount() === 1;
}
function registerUser($username, $password, $userIP) {
    $db = Database::getDB();
    $query = 'INSERT INTO UserAccountInformation (USERNAME, PASSWORD, IP_ADDRESS) VALUES (:username, :password, :userIP)';
    $statement = $db->prepare($query);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hashedPassword);
    $statement->bindValue(':userIP', $userIP);
    $success = $statement->execute();

    if ($statement->errorCode() !== 0 && $success === false) {
        $sqlError = $statement->errorInfo();
        $error = 'The query to register a user did not work beacuse: ' . $sqlError[2];
        logErrorMessage($error);
    } else {
        $successMessage = 'The user <strong>' . $username . '</strong> was successfully registered.';
        logSuccessMessage($successMessage);
    }
    $statement->closeCursor();
    return $success;
}
function isValidLogin($username, $password) {
    $db = Database::getDB();
    $query = 'SELECT USERNAME,PASSWORD FROM UserAccountInformation WHERE USERNAME = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $success = $statement->execute();

    if ($statement->errorCode() !== 0 && $success === false) {
        $sqlError = $statement->errorInfo();
        $error = 'The query to log in a user did not work because: ' . $sqlError[2];
        logErrorMessage($error);
        $statement->closeCursor();
        return false;
    } else {
        $row = $statement->fetch();
        $hashedPassword = $row['PASSWORD'];
        $statement->closeCursor();
        if (password_verify($password, $hashedPassword)) {
            $successMessage = 'The user <strong>' . $username . '</strong> was successfully logged in.';
            logSuccessMessage($successMessage);
            return true;
        } else {
            $error = 'The password for <strong>' . $username . '</strong> is incorrect.';
            logErrorMessage($error);
            return false;
        }
    }
}