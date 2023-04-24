<?php
// tworzenie obiektu MongoDB\Driver\Manager, który reprezentuje połączenie z bazą danych MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// nazwa kolekcji, w której znajdują się dokumenty
$collectionName = 'Testowa';
$db = 'KolosG5';

// sprawdzenie, czy zostały przesłane parametry metodą POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // pobranie identyfikatora dokumentu i nowej ceny z parametrów POST
    $id = $_POST['id'];
    $newPrice = $_POST['newPrice'];

    echo "ID: " . $id . "<br>";
    echo "Cena: " . $newPrice . "<br>";

    // utworzenie obiektu MongoDB\BSON\ObjectId z identyfikatorem dokumentu
    $objectId = new MongoDB\BSON\ObjectId($id);

    // utworzenie obiektu MongoDB\Driver\BulkWrite, który umożliwia wykonanie wielu operacji na bazie danych naraz
    $bulk = new MongoDB\Driver\BulkWrite;

    // dodanie operacji updateOne do obiektu BulkWrite, która aktualizuje cenę w dokumencie o danym identyfikatorze
    $bulk->update(
        ['_id' => $objectId],
        ['$set' => ['cena' => $newPrice]]
    );

    // wykonanie operacji przy użyciu metody executeBulkWrite() obiektu MongoDB\Driver\Manager
    $result = $manager->executeBulkWrite("$db.$collectionName", $bulk);

    // wyświetlenie komunikatu o powodzeniu operacji lub o błędzie
    if ($result->getModifiedCount() == 1) {
        echo "Cena została zmieniona.";
    } else {
        echo "Wystąpił błąd podczas zmiany ceny.";
    }
}
?>