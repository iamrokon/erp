//202 button on press
$(document).on('click','#topSearchBtn',function(){
  console.log("tttt");
  $('#error_msg_div').empty();
  var reg_sold_to_db=$('#reg_sold_to_db').val();
  var reg_sold_to_check=0;

  if (!reg_sold_to_db){
    reg_sold_to_check=1;
      var dyappend='<p>【仕入先】必須項目に入力がありません。</p>';
      $("#error_msg_div").append(dyappend);
      $("#reg_sold_to").addClass('error');
  }
  else {
      $("#reg_sold_to").removeClass('error');
  }

  if (reg_sold_to_check===0){
      $("#error_msg_div").empty();
      $("#reg_sold_to").removeClass('error');
      $('#firstSearch').submit();
  }
})

$("#insertData input").keyup(function(){
  $("#kaiin_register_status").val(0);
});

$("#insertData select").change(function(){
  $("#kaiin_register_status").val(0);
  // var curr_val = $(this).val()
  // //$(this).val(curr_val).change()
  // var selectedIndex = $(this).prop("selectedIndex");
  // $(this).prop("selectedIndex", selectedIndex);
  // //$(this).change();
  // console.log('select val: '+$(this).val())
});

$("#choice_buttonApi2").click(function(){
  $("#kaiin_register_status").val(0);
});
$("#productSelect").click(function(){
  $("#kaiin_register_status").val(0);
});