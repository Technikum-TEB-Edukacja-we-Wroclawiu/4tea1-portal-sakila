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


// Pobieranie obsady
$sql = "SELECT a.actor_id, a.first_name, a.last_name FROM actor AS a JOIN film_actor AS fa USING(actor_id) WHERE fa.film_id = '{$id}'";
$r = mysqli_query($db, $sql);
$cast = mysqli_fetch_all($r, MYSQLI_ASSOC); // pobieram OD RAZU całość wyników z bazy do tablicy asocjacyjnej




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

    <h3>Obsada</h3>
    <h4>Pobranie danych - wersja 1</h4>
    <ul>
        <!-- OBIE WERSJE SĄ RÓWNOWAŻNE -->
        
        <!-- WERSJA 1 -->
        <?php foreach ($cast as $actor): ?>
            <li><a href="actor.php?id=<?= $actor['actor_id'] ?>"><?= $actor['first_name'] ?> <?= $actor['last_name'] ?></a></li>
        <?php endforeach; ?>
    </ul>

    <h4>Pobranie danych - wersja 2</h4>
    <ul>
        <!-- WERSJA 2 -->
        <?php
        foreach ($cast as $actor) {
            echo ("<li><a href='actor.php?id={$actor['actor_id']}'>{$actor["first_name"]} {$actor["last_name"]}</a></li>");
        }
        ?>
    </ul>
</body>

</html>