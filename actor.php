<?php

/*
- [ ] Sprawdź, czy jest ID - jeśli nie, to ->actors.php
- [ ] Wyślij zapytanie do bazy danych, które pobierze jednego aktora
- [ ] Jeśli nie przyszedł tylko jeden aktor z bazy, to ->actors.php
- [ ] Pobierz dane o aktorze
- [ ] Chwilowo zakomentuj część o obsadzie, później przerobisz
- [ ] Wyświetl podstawowe informacje o aktorze w h1: imię i nazwisko
- [ ] Ogarnij pobranie z bazy danych id i tytułów filmów, w których wyświetlany aktor brał udział
- [ ] Wyświetl w formie listy `ul`
*/

if (!isset($_GET['id'])) {
    header('Location: actors.php');
    exit(1);
}

require_once('db.php');

$id = intval($_GET['id']);
$sql = "SELECT actor_id, first_name, last_name FROM actor WHERE actor_id='$id'";
$r = mysqli_query($db, $sql);

if (mysqli_num_rows($r) != 1) {
    header('Location: actors.php');
    exit(2);
}

$actor = mysqli_fetch_array($r);

$sql = "SELECT f.film_id, f.title FROM film AS f JOIN film_actor AS fa USING(film_id) WHERE fa.actor_id = '$id'";
$r = mysqli_query($db, $sql);
$films = mysqli_fetch_all($r, MYSQLI_ASSOC);
$num_films = mysqli_num_rows($r);

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $actor['first_name'] ?> <?= $actor['last_name'] ?> | Portal Sakila</title>
</head>

<body>
    <h1><?= $actor['first_name'] ?> <?= $actor['last_name'] ?></h1>

    <p>Liczba filmów z udziałem <?= $actor['first_name'] ?>: <?= $num_films ?></p>

    <ul>
        <?php foreach($films as $film) {
            echo("<li><a href='film.php?id=$film[film_id]'>$film[title]</a></li>");
        }
        ?>
    </ul>

</body>

</html>