<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

if (isset($_POST['firstName']) && isset($_POST['surName']) && isset($_POST['userName']) && isset($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['surName']) && !empty($_POST['userName']) && !empty($_POST['password'])) {
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
    $surName = filter_input(INPUT_POST, 'surName', FILTER_SANITIZE_SPECIAL_CHARS);
    $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = $DbEgyTalk->signUp($firstName, $surName, $userName, $password);

    if ($result) {
        header('Location: index.php?type=signUp');
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo "<p>Kunde inte lägga till användaren. Kontrollera användarnamnet</p>";
        echo "<a href = 'index.php?type=signUp'>Försök igen</a>";
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/img/mobile.php';

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/signAuthForm.php';