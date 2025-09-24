<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

$userName = $_GET['searchUsr'] ?? " ";
$friends = $DbEgyTalk->searchFriend($userName);

if ($friends) {
    foreach ($friends as $friend) {
        echo "<article>";
        echo '<p style="fontsize: 4rem;"><strong>' . $friend['username'] . "<br> -" . $friend['firstname'] . " " . $friend['surname'] . "</strong></p>";
?>
        <form action="index.php?get=friends" method="post">
            <button type="submit" class="search">Add friend</button>
            <input type="hidden" name="firstName" value="<?php echo $friend['firstname']; ?>">
            <input type="hidden" name="surName" value="<?php echo $friend['surname']; ?>">
            <input type="hidden" name="userName" value="<?php echo $friend['username']; ?>">
            <input type="hidden" name="uid2" value="<?php echo $friend['uid']; ?>">
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