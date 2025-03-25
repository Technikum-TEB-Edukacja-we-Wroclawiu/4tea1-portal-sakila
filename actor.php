<?php
require_once('db.php');

// obsługa dodania aktora do filmu - jeśli wysłano formularz
if(isset($_POST['film_id'], $_POST['actor_id'])) {
    $actor_id = $_POST['actor_id'];
    $film_id = $_POST['film_id'];

    $sql = "INSERT IGNORE INTO film_actor (actor_id, film_id) VALUES ('$actor_id', '$film_id')";
    $r = mysqli_query($db, $sql);

    header("Location: actor.php?id=$actor_id");
}

// przygotowanie do wyświetlenia informacji o aktorze
if (!isset($_GET['id'])) {
    header('Location: actors.php');
    exit(1);
}


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

// Pobranie listy filmów, w których aktor NIE grał
$sql = "SELECT film_id, title FROM film WHERE film_id NOT IN (SELECT film_id FROM film_actor WHERE actor_id='$id')";
$r = mysqli_query($db, $sql);
$other_films = mysqli_fetch_all($r, MYSQLI_ASSOC);

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

    <h2>Powiązanie z nowym filmem</h2>
    <p>Dodaj tego aktora do filmu, w obsadzie którego jeszcze go nie ma.</p>
    
    <form action="" method="post">
        <select name="film_id">
            <?php foreach($other_films as $film) {
                echo("<option value='$film[film_id]'>$film[title] (id: $film[film_id])</option>");
            } ?>
        </select>
        <input type="hidden" name="actor_id" value="<?= $id ?>">
        <button type="submit">Dodaj</button>
    </form>

    <h2>Udział w filmach</h2>
    <p>Liczba filmów z udziałem <?= $actor['first_name'] ?>: <?= $num_films ?></p>

    <ul>
        <?php foreach($films as $film) {
            echo("<li><a href='film.php?id=$film[film_id]'>$film[title]</a></li>");
        }
        ?>
    </ul>

</body>

</html>