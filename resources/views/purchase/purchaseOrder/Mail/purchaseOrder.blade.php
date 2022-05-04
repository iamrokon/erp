<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>{{$vendorName}}<br>
{{$address}}<br>
@if($departmentNameFlag!=null)
{{$departmentName}}<br>
@endif
{{$vendorPersonalName}}&nbsp;&nbsp;様	<br><br>

いつもお世話になっております。<br><br>
早速ではございますが、発注書をお送りさせていただきます。<br>
添付ファイルのパスワードは、別メールにてお送りいたします。<br>
ご手配くださいますようお願い申し上げます。<br><br>

発注番号：{{$orderNumber}} <br> <br>

*********************************************************************************<br>
ユーザックシステム株式会社　　システム課	<br>
〒103-0015　東京都中央区日本橋箱崎町４－３　国際箱崎ビル４階<br><br>

本メールは送信専用です。<br>
*********************************************************************************


</body>
</html>
