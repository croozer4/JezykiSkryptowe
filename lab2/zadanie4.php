<html>

    <body>

    <?php
    
    class Osoba {
        private $imie;
        private $nazwisko;
        private $wiek;
    
        public function __construct($imie, $nazwisko, $wiek) {
            $this->imie = $imie;
            $this->nazwisko = $nazwisko;
            $this->wiek = $wiek;
        }
    
        public function wyswietlDane() {
            echo "Imię: {$this->imie}\n";
            echo "Nazwisko: {$this->nazwisko}\n";
            echo "Wiek: {$this->wiek}\n";
        }
    }
    
    class Student extends Osoba {
        private $wydzial;
        private $semestr;
    
        public function __construct($imie, $nazwisko, $wiek, $wydzial, $semestr) {
            parent::__construct($imie, $nazwisko, $wiek);
            $this->wydzial = $wydzial;
            $this->semestr = $semestr;
        }
    
        public function zmienSemestr($semestr) {
            $this->semestr = $semestr;
        }
    
        public function wyswietlDane() {
            parent::wyswietlDane();
            echo "Wydział: {$this->wydzial}\n";
            echo "Semestr: {$this->semestr}\n";
        }
    }
    
    // Tworzymy nowego studenta
    $student = new Student('Jan', 'Kowalski', 23, 'Informatyka', 3);

    // Wyświetlamy informacje o studencie
    echo $student->wyswietlDane() . "<br/>";

    // Zmieniamy semestr na 4
    $student->zmienSemestr(4);

    // Wyświetlamy informacje o studencie po zmianie semestru
    echo $student->wyswietlDane() . "<br/>";

    ?>

    </body>

</html>