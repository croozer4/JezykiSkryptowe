<?php
// tworzenie obiektu MongoDB\Driver\Manager, który reprezentuje połączenie z bazą danych MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// nazwa kolekcji, w której znajdują się dokumenty
$collectionName = 'Testowa';
$db = 'KolosG5';

// pobranie identyfikatora dokumentu z parametrów zapytania
$id = $_POST['id'];

// pobranie aktualnych danych dokumentu
$filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$documents = $manager->executeQuery("$db.$collectionName", $query)->toArray();
$document = $documents[0];

// sprawdzenie, czy został przesłany formularz
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // pobranie nowego typu nośnika z parametrów POST
    $nowyNosnik = $_POST['nowyNosnik'];

    // aktualizacja danych dokumentu
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(['_id' => new MongoDB\BSON\ObjectID($id)], ['$set' => ['typ' => $nowyNosnik]]);
    $manager->executeBulkWrite("$db.$collectionName", $bulk);

    // wypisanie informacji o powodzeniu operacji
    echo "Typ nośnika został zmieniony.";
    
}
?>