<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        echo "Ustanowiono połączenie z bazą <br />";

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['x' => 1],
            ['$set' => ['x' => 5]],
            ['multi' => false, 'upsert' => false]
        );

        $result = $connection->executeBulkWrite('Test.testowa', $bulk);
    }

    catch (trowable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>