<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

echo ('<h1> Dina kompisar: <h1> <br>');

if (!empty($_POST['uid2'])) {
    $post = $_POST;

    $check = $DbEgyTalk->checkFriend($post);
    if ($check) {
        $getFriend = $DbEgyTalk->insertFriend($post);
    }else{
        header('location: index.php?get=friends');
    }
}

$friends = $DbEgyTalk->selectFriend();

if (count($posts) === 0) {
    echo "<p>Du har inga kompisar ännu.</p>";
} else {
    foreach ($friends as $friend) {
        echo "<p>Kompis:</p>";

        echo "<p>Förnamn: " . htmlspecialchars($friend['firstname']) . "</p>";

        echo "<p>Efternamn: " . htmlspecialchars($friend['surname']) . "</p>";

        echo "<p>Användarnamn: " . htmlspecialchars($friend['username']) . "</p>";

        echo "----------------------------------------------<br>";
    }
}