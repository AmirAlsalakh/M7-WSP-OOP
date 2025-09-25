<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

echo ('<h1> Dina kompisar: <h1> <br>');

if (isset($_POST['firstName']) && isset($_POST['surName']) && isset($_POST['userName']) && isset($_POST['uid2']) && !empty($_POST['firstName']) && !empty($_POST['surName']) && !empty($_POST['userName']) && !empty($_POST['uid2'])) {
    $friend = $_POST;

    $checkFriend = $DbEgyTalk->checkFriend($friend);
    if ($checkFriend) {
        $DbEgyTalk->insertFriend($friend);
    } else {
        header('location: index.php?get=friends');
    }
}

$friends = $DbEgyTalk->selectFriends();

if (count($friends) === 0) {
    echo "Du har inga kompisar ännu.";
} else {
    foreach ($friends as $friend) {
        echo "<p>Kompis:</p>";

        echo "<p>Förnamn: " . htmlspecialchars($friend['firstname']) . "</p>";

        echo "<p>Efternamn: " . htmlspecialchars($friend['surname']) . "</p>";

        echo "<p>Användarnamn: " . htmlspecialchars($friend['username']) . "</p>";

        include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/removeFriendForm.php';

        echo "----------------------------------------------<br>";
    }
}