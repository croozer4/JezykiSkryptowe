<?php
// tworzenie obiektu MongoDB\Driver\Manager, który reprezentuje połączenie z bazą danych MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// nazwa kolekcji, w której znajdują się dokumenty
$collectionName = 'Testowa';
$db = 'KolosG5';

// sprawdzenie, czy został przesłany parametr GET z identyfikatorem dokumentu do usunięcia
if (isset($_GET['id'])) {
    // pobranie identyfikatora dokumentu z parametru GET
    $id = $_GET['id'];
    // utworzenie obiektu MongoDB\BSON\ObjectId z identyfikatorem dokumentu
    $objectId = new MongoDB\BSON\ObjectId($id);
    // konwertuj id na int

    // utworzenie obiektu MongoDB\Driver\BulkWrite, który umożliwia wykonanie wielu operacji na bazie danych naraz
    $bulk = new MongoDB\Driver\BulkWrite;

    // dodanie operacji deleteOne do obiektu BulkWrite, która usuwa dokument o danym identyfikatorze
    $bulk->delete(
        ['_id' => $objectId],
        ['limit' => 1]
    );

    // wykonanie operacji przy użyciu metody executeBulkWrite() obiektu MongoDB\Driver\Manager
    $result = $manager->executeBulkWrite("$db.$collectionName", $bulk);

    // wyświetlenie komunikatu o powodzeniu operacji lub o błędzie
    if ($result->getDeletedCount() == 1) {
        echo "Dokument został usunięty.";
    } else {
        echo "Wystąpił błąd podczas usuwania dokumentu.";
    }
}
?>
