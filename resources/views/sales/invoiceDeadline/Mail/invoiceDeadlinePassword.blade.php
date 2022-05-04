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
  以下メールの添付ファイルの解凍パスワードをお知らせします。<br> <br>  

  件名: 「請求書」送付の件<br> 
  送信日時:{{$mytime}}<br> 
  パスワード: {{$data->password}}<br> 

</body>
</html>