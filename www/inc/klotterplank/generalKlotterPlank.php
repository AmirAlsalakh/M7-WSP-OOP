<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/generalKlotterType.php';

$posts = $DbEgyTalk->selectPostsFromAll();

foreach ($posts as &$post) {
    $postPid = $post['pid'];

    $comments = $DbEgyTalk->selectAllMessages($postPid);

    $post['comments'] = $comments;
}

unset($post);

foreach ($posts as $post) {
    echo "<article>";
    echo '<p style="fontsize: 4rem;"><strong>' . $post['username'] . " " . $post['firstname'] . " " . $post['surname'] . "</strong></p>";
    echo "<p>" . $post['post_txt'] . "</p>";
    echo "<p class='time'><time>" . $post['date'] . "</time></p>";

    echo "<section>";
    include $_SERVER['DOCUMENT_ROOT'] . '/../inc/form/generalMessagePlank.php';
    echo "</section>";

    foreach ($post['comments'] as $comment) {
        echo "<p style='color: green;'><strong>" . $comment['username'] . " " . $comment['firstname'] . " " . $comment['surname'] . "</strong></p>";
        echo "<p style='color: green;'>" . $comment['comment_txt'] . "</p>";
        echo "<p class='time' style='color: green;'><time>" . $comment['date'] . "</time></p>";
        echo "<p style='color: green;'>----------------------------------</p>";
    }
    echo "</article>";
}