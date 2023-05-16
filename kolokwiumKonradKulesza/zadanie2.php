<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$collectionName = 'KolokwiumCollection';
$db = 'Kolokwium';

$query = new MongoDB\Driver\Query([]);

$cursor = $manager->executeQuery("$db.$collectionName", $query);

foreach ($cursor as $document) {
    echo "_id: " . $document->_id . "<br>";
    echo "Index: " . $document->Index . "<br>";
    echo "Zespół: " . $document->Zespol . "<br>";
    echo "Typ: " . $document->typ . "<br>";
    echo "Cena: " . $document->cena . "<br><br>";
}
?>