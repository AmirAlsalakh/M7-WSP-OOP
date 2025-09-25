<section>
    <form action="metod/saveKlotter/saveKlotterMsg.php" method="post">
        <textarea name="klotter" cols="45" rows="5" placeholder="Skriv i en text ..." required></textarea> <br>
        <input type="hidden" name="CSRFKlotterToken" value="<?php echo $_SESSION['CSRFKlotterToken']; ?>">
        <input type="submit" value="Publicera">
    </form>
</section>