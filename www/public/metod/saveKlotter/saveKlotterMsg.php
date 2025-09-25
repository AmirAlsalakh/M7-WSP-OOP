<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

session_start();

if (isset($_POST['CSRFKlotterToken']) && !empty($_POST['CSRFKlotterToken'])) {
    if ($_SESSION['CSRFKlotterToken'] === $_POST['CSRFKlotterToken']) {

        $klotter = $_POST['klotter'];
        $klotter = htmlspecialchars($klotter);

        $save = $DbEgyTalk->saveKlotterMessages($klotter);

        header("location: ../../index.php?");
    } else {
        header("location: ../../blockerad.php");
    }
} else {
    header('location: ../../index.php');
}