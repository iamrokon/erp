// $("body").on("click", "#orderEntrySubmitBtn", function (e) {
//     e.preventDefault();
//     var data = $("#insertData").serialize();
    
//     var payment_method = $("#reg_kessaihouhou").val();
//     var acceptance_condition = $("#reg_chumonsyajouhou").val();
//     var sales_standard = $("#reg_soufusakijouhou").val();
//     var immediate_version = $("#reg_housoukubun").val();
//     data += '&payment_method=' + encodeURIComponent(payment_method) + '&acceptance_condition=' + encodeURIComponent(acceptance_condition) + '&sales_standard=' + encodeURIComponent(sales_standard) + '&immediate_version=' + encodeURIComponent(immediate_version);
//     var bango = $("input[id='userId']").val();
//     $("input[name=type]").val("create")
//     console.log(data);
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('#csrf').val()
//         },
//         type: "POST",
//         url: "hatchu-nyuryoku/register/" + bango,
//         type: "POST",
//         data: data,
//         success: function (result) {
//             console.log(result)
//             if ($.trim(result.status) == 'ok') {
//                 console.log('done');
//             }else{
//                 var inputError = result.err_field;
//                 var inputErrorMsg = result.err_msg;
//                 if (inputError || inputErrorMsg ) {
//                     // $('#orderEntrySubmitBtn').prop("disabled", false);
//                         if (inputError) {
//                             for (const err_field in inputError) {
//                                 var targetEl = '';
//                                 if (err_field.indexOf('.') > -1) {
//                                     const [inputName, key] = err_field.split('.');
//                                     targetEl = $("input[name='" + inputName + "[]']").eq(key);
//                                 } else {
//                                     targetEl = $("input[name=" + err_field + "]")
//                                 }
//                                 targetEl.addClass("error")
//                                 var idList = targetEl.prop('id');
//                                 if (idList && idList.search("_db")) {
//                                     targetEl.parents('.input-group').find("input[type=text]").addClass('error')
//                                 }
//                             }
//                         }
//                 }
//                 var html = '';
//                 if (inputErrorMsg ) {
//                     html = '<div style="margin-top: 8px;">';
//                     if (inputErrorMsg) {
//                         for (var count = 0; count < inputErrorMsg.length; count++) {
//                             var error_message = inputErrorMsg[count];
//                             // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
//                             html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + error_message + '</p>';
//                         }
//                     }
//                     // var errorMsgQuantity = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">単価と金額に差異がありますので、ご確認の上、再登録お願いします。</p>';
                    
//                     html += '</div>';
//                     $('#error_data').html(html);
//                     $("#error_data").show();
//                 }
//                 console.log(result)
//             }

//         }
//     })
// })

// $(document).on("click", ".lineBtn", function (e) {
//     e.preventDefault();
//         // get the last DIV which ID starts with ^= "klon"
//     var $div = $('div[id^="LineBranch"]:last');
//     // alert($div.prop("id"));
//     // Read the Number from that DIV's ID (i.e: 3 from "klon3")
//     // And increment that number by 1
//     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
//     // alert(num);
//     // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
//     var $klon = $div.clone().prop('id', 'LineBranch'+num );
//     $klon.find(".lineValue").text(num);
//     // alert($klon.find(".lineValue").text());
//     // Finally insert $klon wherever you want
//     $div.after( $klon);
//   });


