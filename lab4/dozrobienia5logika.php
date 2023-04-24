<?php
try{
    $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
    $filter = ['Nazwa płyty' => $_GET["plyta"]];
    $options = ['limit' => 1];
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $connection->executeQuery('Test.Płyty', $query);

    if($cursor->isDead()){
        echo "Nie znaleziono płyty o podanej nazwie.";
    }

    else{
        $bulk = new MongoDB\Driver\BulkWrite();
        $bulk->delete($filter);
        $result = $connection->executeBulkWrite('Test.Płyty', $bulk);
        echo "Usunięto płytę o nazwie " . $cursor->toArray()[0]->{'Nazwa płyty'};
    }
}

catch (Throwable $e){
    echo "Problem z połączeniem " . $e->getMessage() . PHP_EOL;
}

?>
