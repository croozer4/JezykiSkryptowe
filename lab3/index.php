<html>
<head>
<title>
Test formularza metoda GET
</title>
</head>
<body>


<!-- Zadanie 2 -->
<!-- <?php
    setcookie("login", "JohnSmith", time()+60);
    setcookie("pass", "admin", time()+60);

    setcookie("logowanie[login]", "JohnSmith", time()+60);
    setcookie("logowanie[pass]", "admin", time()+60);

    if(isset($_COOKIE['login']) && $_COOKIE['pass']){
        echo "Dane logowania kompletne";
    }else{
        echo "Brak ciasteczka z danymi logowania";
    }
    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';    
?> -->

<!-- Zadanie 3 -->
<!-- <?php
    if(isset($_COOKIE['licznik'])){
        setcookie("licznik", $_COOKIE['licznik'] + 1, time()+2);
        echo "Odwiedzenia strony: " . $_COOKIE['licznik'];
    }
    else{
        setcookie("licznik", 0, time()+60);
        echo "Odwiedzenia strony: 0";
    }
?> -->

<!-- Zadanie 4 -->
<!-- <?php

    if(isset($_COOKIE['powitanie'])){
        
        $i = rand(0, 10);

        switch ($i) {
            case 0:
                echo "Witaj ponownie! Cieszymy się, że wróciłeś.";
                break;
            case 1:
                echo "Fajnie, że wróciłeś! Mamy nadzieję, że znajdziesz to, czego szukasz.";
                break;
            case 2:
                echo "Miło Cię widzieć znowu! Jeśli potrzebujesz pomocy, jesteśmy tutaj, aby Ci pomóc.";
                break;
            case 3:
                echo "Cieszę się, że zdecydowałeś się odwiedzić nas ponownie! Co przynosi Cię dzisiaj?";
                break;
            case 4:
                echo "Witaj z powrotem! Mamy kilka nowości, które być może Cię zainteresują.";
                break;
            case 5:
                echo "Miło Cię widzieć! Wygląda na to, że coś Cię tutaj trzyma. Czego szukasz?";
                break;
            case 6:
                echo "Cześć! Cieszymy się, że odwiedzasz nas ponownie. Czy mamy Cię jakoś wesprzeć?";
                break;
            case 7:
                echo "Witaj z powrotem! Oglądałeś już nasze najnowsze dodatki?";
                break;
            case 8:
                echo "Miło Cię widzieć znowu! Mamy nadzieję, że Twoja ostatnia wizyta była udana.";
                break;
            case 9:
                echo "Cześć! Witamy Cię z powrotem. Czego możemy Cię dzisiaj nauczyć?";
                break;
            case 10:
                echo "Witaj ponownie na naszej stronie! Jesteśmy bardzo zadowoleni z Twojej obecności tutaj. ";
                break;
        }
    }
    else{
        setcookie("powitanie", 0, time()+60);
        echo "Witamy pierwszy raz na stronie!";
    }
?> -->

<!-- Zadanie 5 -->
<!-- <?php
    session_start();

    if(isset($_SESSION['session_licznik'])){
        $_SESSION['session_licznik'] = $_SESSION['session_licznik'] + 1;
        echo "Odwiedzenia strony w sesji: " . $_SESSION['session_licznik'];
    }
    else{
        $_SESSION['session_licznik'] = 0;
        echo "Odwiedzenia strony w sesji: 0";
    }
?> -->

<!-- Zadanie 6 -->
<!-- <?php
    if(isset($_SESSION['session_powitanie'])){
            
        $i = rand(0, 10);

        switch ($i) {
            case 0:
                echo "Witaj ponownie! Cieszymy się, że wróciłeś.";
                break;
            case 1:
                echo "Fajnie, że wróciłeś! Mamy nadzieję, że znajdziesz to, czego szukasz.";
                break;
            case 2:
                echo "Miło Cię widzieć znowu! Jeśli potrzebujesz pomocy, jesteśmy tutaj, aby Ci pomóc.";
                break;
            case 3:
                echo "Cieszę się, że zdecydowałeś się odwiedzić nas ponownie! Co przynosi Cię dzisiaj?";
                break;
            case 4:
                echo "Witaj z powrotem! Mamy kilka nowości, które być może Cię zainteresują.";
                break;
            case 5:
                echo "Miło Cię widzieć! Wygląda na to, że coś Cię tutaj trzyma. Czego szukasz?";
                break;
            case 6:
                echo "Cześć! Cieszymy się, że odwiedzasz nas ponownie. Czy mamy Cię jakoś wesprzeć?";
                break;
            case 7:
                echo "Witaj z powrotem! Oglądałeś już nasze najnowsze dodatki?";
                break;
            case 8:
                echo "Miło Cię widzieć znowu! Mamy nadzieję, że Twoja ostatnia wizyta była udana.";
                break;
            case 9:
                echo "Cześć! Witamy Cię z powrotem. Czego możemy Cię dzisiaj nauczyć?";
                break;
            case 10:
                echo "Witaj ponownie na naszej stronie! Jesteśmy bardzo zadowoleni z Twojej obecności tutaj. ";
                break;
        }
    }
    else{
        $_SESSION['session_powitanie'] = 0;
        echo "Witamy pierwszy raz na stronie!";
    }
?> -->

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