<!DOCTYPE html>
<html long="ru">
<head>
    <meta charset="utf-8">
    <title>Gudzovskiy</title>
    <!-- подключение стилей gooleFonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika:wght@400;700&display=swap" rel="stylesheet">
    <!-- подключние файла стилей -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="inline"></div>
        </header>
        <main>
<?php



    if( isset($_POST['data']) && $_POST['data'] ) // если передан текст для анализа
    {
        echo '<div class="intext">' . $_POST['data'] . '</div>'; // выводим текст

        echo '<table class="table_view">';

        test_it( iconv("utf-8", "cp1251", $_POST['data']) ); // анализируем текст
        $arr_symbs = test_symbs( iconv("utf-8", "cp1251", $_POST['data']) );

        echo '<table class="table_view">';
        foreach ($arr_symbs as $key => $value) {  // выводим символ || кол-во
            echo '<tr><td>' . iconv("cp1251", "utf-8", $key) . '</td><td>' . $value . '</td></tr>';
            // echo '<tr><td>' . $key. '</td><td>' . $value . '</td></tr>';

        }
        echo "</table><br>";

        
    }
    else // если текста нет или он пустой
        echo '<div class="src_error">Нет текста для анализа</div>';

function test_it( $text ) {
    // количество символов в тексте определяется функцией размера текста
    echo '<tr><td>Количество символов: </td><td>'.strlen($text).'</td></tr>';
    // определяем ассоциированный массив с цифрами
    $cifra=array( '0'=>true, '1'=>true, '2'=>true, '3'=>true, '4'=>true,
    '5'=>true, '6'=>true, '7'=>true, '8'=>true, '9'=>true );
    $punctuation=array( ','=>true, '.'=>true, '-'=>true, '!'=>true, '?'=>true, "'"=>true);
    // вводим переменные для хранения информации о:
    $cifra_amount=0; // количество цифр в тексте
    $punctuation_count = 0;  // колво знаков пунктуации в тексте
    $word_amount=0; // количество слов в тексте
    $letter_count = 0;  // колво букв в тексте
    $upperCase_count = 0;  // колво букв в верхнем регистре
    $lowerCase_count = 0;  // колво букв в нижнем регистре


    $word=''; // текущее слово
    $words=array(); // список всех слов

    for($i=0; $i<strlen($text); $i++) {// перебираем все символы текста
        if( array_key_exists($text[$i], $cifra) ) // если встретилась цифра
            $cifra_amount++; // увеличиваем счетчик цифр
        
        else if (array_key_exists($text[$i], $punctuation) ) {  // если знак пунктуации
            $punctuation_count++;
        }   
        else if ($text[$i] != ' ') {
            $letter_count++;

            if (iconv("cp1251", "utf-8", $text[$i]) == mb_strtolower(iconv("cp1251", "utf-8", $text[$i]))){
                $lowerCase_count++;
            }   
            else {
                $upperCase_count++;
            }
            
        } 

        if( $text[$i]==' ' || $text[$i]==',' || $text[$i]=='.' || $text[$i]=='!' || $text[$i]=='?' || $i==strlen($text)-1 ) {  // если в тексте встретился пробел или текст закончился

            if ($text[$i]!=' ' && $text[$i]!=',' && $text[$i]!='.' && $text[$i]!='!' && $text[$i]!='?')
                $word.=$text[$i]; //добавляем в текущее слово новый символ

            if( $word ) {// если есть текущее слово
                if( isset($words[$word]) )  // если текущее слово сохранено в списке слов
                    $words[ $word ]++; // увеличиваем число его повторов
                else
                    $words[ $word ]=1; // первый повтор слова
            }

            $word=''; // сбрасываем текущее слово
        }
        else // если слово продолжается
            $word.=$text[$i]; //добавляем в текущее слово новый символ
    }
    
    echo '<tr><td>Количество цифр: </td><td>'.$cifra_amount.'</td></tr>';
    echo '<tr><td>Количество знаков препинания: </td><td>'.$punctuation_count.'</td></tr>';
    echo '<tr><td>Количество букв: </td><td>'.$letter_count.'</td></tr>';
    echo '<tr><td>Количество заглавных букв: </td><td>'.$upperCase_count.'</td></tr>';
    echo '<tr><td>Количество строчных букв: </td><td>'.$lowerCase_count.'</td></tr>';    
    echo '<tr><td>Количество слов: </td><td>'.count($words).'</td></tr></table><br>';

    
    ksort($words);
    echo '<table class="table_view">';
    foreach ($words as $key => $value) {  // выводим слово || кол-во
        echo '<tr><td>' . iconv("cp1251", "utf-8", $key) . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table><br>';

}
function test_symbs( $text ) {
    $symbs=array();

    $l_text = mb_strtolower(iconv("cp1251", "utf-8", $text));

    $l_text = iconv("utf-8", "cp1251", $l_text); 

    for($i=0; $i<strlen($l_text); $i++) {
        if( isset($symbs[$l_text[$i]]) )
            $symbs[$l_text[$i]]++;
        else
            $symbs[$l_text[$i]]=1;
    }
    return $symbs;
}
?>
            <div class='linktomain'><a href='index.php'>Другой анализ</a></div>
        </main>
        <footer>
            <span class="left">
                <span>Все права защищены &copy; by gudzovskiy</span><br>
            </span> 

        </footer>
    </div>
</body>
</html>