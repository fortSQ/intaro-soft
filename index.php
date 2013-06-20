<?php

function getMonth() {
    $month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
    foreach ($month as $i) {
        echo '<option value=' . $i . '>' . $i . '</option>';
    }
}
?>

<html>
    <head>
        <title>Интаро - Дмитрий Романов</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css">
        <script src="jquery-1.10.1.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div id="content">
            <h1>ОТЧЕТ О ПРОВЕДЕНИИ РЕКЛАМНОЙ КАМПАНИИ</h1>
            <form name="ads" action="script.php" method="post" enctype="multipart/form-data">
                <p>Рекламная кампания за период: <select name="begin"><?php getMonth(); ?></select> - <select name="end"><?php getMonth(); ?></select> 2013 года</p>
                <table id="tab">
                    <tr>
                        <td colspan="2">
                            <table id="num">
                                <tr>
                                    <th width="5%">№</th>
                                    <th width="65%">Рекламный носитель<br>(в т.ч. описание, тираж, даты выхода, размер)</th>
                                    <th width="30%">Фактические затраты<br>(заполняются после проведения РК)</th>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td><textarea name="textArea[1]"></textarea></td>
                                    <td><input type="text" name="text[1]"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2"><input type="button" id ="add" value="Добавить еще..."></td></tr>
                    <tr>
                        <th style="text-align: left; width: 70%;">Итого:</th>
                        <th><input type="text" name="sum" value="0"><input type="button" id="getSum" value="Рассчитать"></th>
                    </tr>
                </table>
                <div id="attach">
                    <p>Прикрепить файл (фотоотчет, акт выполненных работ, справка от СМИ):<br><input type="file" name="attach"></p>
                    <p>Дата: <input type="text" name="date"> 2013 года</p>
                </div>
                <div id="submit">
                    <input type="radio" name="type" value="rtf" checked>Формат RTF<br>
                    <input type="radio" name="type" value="docx">Формат DOCX<br>
                    <input type="submit" name="submit" class="but" value="Отправить">
                </div>
            </form>
            <div id="clear"></div>
        </div>
    </body>
</html>