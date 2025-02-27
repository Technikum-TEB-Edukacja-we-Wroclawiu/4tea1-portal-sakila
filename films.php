<?php
include_once('db.php');

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
            <td>{$row['title']}</td>
            <td>{$row['length']} min.</td>
            <td></td>
        </tr>");
}
?>
        </tbody>
    </table>
</body>
</html>