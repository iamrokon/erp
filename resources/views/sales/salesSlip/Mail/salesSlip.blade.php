<!DOCTYPE html>
<html>
<head>
    <title>Mail</title>
</head>
<body>
	{{$max_uriage_data['name']}}<br>		
	{{$max_uriage_data['h_name']}}<br>							
    {{$max_uriage_data['mail2']}}<br>
    {{$max_uriage_data['tantousya']}}&nbsp;様<br><br>											
													
	平素は格別のお引き立てを賜り、厚くお礼申し上げます。<br><br>								
    @if(in_array('2', $housoukubun) && in_array('1', $housoukubun))		
    早速ではございますが、売上伝票 及び 売上伝票兼請求書をお送りさせていただきます。<br>				
    @elseif(in_array('1', $housoukubun))
    早速ではございますが、売上伝票兼請求書をお送りさせていただきます。<br>	
    @else
    早速ではございますが、売上伝票をお送りさせていただきます。<br>	
    @endif								
	
	添付ファイルのパスワードは、別メールにてお送りいたします。<br>
	ご査収くださいますようお願い申し上げます。<br>
	*********************************************************************************<br>									
	ユーザックシステム株式会社<br>								
	〒103-0015　東京都中央区日本橋箱崎町４－３　国際箱崎ビル４階<br>		
	&nbsp;&nbsp; TEL 03-6661-1210　（経理部）	<br>									
	本メールは送信専用です。	<br>											
	*********************************************************************************												

</body>
</html>