<!-- 1. Proszę o stworzenie nowej kolekcji o nazwie „Płyty”. -->

<?php
    try{
        $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
        // connect to MongoDB
        $mc = new MongoClient();
        echo "Database connection successful";

        // select a database
        $db = $mc->mydb;
        echo "Database selected";
        $mycollection = $db->createCollection("mycol");
        echo "Collection created succsessfully";
    }

    catch (trowable $e){
        echo "Problem z połączeniem " . $e->getMessage() .
        PHP_EOL;
    }
?>