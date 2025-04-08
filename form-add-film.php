<?php
include_once('db.php');

// pobieranie listy języków
$sql = "SELECT language_id, name FROM language";
$r = mysqli_query($db, $sql);
$languages = mysqli_fetch_all($r, MYSQLI_BOTH);

// stworzenie listy ratingów
$ratings = ['G', 'PG', 'PG-13', 'R', 'NC-17'];

// stworzenie listy możliwości specjalnych
$special_features = ['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'];

// pobranie listy aktorów: actor_id, name
$sql = "SELECT actor_id, CONCAT(first_name, ' ', last_name) AS name FROM actor ORDER BY last_name, first_name";
$r = mysqli_query($db, $sql);
$actors = mysqli_fetch_all($r, MYSQLI_BOTH);
?>

<form action="" method="post">
    <div>
        <label for="title">Tytuł: </label>
        <input type="text" name="title" id="title" reqired>
    </div>
    <div>
        <label for="description">Opis: </label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="release_year">Rok wydania: </label>
        <input type="number" name="release_year" id="release_year" max="9999">
    </div>
    <div>
        <label for="language_id">Język: </label>
        <select name="language_id" id="language_id">
            <?php foreach ($languages as $row) {
                echo ("<option value='$row[language_id]'>$row[name]</option>");
            } ?>
        </select>
    </div>
    <div>
        <label for="original_language_id">Język oryginalny: </label>
        <select name="original_language_id" id="original_language_id">
            <option value=""></option>
            <?php foreach ($languages as $row) {
                echo ("<option value='$row[language_id]'>$row[name]</option>");
            } ?>
        </select>
    </div>
    <div>
        <label for="rental_duration">Domyślna liczba dni wypożyczenia: </label>
        <input type="number" name="rental_duration" id="rental_duration" required>
    </div>
    <div>
        <label for="rental_rate">Koszt wypożyczenia: </label>
        <input type="number" name="rental_rate" id="rental_rate" required step="0.01" min="0.99" value="0.99">
    </div>
    <div>
        <label for="rating">Rating: </label>
        <fieldset id="rating">
            <?php foreach ($ratings as $rating): ?>
                <input type="radio" name="rating" value="<?= $rating ?>"> <?= $rating ?><br />
            <?php endforeach; ?>
        </fieldset>
    </div>
    <div>
        <label for="special_features">Cechy specjalne</label>
        <fieldset id="special_features">
            <?php foreach($special_features as $sf): ?>
                <input type="checkbox" name="special_features" value="<?= $sf ?>"> <?= $sf ?> <br />
            <?php endforeach; ?>
        </fieldset>
    </div>
    <div>
        <label for="actors">Aktorzy biorący udział w filmie</label>
        <select name="actors" id="actors" multiple>
            <?php foreach($actors as $a): ?>
                <option value="<?= $a['actor_id'] ?>"><?= $a['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="categories">Kategorie filmu</label>
    </div>
    <div>
        <button type="submit">Dodaj</button>
    </div>
</form>