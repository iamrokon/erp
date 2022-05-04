$(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("support_entry_success_msg"))
    {
       createSuccessMessage(localStorage.getItem("support_entry_success_msg"));
       localStorage.removeItem("support_entry_success_msg");
    }
});


$("#supportEntrySubmitBtn").on("click", function (e) {
        $(this).prop("disabled", true);
        e.preventDefault();
        var bango = $("input[id='userId']").val();
        $("#formSubmitButton").val("create")
        var data = new FormData(document.getElementById('insertData'));
        //$("input[name='payment_method'] ").val(payment_method)

         $.ajax({
                url: "support-entry/register/" + bango,
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response){
                    if(response.err_field){
                        // show the error
                        var inputErrorMsg = response.err_msg;
                        var html = '';
                        html = '<div>';
                        var number_search_flag = 0;
                        var datepicker11_oen_flag = 0;
                        var order_summary_remarks_flag = 0;
                        var order_shipping_remarks_209_flag = 0;
                        var information7_in_house_remarks_flag = 0;
                        var datatxt0004_216_flag = 0;

                        var include_place_flag = 0;
                        var model_name_flag = 0;
                        var juchukubun1_business_name_flag = 0;
                        var os_flag = 0;
                        var acceptance_condition_flag = 0;
                        var consultation_person_name_flag = 0;

                        if (inputErrorMsg) {
                            for (var count = 0; count < inputErrorMsg.length; count++) {
                                var error_message = inputErrorMsg[count];
                                html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + error_message + '</p>';
                                // number search
                                var error_message_count = 0;
                                if(error_message == "【番号検索】必須項目に入力がありません。10文字以下で入力してください。"){
                                    if(!$("#number_search").hasClass("error")){
                                        $("#number_search").addClass("error");
                                    }
                                    error_message_count++;
                                    number_search_flag = 1;
                                }


                                // datepicker11_oen
                                if(error_message == "【サポート納期】必須項目に入力がありません。"){
                                    if(!$("#datepicker11_oen").hasClass("error")){
                                        $("#datepicker11_oen").addClass("error");
                                    }
                                    error_message_count++;
                                    datepicker11_oen_flag = 1;
                                }


                                if(error_message == "【納入場所】全角文字以外は使用できません。" || error_message == "【納入場所】40桁以下で入力してください。"){
                                    if(!$("#include_place").hasClass("error")){
                                        $("#include_place").addClass("error");
                                    }
                                    error_message_count++;
                                    include_place_flag = 1;
                                }


                                if(error_message == "【機種名】全角文字以外は使用できません。" || error_message == "【機種名】40桁以下で入力してください。"){
                                    if(!$("#model_name").hasClass("error")){
                                        $("#model_name").addClass("error");
                                    }
                                    error_message_count++;
                                    model_name_flag = 1;
                                }


                                if(error_message == "【業務名】全角文字以外は使用できません。" || error_message == "【業務名】40桁以下で入力してください。"){
                                    if(!$("#juchukubun1_business_name").hasClass("error")){
                                        $("#juchukubun1_business_name").addClass("error");
                                    }
                                    error_message_count++;
                                    juchukubun1_business_name_flag = 1;
                                }
                                
                                if(error_message == "【相談SE】40桁以下で入力してください。"){
                                    if(!$("#consultation_person_name").hasClass("error")){
                                        $("#consultation_person_name").addClass("error");
                                    }
                                    error_message_count++;
                                    consultation_person_name_flag = 1;
                                }


                                if(error_message == "【OS】全角文字以外は使用できません。" || error_message == "【OS】40桁以下で入力してください。"){
                                    if(!$("#os").hasClass("error")){
                                        $("#os").addClass("error");
                                    }
                                    error_message_count++;
                                    os_flag = 1;
                                }


                                if(error_message == "【社内備考】全角文字以外は使用できません。"){
                                    if(!$("#information7_in_house_remarks").hasClass("error")){
                                        $("#information7_in_house_remarks").addClass("error");
                                    }
                                    error_message_count++;
                                    information7_in_house_remarks_flag = 1;
                                }


                                if(error_message == "【発注出荷備考】全角文字以外は使用できません。"){
                                    if(!$("#order_shipping_remarks_209").hasClass("error")){
                                        $("#order_shipping_remarks_209").addClass("error");
                                    }
                                    error_message_count++;
                                    order_shipping_remarks_209_flag = 1;
                                }



                                if(error_message == "【受注概要や留意点】必須項目に入力がありません。" || 
                                    error_message == "【受注概要や留意点】全角文字以外は使用できません。"){
                                    if(!$("#order_summary_remarks").hasClass("error")){
                                        $("#order_summary_remarks").addClass("error");
                                    }
                                    error_message_count++;
                                    order_summary_remarks_flag = 1;
                                }

                                if(error_message == "【検収条件】全角文字以外は使用できません。"){
                                    if(!$("#acceptance_condition").hasClass("error")){
                                        $("#acceptance_condition").addClass("error");
                                    }
                                    error_message_count++;
                                    acceptance_condition_flag = 1;
                                }


                                if(error_message == "【サポート部門】必須項目に入力がありません。"){
                                    if(!$("#datatxt0004_216").hasClass("error")){
                                        $("#datatxt0004_216").addClass("error");
                                    }
                                    error_message_count++;
                                    datatxt0004_216_flag = 1;
                                }

                                if(error_message_count > 0){
                                    window.scrollTo(0, 0);
                                }
                            }
                        }

                        // remove the error_data if exist
                       // console.log("datepicker11_oen_flag : " + datepicker11_oen_flag)
                        if(number_search_flag == 0 && $("#number_search").hasClass("error")){
                            $('#number_search').removeClass("error");
                        }

                        if(datepicker11_oen_flag == 0 && $("#datepicker11_oen").hasClass("error")){
                            $('#datepicker11_oen').removeClass("error");
                        }


                        // start
                        if(include_place_flag == 0 && $("#include_place").hasClass("error")){
                            $('#include_place').removeClass("error");
                        }

                        if(model_name_flag == 0 && $("#model_name").hasClass("error")){
                            $('#model_name').removeClass("error");
                        }

                        if(juchukubun1_business_name_flag == 0 && $("#juchukubun1_business_name").hasClass("error")){
                            $('#juchukubun1_business_name').removeClass("error");
                        }

                        if(consultation_person_name_flag == 0 && $("#consultation_person_name").hasClass("error")){
                            $('#consultation_person_name').removeClass("error");
                        }

                        if(os_flag == 0 && $("#os").hasClass("error")){
                            $('#os').removeClass("error");
                        }

                        if(acceptance_condition_flag == 0 && $("#acceptance_condition").hasClass("error")){
                            $('#acceptance_condition').removeClass("error");
                        }


                        // end




                        if(information7_in_house_remarks_flag == 0 && $("#information7_in_house_remarks").hasClass("error")){
                            $('#information7_in_house_remarks').removeClass("error");
                        }


                        if(order_shipping_remarks_209_flag == 0 && $("#order_shipping_remarks_209").hasClass("error")){
                            $('#order_shipping_remarks_209').removeClass("error");
                        }

                        if(order_summary_remarks_flag == 0 && $("#order_summary_remarks").hasClass("error")){
                            $('#order_summary_remarks').removeClass("error");
                        }

                        if(datatxt0004_216_flag == 0 && $("#datatxt0004_216").hasClass("error")){
                            $('#datatxt0004_216').removeClass("error");
                        }

                       
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                        $("#submit_confirmation").val('');

                        $('#supportEntrySubmitBtn').prop("disabled", false);
                    }else{
                        if(($.trim(response) == 'confirm')){
                            $('#supportEntrySubmitBtn').prop("disabled", false);
                            $("#submit_confirmation").val('submit');
                            $('#error_data').html("");
                            $("#error_data").hide();
                            removeErrorIfExist();
                            var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;"> 登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。</p>';
                            $(document).find("#confirmation_message").html(confirmationMsg);
                        }else{
                            // createSuccessMessage(response.success_msg);
                           // window.scrollTo(0, 0);
                           $('#error_data').html("");
                           $("#error_data").hide();
                           $(document).find("#confirmation_message").html("");
                           localStorage.setItem("support_entry_success_msg", response.success_msg);
                           window.location.reload(); 
                        } 
                    }
                },
                error: function (error){
                    console.log("error")
                }
        });
});


// remove error if previous error hold
function removeErrorIfExist(){
    if($("#number_search").hasClass("error")){
         $('#number_search').removeClass("error");
    }

    if($("#datepicker11_oen").hasClass("error")){
        $('#datepicker11_oen').removeClass("error");
    }


    if($("#include_place").hasClass("error")){
        $('#include_place').removeClass("error");
    }

    if($("#model_name").hasClass("error")){
        $('#model_name').removeClass("error");
    }

    if($("#juchukubun1_business_name").hasClass("error")){
        $('#juchukubun1_business_name').removeClass("error");
    }

    if($("#consultation_person_name").hasClass("error")){
        $('#consultation_person_name').removeClass("error");
    }
    if($("#os").hasClass("error")){
        $('#os').removeClass("error");
    }

    if($("#acceptance_condition").hasClass("error")){
        $('#acceptance_condition').removeClass("error");
    }

    if($("#information7_in_house_remarks").hasClass("error")){
        $('#information7_in_house_remarks').removeClass("error");
    }


    if($("#order_shipping_remarks_209").hasClass("error")){
        $('#order_shipping_remarks_209').removeClass("error");
    }

    if($("#order_summary_remarks").hasClass("error")){
        $('#order_summary_remarks').removeClass("error");
    }

    if($("#datatxt0004_216").hasClass("error")){
        $('#datatxt0004_216').removeClass("error");
    }
}



function createSuccessMessage(message) {
    if ($(document).find("#successMsg")) {
        $(document).find("#successMsg").remove();
    }
    var success_html = `
    <div class="row success-msg-box" id="successMsg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: block;">
        <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
                    <strong id="success_data">${message}</strong>
            </div>
        </div>
    </div>
    `;
    $("#error_data").before(success_html)
}



function errorDataSubmit(response) {
    console.log("error")
    $('#supportEntrySubmitBtn').prop("disabled", false);
}

function successDataSubmit(result) {
    console.log("success submit");
}