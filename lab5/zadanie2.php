<?php
// konfiguracja bazy danych MongoDB
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$query = new MongoDB\Driver\Query([]);

// pobieranie wszystkich dokumentów z kolekcji "news"
$rows = $mongo->executeQuery("Test2.News", $query);

// odczytanie wartości zmiennej "news" z adresu URL
$currentNews = isset($_GET['news']) ? $_GET['news'] : 1;

// wyświetlanie wybranego newsa
$selectedNews = $mongo->executeQuery("Test2.News", $query)->toArray()[$currentNews - 1];

echo "Języki skryptowe strona do ćwiczeń" . "</br>";

$newsgroups = $selectedNews->Properties->Newsgroups ?? "Nie znaleziono grupy newsów.";

$fileName = basename($selectedNews->Filename) ?? "Nie znaleziono nazwy pliku." . "</br>";

$date = $selectedNews->Properties->Date ?? "Nie znaleziono daty publikacji.";

$filePath = $selectedNews->Properties->Path ?? "Nie znaleziono ścieżki do pliku.";

$content = nl2br($selectedNews->Content) ?? "Nie znaleziono treści pliku.";

$author = $selectedNews->Properties->From ?? "Nie znaleziono autora pliku.";

// wysweitlanie wybranego newsa

echo "Wybrano >> " . $newsgroups . "</br>";

echo "News: " . $fileName . "</br>";

echo "Data opublikowania: " . $date . "</br>";

echo "Path: " . $filePath . "</br>";

echo "Treść: </br> " . $content . "</br>";

echo "Autor: " . $author . "</br>";


// Obsługa przycisków "poprzedni" i "następny"
echo '<br>';
if ($currentNews > 1) {
    $previousNewsNumber = $currentNews - 1;
    echo '<a href="?news=' . $previousNewsNumber . '">Poprzedni</a> | ';
}
$nextNewsNumber = $currentNews + 1;
echo '<a href="?news=' . $nextNewsNumber . '">Następny</a>';
?>