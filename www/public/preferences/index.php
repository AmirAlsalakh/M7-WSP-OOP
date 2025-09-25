<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

echo ("<p> Radera Ditt Konto: <p> <br>");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userName = $_POST['userName'];
    $userName = htmlspecialchars($userName);

    $password = $_POST['password'];

    $deleteCheck = $DbEgyTalk->checkToDeleteUser($userName, $password);

    if ($deleteCheck) {
        $DbEgyTalk->deleteUser();
        header('location: logOut/index.php');
    } else {
        header('location: index.php?get=preferences');
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/deleteAccountForm.php';