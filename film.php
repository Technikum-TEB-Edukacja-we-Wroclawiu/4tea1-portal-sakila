<?php
// Sprawdzenie, czy przesłano ID 
// - jeśli nie, to przekierujemy na stronę z filmami.
if (!isset($_GET["id"])) {
    header("Location: films.php"); // przekieruj na stronę films.php
    exit(1); // zakończ skrypt [nieobowiązkowe]
}

include_once('db.php');

// tutaj pobieramy dane z bazy na początku skryptu zamiast w środku

$id = intval($_GET["id"]); // intval konwertuje napis na liczbę

// UWAGA: Nigdy tak nie piszemy kodu produkcyjnego. To jest podatność typu SQL Injection - można zamiast $id próbować wpisać takie dane, które zostną potraktowane jako instrukcje SQL, a nie dane.
// Należy używać mechanizmu Prepared Statements - o nim w przyszłości.
$r = mysqli_query($db, "SELECT * FROM film WHERE film_id='$id'");

// powinien przyjść 1 rekord - jeśli nie przyszedł 1, to mamy błąd
// wtedy przekierujmy (znowu) do films.php

if (mysqli_num_rows($r) != 1) {
    header("Location: films.php"); // przekieruj na stronę films.php
    exit(2); // zakończ skrypt [nieobowiązkowe]
}

// tutaj już mamy pewność, że z bazy pobrano TYLKO 1 WIERSZ
// zapisujemy go do zmiennej $film
$film = mysqli_fetch_array($r);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $film["title"] ?> | Portal Sakila</title>
</head>
<body>
    <h1><?= $film["title"] ?></h1>
    <p><?= $film["description"] ?></p>
    <p>Czas trwania: <?= $film["length"] ?> min.</p>
</body>
</html>