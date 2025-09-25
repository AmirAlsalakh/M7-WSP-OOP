<?php if (session_status() == PHP_SESSION_NONE)

    session_start();

$_SESSION['CSRFKlotterToken'] = bin2hex(random_bytes(32));
$_SESSION['CSRFMessageToken'] = bin2hex(random_bytes(32));

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/frontend/head.php';

echo ('<body>');
include $_SERVER['DOCUMENT_ROOT'] . '/../inc/frontend/header.php';

echo ('<main>');

if (isset($_SESSION['uid'])) {

    $get = "hem";

    if (isset($_GET['get'])) {
        $get = $_GET['get'];
    }

    if (!empty($_GET)) {
        switch ($get) {
            case 'flow':
                include('flow/index.php');
                break;
            case 'friends':
                include('friends/index.php');
                break;
            case 'preferences':
                include('preferences/index.php');
                break;
            case 'removeFriend':
                include('metod/removeFriend/index.php');
                break;
            case 'logOut':
                header("location: logOut/index.php");
                break;
            default:
            case 'searchFriends':
                include('metod/searchFriends/index.php');
                break;
            case 'user':
                include('user/index.php');
                break;
        }
    } else {
        include('user/index.php');
    }
} else {
    $type = 'signUp';

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    }

    if (!empty($_GET)) {
        switch ($type) {
            case 'logIn':
                include $_SERVER['DOCUMENT_ROOT'] . '/../inc/auth/logIn.php';
                break;
            default:
            case 'signUp':
                include $_SERVER['DOCUMENT_ROOT'] . '/../inc/auth/signUp.php';
        }
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/../inc/auth/signUp.php';
    }
}

echo ('</main>');
include $_SERVER['DOCUMENT_ROOT'] . '/../inc/frontend/footer.php';
echo ('</body>');

echo ('</html>');