<form action="index.php?get=removeFriend" method="post">
    <button type="submit" class="search">Radera Kompis</button>
    <input type="hidden" name="friendFirstName" value="<?php echo $friend['firstname']; ?>">
    <input type="hidden" name="friendSurName" value="<?php echo $friend['surname']; ?>">
    <input type="hidden" name="friendUserName" value="<?php echo $friend['username']; ?>">
    <input type="hidden" name="friendUid" value="<?php echo $friend['uid2']; ?>">
</form>