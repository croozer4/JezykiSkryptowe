<html>
<head>
<title>
Wyniki
</title>
</head>
<body>
Imię: <?php echo $_POST['imie']?><br>
Nazwisko: <?php echo $_POST['nazwisko']?><br>
Zaznaczyłeś mnie?: <?php echo ($_POST['zaznacz'] == 'on' ? 'Tak' :
'Nie')?><br>
Zamówienie: <?php switch($_POST['lista']){
case "tv":
echo "Telewizor";
break;
case "laptop":
echo "Laptop";
break;
case "tablet":
echo "Tablet";
break;
}
?>
</body>
</html>