<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

$userName = $_GET['searchUsr'] ?? " ";
$posts = $DbEgyTalk->searchFriend($userName);

if ($posts) {
    foreach ($posts as $post) {
        echo "<article>";
        echo '<p style="fontsize: 4rem;"><strong>' . $post['username'] . "<br> -" . $post['firstname'] . " " . $post['surname'] . "</strong></p>";
?>
        <form action="index.php?get=friends" method="post">
            <button type="submit" class="search">Add friend</button>
            <input type="hidden" name="firstName" value="<?php echo $post['firstname']; ?>">
            <input type="hidden" name="surName" value="<?php echo $post['surname']; ?>">
            <input type="hidden" name="userName" value="<?php echo $post['username']; ?>">
            <input type="hidden" name="uid2" value="<?php echo $post['uid']; ?>">
        </form>
<?php
        echo '---------------------------------------------------------------------------------------------------------------------------------------------------';
        echo "</article>";
    }
} else {
    $_SESSION['count'] = 0;
    echo '<p> Det finns inga tillgängliga vänner med denna namn. </p>';
}


?>