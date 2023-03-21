<html>
    <body>
        <?php

        $zmienna='345.345';//typ string
        echo 'Typ zmiennej - '.gettype($zmienna).'<br />';
        if (settype($zmienna, 'integer')){
            echo gettype($zmienna);
            echo "\nwartosc zmiennej: ".$zmienna;
        }
        else echo 'Nie można ustawić typu na integer';

        ?>
    </body>
</hmtl>