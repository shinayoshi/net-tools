/* エラー文字列の生成 */
function errorHandler(args) {
    var error;
    // errorThrownはHTTP通信に成功したときだけ空文字列以外の値が定義される
    if (args[2]) {
        try {
            // JSONとしてパースが成功し、且つ {"error":"..."} という構造であったとき
            // (undefinedが代入されるのを防ぐためにtoStringメソッドを使用)
            error = $.parseJSON(args[0].responseText).error.toString();
        } catch (e) {
            // パースに失敗した、もしくは期待する構造でなかったとき
            // (PHP側にエラーがあったときにもデバッグしやすいようにレスポンスをテキストとして返す)
            error = 'parsererror(' + args[2] + '): ' + args[0].responseText;
        }
    } else {
        // 通信に失敗したとき
        error = args[1] + '(HTTP request failed)';
    }
    return error;
}

// DOMを全て読み込んだあとに実行される
$(function () {
    // 「#execute」をクリックしたとき
    $('#execute').click(function (e) {
        // Ajax通信を開始する
        $.ajax({
            url: './captcha',
            type: 'post', // getかpostを指定(デフォルトは前者)
            dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
            data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
                captcha_code: $('#captcha_code').val()
            }
        })
        // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
        .done(function (response) {
            $('#result').empty();
            if (response.captcha_auth) {
                $('#captcha_auth').hide();
                $('#command').show();
                $('#result').addClass('alert alert-success');
                $('<p>CAPTCHA authentication is success.</p>').appendTo('#result');
            } else {
                $('#captcha').attr('src', './securimage/securimage_show?'+Math.random());
                $('#captcha_code').val('');
                $('#result').addClass('alert alert-warning');
                $('<p>CAPTCHA authentication is failure.</p>').appendTo('#result');
            }
        })
        // ・サーバからステータスコード400以上が返ってきたとき
        // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
        // ・通信に失敗したとき
        .fail(function () {
            // jqXHR, textStatus, errorThrown と書くのは長いので、argumentsでまとめて渡す
            // (PHPのfunc_get_args関数の返り値のようなもの)
            $('#result').text(errorHandler(arguments));
        });
    });
    $('#captcha_code').on("keypress", function(e){
        if (e.keyCode === 13) {
            $('#execute').click();
            return e.which !== 13;
        }
    });
});
