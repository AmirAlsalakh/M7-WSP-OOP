<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

if (isset($_POST['friendFirstName']) && isset($_POST['friendSurName']) && isset($_POST['friendUserName']) && isset($_POST['friendUid']) && !empty($_POST['friendFirstName']) && !empty($_POST['friendSurName']) && !empty($_POST['friendUserName']) && !empty($_POST['friendUid'])) {
    $friend = $_POST;

    $check = $DbEgyTalk->checkFriend($friend);
    if ($check) {
        $DbEgyTalk->deleteFriend($friend);
        header('location: index.php?get=friends');
    } else {
        header('location: index.php?get=friends');
    }
} else {
    header('location: index.php?get=friends');
}