<!-- 2. Proszę stworzyć formularz umożliwiający wysłanie metodą POST danych na temat płyty:
a. Nazwa płyty,
b. zespół,
c. gatunek,
d. rok wydania
Następnie proszę stworzyć plik, który umożliwi odebranie danych z formularza i
zapisanie ich w kolekcji „Płyty”. Następnie należy za pomocą formularza dodać 5
dokumentów.
-->

<html>
    <body>

        <form action="dozrobienia2logika.php" method="post">
            Nazwa płyty: <input type="text" name="nazwa"><br>
            Zespół: <input type="text" name="zespol"><br>
            Gatunek: <input type="text" name="gatunek"><br>
            Rok wydania: <input type="text" name="rok"><br>
            <input type="submit">
        </form>

    </body>
</html>
