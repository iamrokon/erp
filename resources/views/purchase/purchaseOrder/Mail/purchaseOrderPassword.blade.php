@php
    $mytime = Carbon\Carbon::now();
    $mytime->format('Y-m-d h:i');
@endphp


    <!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<br>
本文 以下メールの添付ファイルの解凍パスワードをお知らせします。<br><br>

件名: 「発注書」送付の件<br>
送信日時: {{$passDate}}<br>
パスワード: {{$password}}<br>
</body>
</html>
