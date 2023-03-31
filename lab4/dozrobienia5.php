<form action="dozrobienia5logika.php" method="GET">
    <label>Wybierz płytę:</label>
    <select name="plyta">
        <?php
            try{
                $connection = new MongoDB\Driver\Manager('mongodb://localhost:27017/');
                $query = new MongoDB\Driver\Query([]);
                $cursor = $connection->executeQuery('Test.Płyty', $query);

                foreach ($cursor as $document) {
                    echo "<option value='" . $document->{'Nazwa płyty'} . "'>" . $document->{'Nazwa płyty'} . "</option>";
                }
            }

            catch (Throwable $e){
                echo "Problem z połączeniem " . $e->getMessage() .
                PHP_EOL;
            }
        ?>
    </select>
    <input type="submit" name="usun" value="Usuń">
</form>
