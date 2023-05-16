<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$collectionName = 'KolokwiumCollection';
$db = 'Kolokwium';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "tutaj wchodzi";
    // $index = $_POST['index'];
    $zespol = $_POST['zespol'];
    $typ = $_POST['typ'];
    $cena = $_POST['cena'];

    // tworzenie nowego indexu
    $maxIndexQuery = new MongoDB\Driver\Query([], ['sort' => ['Index' => -1], 'limit' => 1]);
    $maxIndexCursor = $manager->executeQuery("$db.$collectionName", $maxIndexQuery);
    $maxIndex = $maxIndexCursor->toArray()[0]->Index;
    $newIndex = $maxIndex + 1;
    $newIndex = (string)$newIndex;

    $document = [
        'Index' => $newIndex,
        'Zespol' => $zespol,
        'typ' => $typ,
        'cena' => $cena
    ];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($document);

    $result = $manager->executeBulkWrite("$db.$collectionName", $bulk);

    if ($result->getInsertedCount() == 1) {
        echo "Dodano nowy dokument.";
    } else {
        echo "Wystąpił błąd podczas dodawania dokumentu.";
    }
}
?>