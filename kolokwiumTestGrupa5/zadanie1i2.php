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

// iteracja po wynikach zapytania i wyświetlenie każdej płyty oddzielnie
foreach ($cursor as $document) {
    echo "_id: " . $document->_id . "<br>";
    echo "Index: " . $document->Index . "<br>";
    echo "Zespół: " . $document->Zespol . "<br>";
    echo "Typ: " . $document->typ . "<br>";
    echo "Cena: " . $document->cena . "<br><br>";
}
?>
