# Portal sakila - uczymy się PHP

**Uwaga!** W tym repozytorium znajduje się kod dla klasy 4Tea/1 z uczenia się PHP. On nie jest ładny ani najlepszy na świecie, ponieważ jeszcze się uczymy - trzeba nam dać trochę czasu :)

## Pomysły do wykonania

- [x] Wyświetlanie podstawowych informacji o
  - [x] filmie
  - [x] aktorze
- [x] Wyświetlanie podstawowych list z
  - [x] filmami
  - [x] aktorami
- [ ] Proste formularze dodawania danych
  - [x] Dodawanie aktora
- [ ] Średniozaawansowane formularze dodawania danych
  - [ ] Dopisywanie aktora do filmu
  - [ ] Dopisywanie filmu do aktora
- [ ] Formularze aktualizacji danych
  - [ ] Aktualizacja danych aktora
- [ ] Generowanie zaawansowanych bloków kodu - innych niż elementy listy czy wiersze tabeli
  - [ ] Proste komponenty o filmach
- [ ] Stylizowanie strony - użycie Bootstrapa

## 2025-02-25

Zaczynamy. Dzisiaj w planie:

- [x] Wyświetlenie listy filmów: ID, tytuł, czas trwania
- [ ] Stworzenie strony o szczegółach wybranego filmu, np. opis, obsada itp. **_- na następne zajęcia_**

## 2025-02-28

Kontynuacja z poprzednich zajeć:

- [ ] Stworzenie strony o szczegółach wybranego filmu, np. opis, obsada itp. Do zrobienia w `film.php`:
  - [x] Sprawdzenie, czy przesłano ID filmu do wyświetlenia
  - [x] Pobranie danych o danym filmie z bazy
  - [x] Wypisanie tytułu, opisu, czasu trwania
  - [ ] Wyświetlenie obsady - **_na następne zajęcia_**:
    - [ ] zbudować zapytanie pobierające ID, nazwisko i imię aktora, który jest w obsadzie danego filmu (trzeba będzie użyć zapytania ze złączeniem)

## 2025-03-06

- [x] Wyświetlanie obsady - z poprzednich zajęć
  - [x] zbudować zapytanie pobierające ID, nazwisko i imię aktora, który jest w obsadzie danego filmu (trzeba będzie użyć zapytania ze złączeniem)
  - [x] wysłać do bazy danych, a potem wyświetlić w formie elementów listy `<ul>`
- [ ] Strona o aktorze: imię, nazwisko, lista filmów, w których obsadzie się znajduje - **_ćwiczenie do wykonania_**
  - [ ] Sprawdzenie, czy podano ID liczbowe (np. przez `intval`)
  - [ ] Zapytanie do bazy pobierające informacje o aktorze
  - [ ] ...

## 2025-03-11

- [ ] Strona o aktorze - **_zadanie na ocenę_**
  - [ ] Podstawowe informacje o aktorze - imię i nazwisko
  - [ ] Filmy, w których aktor brał udział - ich liczba oraz lista nienumerowana zawierająca linki do strony z filmem

## 2025-03-13

- [x] Strona o aktorze - dodana do repo
- [x] Lista wszystkich aktorów: tabelka z ID, imieniem i nazwiskiem aktora
  - [x] Później: liczba filmów, w których dany aktor grał, pobrana jednym zapytaniem (wraz z podstawowymi danymi)
- [x] Na górze strony ze wszystkimi aktorami formularz dodawania nowego aktora: tylko imię i nazwisko (ID nada baza danych automatycznie)
- [x] Obsługa dodawania aktora
- [ ] Doddawanie nowego filmu dla aktora
  - [ ] Napisz zapytanie, które pobierze ID i tytuły filmów, w których dany aktor **nie brał udziału** -- **_zadanie do pomyślenia na następną lekcję_**
  - [ ] Stwórz formularz, a w nim dodaj pole `<select>` z wygenerowanymi `<option>` na podstawie wyników zapytania
  - [ ] Obsłuż formularz
