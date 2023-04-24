<?php
// konfiguracja bazy danych MongoDB
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// odczytanie wartości zmiennej "page" z adresu URL
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 10;
$skip = ($page - 1) * $perPage;

// pobieranie wybranych dokumentów z kolekcji "news"
$filter = [];
$options = [
    'sort' => ['Properties.Date' => -1],
    'limit' => $perPage,
    'skip' => $skip,
];
$rows = $mongo->executeQuery("Test2.News", new MongoDB\Driver\Query($filter, $options));

// wyświetlanie wyników
echo "Języki skryptowe strona do ćwiczeń" . "</br>";
foreach ($rows as $row) {
    $newsgroups = $row->Properties->Newsgroups ?? "Nie znaleziono grupy newsów.";
    $fileName = basename($row->Filename) ?? "Nie znaleziono nazwy pliku." . "</br>";
    $date = $row->Properties->Date ?? "Nie znaleziono daty publikacji.";
    $filePath = $row->Properties->Path ?? "Nie znaleziono ścieżki do pliku.";
    $content = nl2br($row->Content) ?? "Nie znaleziono treści pliku.";
    $author = $row->Properties->From ?? "Nie znaleziono autora pliku.";

    echo "Wybrano >> " . $newsgroups . "</br>";
    echo "News: " . $fileName . "</br>";
    echo "Data opublikowania: " . $date . "</br>";
    echo "Path: " . $filePath . "</br>";
    echo "Treść: </br> " . $content . "</br>";
    echo "Autor: " . $author . "</br>";
    echo "<br><br>";
}

// wyświetlanie przycisków "Poprzednia strona" i "Następna strona"
echo '<br>';
if ($page > 1) {
    $previousPage = $page - 1;
    echo '<a href="?page=' . $previousPage . '">Poprzednia strona</a> | ';
}
$countQuery = new MongoDB\Driver\Query([]);
$count = count($mongo->executeQuery("Test2.News", $countQuery)->toArray());
if ($count > ($page * $perPage)) {
    $nextPage = $page + 1;
    echo '<a href="?page=' . $nextPage . '">Następna strona</a>';
}
?>
