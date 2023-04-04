<?php
// konfiguracja połączenia z bazą danych MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite;
$collectionName = 'News';

// ścieżka do archiwum z danymi
$archivePath = "dane\mini_newsgroups.zip";

// otwieranie archiwum
$zip = zip_open($archivePath);

if ($zip) {
    echo "Ustanowiono połączenie z bazą <br />";
    // przetwarzanie plików w archiwum
    while ($zipEntry = zip_read($zip)) {
        // pobieranie nazwy pliku
        $entryName = zip_entry_name($zipEntry);
        echo "Plik: " . $entryName . "<br />";

        // przetwarzanie tylko plików tekstowych
        // przetwarzanie tylko plików tekstowych
        if (1) {
            // otwieranie pliku
            $fileContent = zip_entry_read($zipEntry);

            // sprawdzenie, czy plik ma poprawne kodowanie utf8
            if (!mb_check_encoding($fileContent, 'UTF-8')) {
                // jeśli plik ma niepoprawne kodowanie, to wyświetlamy komunikat i kontynuujemy
                echo "Błąd kodowania UTF-8 w pliku: " . $entryName . "<br />";
                continue;
            }

            // podzielenie zawartości pliku na linie
            $lines = explode("\n", $fileContent);

            // utworzenie tablicy na właściwości pliku
            $properties = [];

            // iteracja po liniach pliku
            foreach ($lines as $line) {
                // sprawdzenie, czy linia zawiera właściwość
                if (strpos($line, ":") !== false) {
                    // podzielenie linii na nazwę właściwości i jej wartość
                    $property = explode(":", $line, 2);
                    $propertyName = trim($property[0]);
                    $propertyValue = trim($property[1]);

                    // dodanie właściwości do tablicy
                    $properties[$propertyName] = $propertyValue;
                }
                // jeśli linia nie zawiera właściwości, to oznacza to koniec nagłówka
                else {
                    break;
                }
            }

            // utworzenie nowego dokumentu w kolekcji
            $document = [
                "Filename" => $entryName,
                "Properties" => $properties,
                "Content" => implode("\n", array_slice($lines, count($properties) + 1)),
            ];

            // dodawanie dokumentu do kolekcji
            $bulk->insert($document);
        }

    }

    // zamykanie archiwum
    zip_close($zip);

    // zapisywanie dokumentów w kolekcji
    $manager->executeBulkWrite('Test2.'.$collectionName, $bulk);
}
?>