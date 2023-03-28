<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        echo "Ustanowiono połączenie z bazą <br />";

        $filter = [];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $connection->executeQuery('Test.testowa', $query);

        print("<h1>Kolekcja:</h1><br />");
        foreach ($cursor as $d) {
            print "<b>ID:</b> " . $d->_id . "<br />"
            . "<b>Wartość:</b> " . $d->x . "<br /><br />";
        }
    }

    catch (trowable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>