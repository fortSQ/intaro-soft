$(document).ready(function(e) {
    // добавление нового поля таблицы
    $("#add").click(function(e) {
        var index = $('#num tr').length;
        var html = '<tr><td>' + index + '</td><td><textarea name="textArea[' + index + ']"></textarea></td><td><input type="text" name="text[' + index + ']"></td></tr>';
        $("#num").append(html);
    });
    $("#getSum").click(function(e) {
        var sum = 0;
        var index = $('#num tr').length;
        for (var i = 1; i < index; i++) {
            var num = $("input[name='text[" + i + "]']").val();
            if (parseInt(num)) {
                sum += parseInt(num);
            } else {
                alert('Проверьте правильность записи чисел в Фактических затратах!');
                return;
            }
        }
        $("input[name='sum']").val(sum);
    });
});