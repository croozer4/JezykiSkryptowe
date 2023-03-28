<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        echo "Ustanowiono połączenie z bazą <br />";

        $zespol = $_POST["zespol"];

        $query = new MongoDB\Driver\Query(['Zespół' => $zespol]);
        $cursor = $connection->executeQuery('Test.Płyty', $query);

        echo "Płyty zespołu " . $zespol . ":<br />";
        foreach ($cursor as $document) {
            echo "Nazwa płyty: " . $document->{"Nazwa płyty"} . ", ";
            echo "Gatunek: " . $document->{"Gatunek"} . ", ";
            echo "Rok wydania: " . $document->{"Rok wydania"} . "<br />";
        }
    }

    catch (Throwable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>
