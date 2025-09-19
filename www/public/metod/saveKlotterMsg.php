<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

session_start();

if (isset($_POST)) {
    if ($_SESSION['CSRFKlotterToken'] === $_POST['CSRFKlotterToken']) {

        $klotter = $_POST['klotter'];
        $klotter = htmlspecialchars($klotter);

        $save = $DbEgyTalk->saveKlotterMessages($klotter);

        header("location: ../index.php?");
    } else {
        header("location: ../blockerad.php");
    }
}