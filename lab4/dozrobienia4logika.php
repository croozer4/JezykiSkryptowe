<?php
try {
    $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
    $bulk = new MongoDB\Driver\BulkWrite;

    $nazwa_plyty = $_POST["nazwa_plyty"];
    $nowa_nazwa_plyty = $_POST["nowa_nazwa_plyty"];

    $filter = ['Nazwa płyty' => $nazwa_plyty];
    $newData = ['$set' => ['Nazwa płyty' => $nowa_nazwa_plyty]];

    $bulk->update($filter, $newData);
    $result = $connection->executeBulkWrite('Test.Płyty', $bulk);

    echo "Nazwa płyty " . $nazwa_plyty . " została zmieniona na " . $nowa_nazwa_plyty;
} catch (Throwable $e) {
    echo "Problem z połączeniem " . $e->getMessage();
}
?>
