<?php
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $collectionName = 'KolokwiumCollection';
    $db = 'Kolokwium';

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $objectId = new MongoDB\BSON\ObjectId($id);

        $bulk = new MongoDB\Driver\BulkWrite;

        $bulk->delete(
            ['_id' => $objectId],
            ['limit' => 1]
        );

        $result = $manager->executeBulkWrite("$db.$collectionName", $bulk);

        if ($result->getDeletedCount() == 1) {
            echo "Usunięto.";
        } else {
            echo "Wystąpił błąd podczas usuwania.";
        }
    }
?>