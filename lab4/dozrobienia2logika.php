<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        echo "Ustanowiono połączenie z bazą <br />";

        $nazwa = $_POST["nazwa"];
        $zespol = $_POST["zespol"];
        $gatunek = $_POST["gatunek"];
        $rok = $_POST["rok"];

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['Nazwa płyty' => $nazwa, 'Zespół' => $zespol, 'Gatunek' => $gatunek, 'Rok wydania' => $rok]);

        $connection->executeBulkWrite('Test.Płyty', $bulk);

        echo "Dodano płyte do kolekcji";
    }

    catch (trowable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>