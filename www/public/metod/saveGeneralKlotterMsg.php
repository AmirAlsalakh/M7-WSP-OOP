<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

if (isset($_POST)) {
    if ($_SESSION['CSRFKlotterToken'] === $_POST['CSRFKlotterToken']) {

        $klotter = $_POST['klotter'];
        $klotter = htmlspecialchars($klotter);

        $save = $DbEgyTalk->saveKlotterMessages($klotter);

        header("location: ../index.php?get=flow");
    } else {
        header("location: ../blockerad.php");
    }
}