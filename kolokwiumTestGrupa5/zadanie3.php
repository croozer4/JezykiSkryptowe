<?php
// tworzenie obiektu MongoDB\Driver\Manager, który reprezentuje połączenie z bazą danych MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// nazwa kolekcji, w której znajdują się dokumenty
$collectionName = 'Testowa';
$db = 'KolosG5';

// tworzenie obiektu MongoDB\Driver\Query z pustym zapytaniem, aby pobrać wszystkie dokumenty z kolekcji
$query = new MongoDB\Driver\Query([]);

// wykonanie zapytania przy użyciu metody executeQuery() obiektu MongoDB\Driver\Manager
$cursor = $manager->executeQuery("$db.$collectionName", $query);

// inicjalizacja tablicy asocjacyjnej, w której będziemy przechowywać minimalne i maksymalne ceny dla każdej kategorii
$minMaxPrices = [];

// iteracja po wynikach zapytania i znajdowanie minimalnych i maksymalnych cen dla każdej kategorii
foreach ($cursor as $document) {
    $category = $document->typ;
    $price = $document->cena;
    
    // jeśli kategoria nie została jeszcze dodana do tablicy, to dodaj ją z minimalną i maksymalną ceną ustawioną na wartość pierwszej ceny
    if (!isset($minMaxPrices[$category])) {
        $minMaxPrices[$category] = [
            'min' => $price,
            'max' => $price,
            'documentMin' => $document,
            'documentMax' => $document,
        ];
    }
    // jeśli kategoria jest już w tablicy, to aktualizuj minimalną i maksymalną cenę, jeśli nowa cena jest odpowiednio mniejsza lub większa
    else {
        if ($price < $minMaxPrices[$category]['min']) {
            $minMaxPrices[$category]['min'] = $price;
            $minMaxPrices[$category]['documentMin'] = $document;
        }
        if ($price > $minMaxPrices[$category]['max']) {
            $minMaxPrices[$category]['max'] = $price;
            $minMaxPrices[$category]['documentMax'] = $document;
        }
    }
}

// iteracja po tablicy z minimalnymi i maksymalnymi cenami dla każdej kategorii i wyświetlanie wyników
foreach ($minMaxPrices as $category => $minMax) {
    echo "Kategoria: $category <br><br>";
    echo "Najmniejsza cena: " . $minMax['min'] . "<br>";
    echo "Dokument z najmniejszą ceną: <br>";
    echo "Index: " . $minMax['documentMin']->Index . "<br>";
    echo "Zespół: " . $minMax['documentMin']->Zespol . "<br>";
    echo "Typ: " . $minMax['documentMin']->typ . "<br>";
    echo "Cena: " . $minMax['documentMin']->cena . "<br><br>";

    echo "Największa cena: " . $minMax['max'] . "<br>";
    echo "Dokument z największą ceną: <br>";
    echo "Index: " . $minMax['documentMax']->Index . "<br>";
    echo "Zespół: " . $minMax['documentMax']->Zespol . "<br>";
    echo "Typ: " . $minMax['documentMax']->typ . "<br>";
    echo "Cena: " . $minMax['documentMax']->cena . "<br><br>";

    echo "------------------------------------------------------<br><br>";
    }

    // inicjalizacja zmiennych przechowujących najmniejszą i największą cenę
    $globalMinPrice = null;
    $globalMaxPrice = null;

    $cursor = $manager->executeQuery("$db.$collectionName", $query);

// iteracja po wszystkich dokumentach i znajdowanie globalnej najmniejszej i największej ceny
foreach ($cursor as $document) {
    $price = $document->cena;

    // jeśli globalna najmniejsza cena nie została jeszcze ustawiona lub nowa cena jest mniejsza, to ustaw ją na nową cenę
    if ($globalMinPrice === null || $price < $globalMinPrice) {
        $globalMinPrice = $price;
    }

    // jeśli globalna największa cena nie została jeszcze ustawiona lub nowa cena jest większa, to ustaw ją na nową cenę
    if ($globalMaxPrice === null || $price > $globalMaxPrice) {
        $globalMaxPrice = $price;
    }
}

// wyświetlanie globalnej najmniejszej i największej ceny
echo "Najmniejsza cena bez podziału na kategorię: " . $globalMinPrice . "<br>";
echo "Największa cena bez podziału na kategorię: " . $globalMaxPrice . "<br>";


?>
