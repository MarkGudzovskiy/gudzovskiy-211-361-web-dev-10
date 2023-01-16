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
            <div class="inline">Анализ текста</div>
        </header>
        <main>
            <form name="analysis" action="result.php" enctype="multipart/form-data" method="post">
                <label>Введите текст для анализа</label><br>
                <textarea name="data"></textarea><br>
                <input type="submit" value="Анализировать" class="btn">
                
            </form>
            


        </main>
        <footer>
            <span class="left">
                <span>Все права защищены &copy; by krivtsova</span><br>
            </span> 

        </footer>
    </div>
</body>
</html>

