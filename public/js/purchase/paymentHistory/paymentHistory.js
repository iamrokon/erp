//202 button on press
$(document).on('click','#topSearchBtn',function(){
  $('#error_msg_div').empty();
  //var dateDeadLine=$('#datepicker1_oen').val();
  var yoteibi_start=$('#yoteibi_start').val();
  var yoteibi_end=$('#yoteibi_end').val();
  var denpyohakkoubi_start=$('#denpyohakkoubi_start').val();
  var denpyohakkoubi_end=$('#denpyohakkoubi_end').val();
  var syouhinid_start=$('#syouhinid_start').val();
  var syouhinid_end=$('#syouhinid_end').val();
  var datachar01_start=$('#datachar01_start').val().substr(1,3);
  var datachar01_end=$('#datachar01_end').val().substr(1,3);
  console.log(datachar01_start);
  console.log(datachar01_end);
  // var rd1=$('#rd1').val();
  var dateCheck1=0;
  var syouhinidCheck=0;
  var dateCheck2=0;
  var datachar01Check=0;

  if (!yoteibi_start && !yoteibi_end){
    dateCheck1=1;
      var dyappend='<p>【処理日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#yoteibi_start,#yoteibi_end").addClass('error');
  }
  else if (!yoteibi_start && yoteibi_end){
    dateCheck1=1;
      var dyappend='<p>【処理日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#yoteibi_end").removeClass('error');
      $("#yoteibi_start").addClass('error');
  }
  else if (!yoteibi_end && yoteibi_start){
    dateCheck1=1;
      var dyappend='<p>【処理日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#yoteibi_start").removeClass('error');
      $("#yoteibi_end").addClass('error');
  }
  else if (yoteibi_start > yoteibi_end){
    dateCheck1=1;
      var dyappend='<p>【処理日】正しい年月日を入力してください。</p>';
      $("#error_msg_div").append(dyappend);
      $("#yoteibi_start,#yoteibi_end").addClass('error');
  }
  else {
      $("#yoteibi_start,#yoteibi_end").removeClass('error');
  }

  if (!denpyohakkoubi_start && !denpyohakkoubi_end){
    dateCheck2=1;
      var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#denpyohakkoubi_start,#denpyohakkoubi_end").addClass('error');
  }
  else if (!denpyohakkoubi_start && denpyohakkoubi_end){
    dateCheck2=1;
      var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#denpyohakkoubi_end").removeClass('error');
      $("#denpyohakkoubi_start").addClass('error');
  }
  else if (!denpyohakkoubi_end && denpyohakkoubi_start){
    dateCheck2=1;
      var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#denpyohakkoubi_start").removeClass('error');
      $("#denpyohakkoubi_end").addClass('error');
  }
  else if (denpyohakkoubi_start > denpyohakkoubi_end){
    dateCheck2=1;
      var dyappend='<p>【支払日】正しい年月日を入力してください。</p>';
      $("#error_msg_div").append(dyappend);
      $("#denpyohakkoubi_start,#denpyohakkoubi_end").addClass('error');
  }
  else {
      $("#denpyohakkoubi_start,#denpyohakkoubi_end").removeClass('error');
  }
  
  if ((syouhinid_start && syouhinid_end) && ((BigInt(syouhinid_start) > BigInt(syouhinid_end)))){
      syouhinidCheck=1;
      var dyappend='<p>【支払番号】支払番号2は支払番号1より大きい番号を入力してください。</p>';
      $("#error_msg_div").append(dyappend);
      $("#syouhinid_start,#syouhinid_end").addClass('error');
  }
  else {
      $("#syouhinid_start,#syouhinid_end").removeClass('error');
  }
  
  if((datachar01_start || datachar01_end) && ((isNaN(datachar01_start) || isNaN(datachar01_end)))){
    datachar01Check=1;
    var dyappend='<p>【支払方法】支払方法2は支払方法1より大きい値を入力してください。</p>';
    $("#error_msg_div").append(dyappend);
    if(isNaN(datachar01_start)){
      $("#datachar01_start").addClass('error');
    }
    if(isNaN(datachar01_end)){
      $("#datachar01_end").addClass('error');
    }
  }else if((datachar01_start && datachar01_end) && ((BigInt(datachar01_start) > BigInt(datachar01_end)))){
      datachar01Check=1;
      var dyappend='<p>【支払方法】支払方法2は支払方法1より大きい値を入力してください。</p>';
      $("#error_msg_div").append(dyappend);
      $("#datachar01_start,#datachar01_end").addClass('error');
  }else{
      $("#datachar01_start,#datachar01_end").removeClass('error');
  }

  // console.log((BigInt(information1_short) > BigInt(information2_short)))

  if (dateCheck1===0 && dateCheck2===0 && syouhinidCheck===0 && datachar01Check===0){
      $("#error_msg_div").empty();
      $("#denpyohakkoubi_start,#denpyohakkoubi_end,#yoteibi_start,#yoteibi_end,#syouhinid_start,#syouhinid_end,#datachar01_start,#datachar01_end").removeClass('error');
      $('#firstSearch').submit();
  }
})
