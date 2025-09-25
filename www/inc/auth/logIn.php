<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

if (isset($_POST['userName']) && isset($_POST['password']) && !empty($_POST['userName']) && !empty($_POST['password'])) {
    $username = $_POST['userName'] ?? "";
    $password = $_POST['password'] ?? "";

    $response = $DbEgyTalk->logIn($username, $password);

    if ($response) {
        session_regenerate_id(true);

        $_SESSION['uid'] = true;
        $_SESSION['uid'] = $response['uid'];
        $_SESSION['username'] = $response['username'];
        $_SESSION['name'] = $response['name'];

        header("Location: index.php");
    } else {
        header("Location: index.php?type=login");
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/img/mobile.php';

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/authForm.php';