<?php
include_once('db.php');

if(isset($_POST['title'])) {
    // Obsługa formularza dodawania filmu

    var_dump($_POST);
    die();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista filmów</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Dodawanie nowego filmu</h2>
    <!-- Dołączam formularz, którego kod jest w innym pliku -->
    <?php include('form-add-film.php'); ?>

    <h2>Lista filmów</h2>
    <!-- Tabela z informacjami o filmach: ID, tytuł, Czas trwania, pusta kolumna AKCJE -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tytuł</th>
                <th>Czas trwania</th>
                <th>AKCJE</th>
            </tr>
        </thead>
        <tbody>

<?php
// pobierz id, tytuł i czas trwania filmów
$r = mysqli_query($db, "SELECT film_id, title, length FROM film");

/* mysqli_fetch_assoc pobiera następny wiersz wyniku. Wynikiem przypisania jest to, co zostało przypisane. Jeśli pobraliśmy wiersz, to jest to traktowane jako prawda. Jeśli nie ma już żadnego wiersza, funkcja mysqli_fetch_assoc zwróci fałsz, zatem pętla się zakończy.
Efekt: wykonanie pętli dla wszystkich wierszy pobranych zapytaniem.
*/
while($row = mysqli_fetch_assoc($r)) {
    echo("<tr>
            <th scope='row'>{$row['film_id']}</th>
            <td><a href='film.php?id={$row['film_id']}'>{$row['title']}</a></td>
            <td>{$row['length']} min.</td>
            <td></td>
        </tr>");
}
?>
        </tbody>
    </table>
</body>
</html>