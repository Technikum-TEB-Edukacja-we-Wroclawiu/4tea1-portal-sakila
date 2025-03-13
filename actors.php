<?php
include_once('db.php');

// obsługa formularza dodania nowego aktora
if(isset($_POST['first_name'], $_POST['last_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    // uwaga: sql injection!
    $sql = "INSERT INTO actor (first_name, last_name) VALUES ('$first_name', '$last_name')";
    $r = mysqli_query($db, $sql);

    if($r) { // sprawdzamy, czy dodanie się udało
        $new_id = mysqli_insert_id($db);
        header("Location: actor.php?id=$new_id");
    } else { // dodanie się nie udało
        $blad = "Niepowodzenie dodawania aktora.";
    }
}


// pobieranie danych o aktorach
$sql = "SELECT a.actor_id, a.first_name, a.last_name, COUNT(fa.film_id) AS film_count
FROM actor AS a 
    LEFT JOIN film_actor AS fa USING(actor_id)
GROUP BY a.actor_id";
$r = mysqli_query($db, $sql);
$actors = mysqli_fetch_all($r, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista aktorów | Sakila</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Aktorzy</h1>

    <h2>Dodaj nowego aktora</h2>
    <?php if(isset($blad)): ?>
        <p><strong>Uwaga!</strong> <?= $blad ?></p>
    <?php endif ?>
    <form action="#" method="post">
        <div>
            <label for="first_name">Imię: </label>
            <input type="text" name="first_name" id="first_name" required>
        </div>
        <div>
            <label for="last_name">Nazwisko: </label>
            <input type="text" name="last_name" id="last_name" required>
        </div>
        <div>
            <button type="submit">Dodaj</button>
        </div>
    </form>


    <h2>Lista aktorów</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Liczba filmów</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actors as $actor): ?>
                <tr>
                    <th scope="row"><?= $actor['actor_id'] ?></th>
                    <td>
                        <a href="actor.php?id=<?= $actor['actor_id'] ?>">
                            <?= $actor['first_name'] ?>
                        </a>
                    </td>
                    <td>
                        <a href="actor.php?id=<?= $actor['actor_id'] ?>">
                            <?= $actor['last_name'] ?>
                        </a>
                    </td>
                    <td><?= $actor['film_count'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>