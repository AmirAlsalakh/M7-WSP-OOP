<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

session_start();

if (isset($_POST)) {
    if ($_SESSION['CSRFMessageToken'] === $_POST['CSRFMessageToken']) {
        
        $msg = $_POST['message'];
        $msg = htmlspecialchars($msg);

        $save = $DbEgyTalk->saveMsg($msg);

        header("location: ../index.php?get=flow");
    } else {
        header("location: ../blockerad.php");
    }
}
