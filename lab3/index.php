<html>
<head>
<title>
Test formularza metoda GET
</title>
</head>
<body>
<form action="drugi.php" method="POST">
Imię: <input type=text name="imie"/><br/>
Nazwisko: <input type=text name="nazwisko"/><br/>
Zaznaczysz mnie?: <input type=checkbox name="zaznacz"/><br/>
Wybierz z listy:<br/>
<input type=radio name=lista value="tv"/>Telewizor<br>
<input type=radio name=lista value="laptop"/>Laptop<br>
<input type=radio name=lista value="tablet"/>Tablet<br>
<input type=submit value="Wyślij"/>

<a href="wynik.php?strona=2">Otwórz stronę nr 2</a>
</form>
</body>
</html>