<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
if ($_POST['submit']) {
    // Выбор формата файла отчета
    if ($_POST['type'] === 'docx') {
        require_once 'phpword/PHPWord.php';
        $PHPWord = new PHPWord();
        $section = $PHPWord->createSection();
        $section->addText('ОТЧЕТ О ПРОВЕДЕНИИ РЕКЛАМНОЙ КАМПАНИИ', array('bold' => true, 'size' => 18));
        $section->addTextBreak(1);
        $text = 'Рекламная кампания за период ' . $_POST['begin'] . ' - ' . $_POST['end'] . ' 2013 года';
        $section->addText($text);
        $section->addTextBreak(1);
        $table = $section->addTable();
        // формируем шапку
        $table->addRow();
        $table->addCell(600)->addText('№', array('bold' => true));
        $table->addCell(4900)->addText('Рекламный носитель (в т.ч. описание, тираж, даты выхода, размер)', array('bold' => true));
        $table->addCell(4000)->addText('Фактические затраты (заполняются после проведения РК)', array('bold' => true));
        // пока существует, выводим информацию из каждой строки
        $i = 1;
        while (isset($_POST['text'][$i])) {
            $table->addRow();
            $table->addCell(600)->addText($i);
            $table->addCell(4900)->addText($_POST['textArea'][$i]);
            $table->addCell(4000)->addText($_POST['text'][$i]);
            $i++;
        }
        // подводим итог
        $table->addRow();
        $table->addCell(600)->addText('Итог', array('bold' => true));
        $table->addCell(4900)->addText('');
        $table->addCell(4000)->addText($_POST['sum']);
        $section->addTextBreak(1);
        // выводим дату отчета
        $text = 'Дата: ' . $_POST['date'] . ' 2013 года';
        $section->addText($text);
        // сохраняем документ
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $date_day = (date("G-i-s--d-M-Y"));
        $dir = 'reports/' . $date_day;
        mkdir($dir);
        $file = $dir . '/doc.docx';
        $objWriter->save($file);
    } else {
        require_once 'phprtflite/PHPRtfLite.php';
        PHPRtfLite::registerAutoloader();
        $rtf = new PHPRtfLite();
        $sect = $rtf->addSection();
        $sect->writeText('<b>ОТЧЕТ О ПРОВЕДЕНИИ РЕКЛАМНОЙ КАМПАНИИ</b><br>', new PHPRtfLite_Font(16), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER));
        $text = 'Рекламная кампания за период ' . $_POST['begin'] . ' - ' . $_POST['end'] . ' 2013 года';
        $sect->writeText($text);
        $sect->writeText('<br>');
        // формируем шапку
        $table = $sect->addTable();
        $table->addColumnsList(array_fill(0, 3, 5));
        $table->addRow(1);
        $cell = $table->getCell(1, 1);
        $cell->writeText('<b>№</b>');
        $cell = $table->getCell(1, 2);
        $cell->writeText('<b>Рекламный носитель<br>(в т.ч. описание, тираж, даты выхода, размер)</b>');
        $cell = $table->getCell(1, 3);
        $cell->writeText('<b>Фактические затраты<br>(заполняются после проведения РК)</b>');
        // пока существует, выводим информацию из каждой строки
        $i = 1;
        while (isset($_POST['text'][$i])) {
            $table->addRow(1);
            $cell = $table->getCell($i + 1, 1);
            $cell->writeText($i);
            $cell = $table->getCell($i + 1, 2);
            $cell->writeText($_POST['textArea'][$i]);
            $cell = $table->getCell($i + 1, 3);
            $cell->writeText($_POST['text'][$i]);
            $i++;
        }
        // подводим итог
        $i++;
        $table->addRow(1);
        $cell = $table->getCell($i, 1);
        $cell->writeText('<b>Итог</b>');
        $cell = $table->getCell($i, 2);
        $cell->writeText('');
        $cell = $table->getCell($i, 3);
        $cell->writeText($_POST['sum']);
        // выводим дату отчета
        $text = 'Дата: ' . $_POST['date'] . ' 2013 года';
        $sect->writeText($text);
        // сохраняем документ
        $date_day = (date("G-i-s--d-M-Y"));
        $dir = 'reports/' . $date_day;
        mkdir($dir);
        $file = $dir . '/doc.rtf';
        $rtf->save($file);
    }
    //сохраняем файл-вложение и выводим ссылку на него
    if (!empty($_FILES['attach']['tmp_name'])) {
        $filedir = $dir . '/' . $_FILES['attach']['name'];
        copy($_FILES['attach']['tmp_name'], $filedir);
        echo 'Ссылка на файл: <a href="' . $filedir . '">скачать</a>';
    }
    // переходим на только что созданный файл
    echo '<meta http-equiv="refresh" content="0;URL=' . $file . '">';
}
?>
