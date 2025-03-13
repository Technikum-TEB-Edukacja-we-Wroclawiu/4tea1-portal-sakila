<?php
include_once('db.php');

$sql = "SELECT a.actor_id, a.first_name, a.last_name, COUNT(fa.film_id) AS film_count
FROM actor AS a 
    JOIN film_actor AS fa USING(actor_id)
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
    <h1>Lista aktorów</h1>

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
            <?php foreach($actors as $actor): ?>
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