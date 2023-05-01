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
        $('#hostname').prop('disabled', true);
        $('#execute').prop('disabled', true);
        $('#result').text('now executing...')
        // Ajax通信を開始する
        $.ajax({
            url: './command',
            type: 'post', // getかpostを指定(デフォルトは前者)
            dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
            data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
                command: $('#command').val(),
                hostname: $('#hostname').val()
            }
        })
        // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
        .done(function (response) {
	        $('#result').empty();
            if (response.command) {
	            $('<pre>execute: '+response.command+'</pre>').appendTo('#result');
            }
	        $('<pre>'+response.result+'</pre>').appendTo('#result');
            $('#hostname').prop('disabled', false);
            $('#execute').prop('disabled', false);
         })
        // ・サーバからステータスコード400以上が返ってきたとき
        // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
        // ・通信に失敗したとき
        .fail(function () {
            // jqXHR, textStatus, errorThrown と書くのは長いので、argumentsでまとめて渡す
            // (PHPのfunc_get_args関数の返り値のようなもの)
            $('#result').text(errorHandler(arguments));
            $('#hostname').prop('disabled', false);
            $('#execute').prop('disabled', false);
         });
    });
    $('#hostname').on("keypress", function(e){
        if (e.keyCode === 13) {
            $('#execute').click();
            return e.which !== 13;
        }
    });
});
