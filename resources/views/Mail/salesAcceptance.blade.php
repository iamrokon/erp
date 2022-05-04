<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>{{$kokyaku->name}}<br>	
	{{$haisou->name}}<br>							
	{{$etsuransya[0]->mail2}}<br>	
	{{$etsuransya[0]->tantousya}}&nbsp;&nbsp;　様	<br><br>											
													
	いつもお世話になっております。<br>								
	ユーザックシステムです。<br><br>											
													
	早速ではございますが、この度の案件の検収確認書を添付ファイルにてお送りさせていただきます。<br>	
	検収をご承認いただける場合は、承認の証しとして、必要事項をご記入いただき、ご捺印の上、<br>	担当営業もしくは担当ＳＥ宛てに、ご返信くださいますようにお願い申し上げます。<br>
	ご承認が難しい場合は、担当営業、担当ＳＥへご一報下さると幸いです。<br><br>							
		
		件名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$tuhanorder->juchukubun1}}<br>
    担当営業&nbsp;&nbsp;&nbsp;&nbsp;{{$tantousya->name}}（{{$tantousya->mail}}）&nbsp;{{$tantousya->mail3}}<br>
    @if(!empty($misyukko))
    担当SE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$misyukko->name}}（{{$misyukko->mail}}）&nbsp;{{$misyukko->mail3}}<br>
    @endif

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>	
	お手数をおかけしますが、どうぞよろしくお願い申し上げます。<br>		
    
										
	*********************************************************************************<br>								
	ユーザックシステム株式会社　　システム課	<br>
	〒103-0015　東京都中央区日本橋箱崎町４－３&nbsp;　国際箱崎ビル４階<br>
	&nbsp;&nbsp;TEL 03-6661-1210	<br>									
	本メールは送信専用です。	<br>											
	*********************************************************************************												
													

</body>
</html>