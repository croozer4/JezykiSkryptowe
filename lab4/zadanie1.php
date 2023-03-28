<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        echo "Ustanowiono połączenie z bazą <br />";

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['x' => 1]);
        $bulk->insert(['x' => 2]);
        $bulk->insert(['x' => 3]);
        $connection->executeBulkWrite('Test.testowa', $bulk);

        $filter = ['x' => ['$gt' => 1]];
        $options = [
            'projection' => ['_id' => 0],
            'sort' => ['x' => -1],
        ];

        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $connection->executeQuery('Test.testowa', $query);

        foreach ($cursor as $document) {
            var_dump($document);
        }
    }

    catch (trowable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>