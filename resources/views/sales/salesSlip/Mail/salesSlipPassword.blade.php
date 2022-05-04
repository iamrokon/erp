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
  以下メールの添付ファイルの解凍パスワードをお知らせします。<br><br>	
    @if(in_array('2', $housoukubun) && in_array('1', $housoukubun))		
    件名: 「売上伝票」「売上伝票兼請求書」送付の件<br>			
    @elseif(in_array('1', $housoukubun))
    件名: 「売上伝票兼請求書」送付の件<br>	
    @else
    件名: 「売上伝票」送付の件<br>	
    @endif				
  				
  送信日時: {{$mytime}}<br>					
  パスワード: {{$password}}<br>
</body>
</html>