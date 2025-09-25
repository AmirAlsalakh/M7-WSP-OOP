<form action="index.php?get=friends" method="post">
    <button type="submit" class="search">Lägg kompis</button>
    <input type="hidden" name="firstName" value="<?php echo $friend['firstname']; ?>">
    <input type="hidden" name="surName" value="<?php echo $friend['surname']; ?>">
    <input type="hidden" name="userName" value="<?php echo $friend['username']; ?>">
    <input type="hidden" name="uid2" value="<?php echo $friend['uid']; ?>">
</form>