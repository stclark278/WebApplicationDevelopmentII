<?php
require 'model/database.php';
require 'model/VideoGame.php';
require 'model/VideoGameRating_db.php';
require 'utility/functions.php';
require 'model/fields.php';
require 'model/validate.php';
require 'model/login_db.php';

// create validate object
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('video-game-title');
$fields->addField('type-of-game');
$fields->addField('platform');
$fields->addField('video-game-rating');
$fields->addField('metacritic-user-rating');
$fields->addField('ign-rating');
$fields->addField('gamespot-rating');
$fields->addField('composite-rating');

// add fields for email form
$fields->addField('name');
$fields->addField('email');
$fields->addField('company-name');
$fields->addField('country');
$fields->addField('comment');

// start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 7;           // 1 week in seconds

session_set_cookie_params($lifetime, '/');
session_start();

// create a session log array is one does not exist
if (empty($_SESSION['log'])) {
    $_SESSION['log'] = array();
}

if (!empty($_POST)) {
    $_POST = array_map('trim', $_POST);
}

if (isset($_POST['action'])) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
} elseif (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
} else {
    $action = 'list-VideoGames';
}

if($action === 'list-VideoGames') {
    $videoGames = VideoGameDB::getAllVideoGames();
    $pageTitle = 'List Video Games';
    include 'view/VideoGameRating_list.php';
} elseif ($action === 'show-add-video-game') {
    $pageTitle = 'Add Video Game';
    include 'view/VideoGameRating_add.php';
} elseif ($action === 'add-video-game') {
    $videoGameTitle = filter_input(INPUT_POST, 'video-game-title');
    $typeOfGame = filter_input(INPUT_POST, 'type-of-game');
    $platform = filter_input(INPUT_POST, 'platform');
    $videoGameRating = filter_input(INPUT_POST, 'video-game-rating');
    $metacriticUserRating = filter_input(INPUT_POST, 'metacritic-user-rating');
    $ignRating = filter_input(INPUT_POST, 'ign-rating');
    $gamespotRating = filter_input(INPUT_POST, 'gamespot-rating');
    $compositeRating = filter_input(INPUT_POST, 'composite-rating');

    $validate->text('video-game-title', $videoGameTitle, true, 1, 75);
    $validate->text('type-of-game', $typeOfGame, true, 1, 50);
    $validate->text('platform', $platform, true, 1, 50);
    $validate->pattern('video-game-rating', $videoGameRating, '/^(E|E10\+|T|M|AO|RP)$/', 'Please choose a rating of E, E10+, T, M, AO, or RP for the video game.');
    $validate->pattern('metacritic-user-rating', $metacriticUserRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('ign-rating', $ignRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('gamespot-rating', $gamespotRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('composite-rating', $compositeRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');

    if ($fields->hasErrors()) {
        $error = 'All fields in the Add Video Game form must contain data.  Please ensure all form elements contain appropriate values.';
        logErrorMessage($error);
        $pageTitle = 'Add Video Game';
        $videoGameTitleError = $fields->getField('video-game-title')->getHTML();
        $typeOfGameError = $fields->getField('type-of-game')->getHTML();
        $platformError = $fields->getField('platform')->getHTML();
        $videoGameRatingError = $fields->getField('video-game-rating')->getHTML();
        $metacriticUserRatingError = $fields->getField('metacritic-user-rating')->getHTML();
        $ignRatingError = $fields->getField('ign-rating')->getHTML();
        $gamespotRatingError = $fields->getField('gamespot-rating')->getHTML();
        $compositeRatingError = $fields->getField('composite-rating')->getHTML();
        include 'view/VideoGameRating_add.php';
    } else {
        $videoGame = new VideoGame($videoGameTitle, $typeOfGame, $platform, $videoGameRating, $metacriticUserRating, $ignRating, $gamespotRating, $compositeRating);
        VideoGameDB::addVideoGame($videoGame);
        $videoGames = VideoGameDB::getAllVideoGames();
        $pageTitle = 'List Video Games';
        header('Location:.');
    }
} elseif ($action === 'show-update-video-game') {
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $videoGame = VideoGameDB::getVideoGameInfo($id);
    $pageTitle = 'Update Video Game';
    include 'view/VideoGameRating_update.php';
} elseif ($action === 'update-video-game') {
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $videoGameTitle = filter_input(INPUT_POST, 'video-game-title');
    $typeOfGame = filter_input(INPUT_POST, 'type-of-game');
    $platform = filter_input(INPUT_POST, 'platform');
    $videoGameRating = filter_input(INPUT_POST, 'video-game-rating');
    $metacriticUserRating = filter_input(INPUT_POST, 'metacritic-user-rating');
    $ignRating = filter_input(INPUT_POST, 'ign-rating');
    $gamespotRating = filter_input(INPUT_POST, 'gamespot-rating');
    $compositeRating = filter_input(INPUT_POST, 'composite-rating');

    $validate->text('video-game-title', $videoGameTitle, true, 1, 75);
    $validate->text('type-of-game', $typeOfGame, true, 1, 50);
    $validate->text('platform', $platform, true, 1, 50);
    $validate->pattern('video-game-rating', $videoGameRating, '/^(E|E10\+|T|M|AO|RP)$/', 'Please choose a rating of E, E10+, T, M, AO, or RP for the video game.');
    $validate->pattern('metacritic-user-rating', $metacriticUserRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('ign-rating', $ignRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('gamespot-rating', $gamespotRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');
    $validate->pattern('composite-rating', $compositeRating, '/^([0-9]\.[0-9]|10.0)$/', 'Please enter a number between 0.0 and 10.0 including one decimal place.');

    if ($fields->hasErrors()) {
        $error = 'All fields in the Update Video Game form must contain data.  Please ensure all form elements contain appropriate values.';
        logErrorMessage($error);
        $videoGame = VideoGameDB::getVideoGameInfo($id);
        $pageTitle = 'Update Video Game';
        $videoGameTitleError = $fields->getField('video-game-title')->getHTML();
        $typeOfGameError = $fields->getField('type-of-game')->getHTML();
        $platformError = $fields->getField('platform')->getHTML();
        $videoGameRatingError = $fields->getField('video-game-rating')->getHTML();
        $metacriticUserRatingError = $fields->getField('metacritic-user-rating')->getHTML();
        $ignRatingError = $fields->getField('ign-rating')->getHTML();
        $gamespotRatingError = $fields->getField('gamespot-rating')->getHTML();
        $compositeRatingError = $fields->getField('composite-rating')->getHTML();
        include 'view/VideoGameRating_update.php';
    } else {
        $videoGame = new VideoGame($videoGameTitle, $typeOfGame, $platform, $videoGameRating, $metacriticUserRating, $ignRating, $gamespotRating, $compositeRating);
        $videoGame->setID($id);
        VideoGameDB::updateVideoGame($videoGame);
        $videoGames = VideoGameDB::getAllVideoGames();
        $pageTitle = 'List Video Games';
        header('Location:.');
    }
} elseif ($action === 'show-delete-video-game') {
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $videoGame = VideoGameDB::getVideoGameInfo($id);
    $pageTitle = 'Delete Video Game';
    include 'view/VideoGameRating_delete.php';
} elseif ($action === 'delete-video-game') {
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $videoGame = VideoGameDB::getVideoGameInfo($id);
    $videoGameTitle = $videoGame->getVideoGameTitle();
    VideoGameDB::deleteVideoGame($id, $videoGameTitle);
    $videoGames = VideoGameDB::getAllVideoGames();
    $pageTitle = 'List Video Games';
    header('Location:.');
} elseif ($action === 'clear-message') {
    header('Location:.');
} elseif ($action === 'empty-log') {
    unset($_SESSION['log']);
    header('Location:.');
} elseif ($action === 'end-session') {
    // clear session data from memory by setting it equal to an empty array
    $_SESSION = array();

    // clean up session ID
    session_destroy();

    // delete the cookie from the session by changing expiration date to a past date
    $name = session_name();                         // get the name of the session cookie
    $expire = strtotime('-1 year');            // create expiration date in the past
    $params = session_get_cookie_params();
    $path = $params['path'];
    $domain = $params['domain'];
    $secure = $params['secure'];
    $httponly = $params['httponly'];
    setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
    header('Location:.');
} else if ($action === 'show-login-form') {
    $pageTitle = 'Log In';
    include 'view/login.php';
} else if ($action === 'show-register-form') {
    $pageTitle = 'Create Account';
    include 'view/register.php';
} else if ($action === 'register') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        $errorUsername = 'Please enter a username.';
    } else if (checkUsername($username) === true) {
        $errorUsername = 'This username is already taken.';
    } else {
        if (strlen($username) < 5) {
            $errorUsername = 'The username must have at least 5 characters.';
        }
    }

    if (empty($password)) {
        $errorPassword = 'Please enter a password.';
    } else {
        if (strlen($password) < 9) {
            $errorPassword = 'The password must have at least 9 characters.<br>';
        }
        if (!preg_match('/[[:lower:]]/', $password)) {
            $errorPassword .= 'The password must contain a lowercase letter.<br>';
        }
        if (!preg_match('/[[:upper:]]/', $password)) {
            $errorPassword .= 'The password must contain an uppercase letter.<br>';
        }
        if (!preg_match('/[[:digit:]]/', $password)) {
            $errorPassword .= 'The password must contain a number.<br>';
        }
        if (!preg_match('/[!@#%&|?]/', $password)) {
            $errorPassword .= 'The password must contain one of the following special characters: <strong>!@#%&|?</strong> .<br>';
        }
    }

    if (empty($confirmPassword)) {
        $errorConfirmPassword = 'Please confirm the password.';
    } else if ($confirmPassword !== $password) {
        $errorConfirmPassword = 'The passwords that were entered did not match.';
    }

    if (empty($errorUsername) && empty($errorPassword) && empty($errorConfirmPassword)) {
        $userIP = $_SERVER['REMOTE_ADDR'];
        if (registerUser($username, $password, $userIP)) {
            header('Location:.?action=show-login-form');
        } else {
            $pageTitle = 'Create Account';
            include 'view/register.php';
        }
    } else {
        $pageTitle = 'Create Account';
        logErrorMessage('The account could not be created.  Please see the error(s) below.');
        include 'view/register.php';
    }
} else if ($action === 'log-in') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        $errorUsername = 'Please enter your username.';
    } else if (checkUsername($username) === false) {
        $errorUsername = 'No account found with that username.';
    } else {
        if (empty($password)) {
            $errorPassword = 'Please enter your password.';
        } else if (isValidLogin($username, $password) === false) {
            $errorPassword = 'The password is incorrect';
        }
    }
    if (empty($errorUsername) && empty($errorPassword)) {
        session_start();
        $_SESSION['username'] = $username;
        header('Location:.');
    } else {
        $pageTitle = 'Log In';
        logErrorMessage('Unsuccessful log in attempt.  Please see the error(s) below.');
        include 'view/login.php';
    }
} else if ($action === 'log-out') {
    session_start();
    $_SESSION = array();
    session_destroy();
    session_start();
    logSuccessMessage('You have successfully logged out.');
    header('Location:.');
    exit();
} else if ($action === 'show-email-form') {
    $pageTitle = 'Send Message';
    include 'view/email.php';
} else if ($action === 'send-email') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $companyName = filter_input(INPUT_POST, 'company-name', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

    $validate->text('name', $name, true, 1, 50);
    $validate->email('email', $email, true);
    $validate->text('company-name', $companyName, true, 1, 100);
    $validate->dropdown('country', $country, "Please select a country from the dropdown.  If your country is not in the list please add it in your comments below.", true);
    $validate->text('comment', $comment, true);

    if ($fields->hasErrors()) {
        $error = 'All fields in the Contact form must contain data.  Please ensure all form elements contain appropriate values';
        logErrorMessage($error);
        $nameError = $fields->getField('name')->getHTML();
        $emailError = $fields->getField('email')->getHTML();
        $companyNameError = $fields->getField('company-name')->getHTML();
        $countryError = $fields->getField('country')->getHTML();
        $commentError = $fields->getField('comment')->getHTML();
        $pageTitle = 'Send Message';
        include 'view/email.php';
    } else {
        // set $to variable to email address to receive the email
        $to = "Steven Clark <steven.clark87@trojans.dsu.edu>";
        // set a $subject variable of the email message
        $subject = "Comment from $name";
        // set a $message variable equal to the table that contains the information entered in the form, using mailto: to create a link to their email address
        $message = "
        <table>
            <tr><th>Name:</th><td>$name</td></tr>
            <tr><th>Email:</th><td><a href='mailto:$email'>$email</a></td></tr>
            <tr><th>Company Name:</th><td>$companyName</td></tr>
            <tr><th>Country:</th><td>$country</td></tr>
            <tr><th>Comment:</th><td>" . nl2br($comment) . "</td></tr>
        </table>";
        // create a $header variable with the needed header information to send an email
        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1\n";
        $headers .= "From: $name <$email>\n";
        $result = mail($to, $subject, $message, $headers);
        logSuccessMessage('The email was successfully sent');
        $pageTitle = 'Message Sent';
        include 'view/email.php';
    }
} else {
    $error = "The <strong>$action</strong> action was not handled in the code.";
    logErrorMessage($error);
    $videoGames = VideoGameDB::getAllVideoGames();
    $pageTitle = 'Code Error';
    header('Location:.');
}