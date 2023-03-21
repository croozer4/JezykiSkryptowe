<html>

    <body>

        <?php

        class WordArray {
            const MAX_SIZE = 10;
            private $words = array();
            
            public function addWords($sentence) {
                $this->words = explode(" ", $sentence);
                // foreach ($words as $word) {
                //     if (count($this->words) < self::MAX_SIZE) {
                //         $this->words[] = $word;
                //     } else {
                //         break;
                //     }
                // }
            }
            
            public function sortWords() {
                sort($this->words);
            }
            
            public function displayWords() {
                foreach ($this->words as $word) {
                    echo $word . " ";
                }
            }
        }

        $wordArray = new WordArray();
        $wordArray->addWords("Ala ma kota a kot ma Ale");
        $wordArray->sortWords();
        $wordArray->displayWords();
   
        ?>

    </body>

</html>