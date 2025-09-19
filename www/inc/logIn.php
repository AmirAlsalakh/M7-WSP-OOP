<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../model/DbEgyTalk.php';
$DbEgyTalk = new DbEgyTalk;

if (!empty($_POST)) {
    $username = $_POST['userName'] ?? "";
    $password = $_POST['password'] ?? "";

    $user = $DbEgyTalk->logIn($username, $password);

    if ($user) {
        session_regenerate_id(true);

        $_SESSION['uid'] = true;
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        header("Location: index.php");
    } else {
        header("Location: index.php?type=login");
    }
}
?>

<aside>
    <img src="/images/mobile.png" alt="Mobiltelefon" width="240" />
</aside>

<section>
    <h2>Logga in till EGY Talk</h2>
    <form method="post">
        <label for="usr">Användarnamn</label>
        <input id="usr" type="text" name='userName' required />

        <label for="pwd">Lösenord</label>
        <input id="pwd" type="password" name='password' required />

        <input type="submit" value="Logga in" />
    </form>
    <p class="center">eller</p>
    <button onclick="location.href='index.php?type=signUp'">Registrera</button>
</section>