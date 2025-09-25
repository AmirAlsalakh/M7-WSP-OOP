<?php
echo ("<h1>" . $_SESSION['name'] .  " TALK <p>");
echo ("<h1> Posta en ny TALK-tråd<p>");
echo ("<br>");
echo ("<body>");
include $_SERVER['DOCUMENT_ROOT'] . '/../inc/klotterplank/klotterPlank.php';
echo ("</body>");