<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

$userName = $_GET['searchUsr'] ?? " ";
$friends = $DbEgyTalk->searchFriend($userName);

if ($friends) {
    foreach ($friends as $friend) {
        echo "<article>";
        echo '<p style="fontsize: 4rem;"><strong>' . $friend['username'] . "<br> -" . $friend['firstname'] . " " . $friend['surname'] . "</strong></p>";
        include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/addFriendForm.php';
        echo '---------------------------------------------------------------------------------------------------------------------------------------------------';
        echo "</article>";
    }
} else {
    $_SESSION['count'] = 0;
    echo '<p> Det finns inga tillgängliga vänner med denna namn. </p>';
}