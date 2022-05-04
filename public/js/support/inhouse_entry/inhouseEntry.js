buttonPress = 0;
function registerInhouseEntry() {
    //check split item added or not added
    $len = $("#order_details > tr").length;
    if($len<1){
       alert("Please enter line data");
       return false;
    }
    
    costExceedCal();
    
    checkSumOf205();
	
    var syouhizeiritu_se = $("#hidden_sum_of_minyuko_syouhizeiritu_se").val();
    var syouhizeiritu = $("#hidden_sum_of_minyuko_syouhizeiritu").val();
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    
    var bango = $("input[id='userId']").val();
    var data = $('#mainForm').serialize();
    
    $.ajax({
        type: 'POST',
        url: "inhouseEntry/registerInhouseEntry/" + bango,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#error_data").hide();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                
                //balance check
                if(syouhizeiritu_se != syouhizeiritu){
                    $(document).find("#confirmation_message").html("");
                    var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">内作調整後の金額が元金額と異なります。</p>';
                    $(document).find("#error_data").html(err_msg);
                    $("#error_data").show();
                    return false;
                }
                
                //err check
                //var se_checking_amount = parseInt($("#se_checking_amount").val());
                //var sum_of_205 = parseInt($("#sum_of_205").val());
                //if(se_checking_amount != sum_of_205){
                //    $(document).find("#confirmation_message").html("");
                //    var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">内作調整後の金額が元明細金額と異なります。</p>';
                //    $(document).find("#error_data").html(err_msg);
                //    $("#error_data").show();
                //    return false;
                //}
                
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
            }else if ($.trim(result) == 'ng'){
		$(document).find("#confirmation_message").html("");
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                var number_search = $("#number_search").val();
                var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">サポート番号'+number_search+'の登録に失敗しました。'+'</p>';
                $(document).find("#error_data").html(errMsg);
		$("#error_data").show();
            }else if ($.trim(result) == 'not_ok'){
		$(document).find("#confirmation_message").html("");
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                var number_search = $("#number_search").val();
                var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">内作調整後の金額が元明細金額と異なります。</p>';
                $(document).find("#error_data").html(errMsg);
		$("#error_data").show();
            }else if ($.trim(result.status) == 'cost_exceed_err'){
                $(document).find("#confirmation_message").html("");
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                var errMsg = $.trim(result.msg);
                $(document).find("#error_data").html(errMsg);
                $("#error_data").show();
            }  else {
                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");

                //check front validation after submit
                //checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

                var html = '';
                if (result.err_msg) {
                    html = '<div>';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_data').html(html);

                    if (true) {
                    }
                    $("#error_data").show();
                }

                
                
                //array field error
                var temp_err_key = [];
                for (const err_field in inputError) {
                    var targetEl = '';
                    var selectInputs = ["datachar01"];
                    if (err_field.indexOf('.') > -1) {
                        const [inputName, key] = err_field.split('.');
                        temp_err_key[key] = key;
                        if (inputName && selectInputs.indexOf(inputName) >= 0) {
                            targetEl = $("select[name='" + inputName + "[]']").eq(key)
                        } else {
                            targetEl = $("input[name='" + inputName + "[]']").eq(key)
                        }
                    } else {
                        if (err_field && selectInputs.indexOf(err_field) >= 0) {
                            targetEl = $("select[name=" + err_field + "]")
                        } else {
                            targetEl = $("input[name=" + err_field + "]")
                        }
                    }
                    targetEl.addClass("error");
                    //targetEl.css('cssText', 'border:1px solid red  !important;border-radius: 4px !important');
                }
                
                //remove error class
                $('input[name="datachar01[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
			//$(this).css('cssText', 'border:1px solid #E1E1E1 !important;border-radius: 4px !important')
                    } 
                });
				
		$('input[name="minyuko_nyukosu[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
                        //$(this).css('cssText', 'border:1px solid #E1E1E1 !important;border-radius: 4px !important')
                    } 
                });
				
		$('input[name="minyuko_genka[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
			//$(this).css('cssText', 'border:1px solid #E1E1E1 !important;border-radius: 4px !important')
                    } 
                });

            }
        }
    });
}

function numberSearchModalOpener(targetId) {
    $(this).prop('disabled', true)
    //$('.modal-backdrop').remove();
    // var source = $("input[id=source]").val()
    // if (source == 'orderHistory') {
    //     var targetEl = $(this).parents('.input-group').find('.form-control').attr('id')
    //     $("#targetId").val(targetEl)
    // }
    var bango = $("input[id='userId']").val();
    var data101 = $('#categorikanri option:selected').text();
    var data102 = $('#request option:selected').text();
    var category_kanri_def = $('#categorikanri option:selected').val();
    var request_def = $('#request option:selected').val();
    $.ajax({
        url: '/inhouseEntry/number-search-modal-data/' + bango,
        type: 'POST',
        data: {
            'bango': bango,
            'data101': data101,
            'data102': data102,
            "_token": $('#csrf').val(),
            category_kanri_def,
            request_def
        },
        success: function (response) {
            var targetEl = $('#insert_partial_modal')
            var prevEl = targetEl.prevAll();
            if (prevEl) {
                prevEl.remove()
            }
            targetEl.before(response.html);
            //$("#targetId").val(targetId)
            localStorage.setItem("numberTargetId", targetId)
            $("#select-order-detail").prop('disabled', true)
            $("#request_def").val(request_def)
            $("#category_kanri_def").val(category_kanri_def)
            $('#numberSearchModal').modal("show");
        }
    })
}

function searchData(){
	var bango = $("input[id='userId']").val();
	$("#Button").val("Thesearch");
    $.ajax({
        type: "POST",
        data: $('#numberForm').serialize(),
        url: "/inhouseEntry/handle-number-search/" + bango,
        success: function (response) {
            $('.number_search_partial_html').remove();
            $('#insert_partial_modal').before(response.html);
        }
    })
}

function sortingData(field) {
    buttonPress++;
    if (buttonPress == 1) {
        var previousSort = document.getElementById('sortType').value;
        var previousField = document.getElementById('sortField').value;

        if (previousField && previousSort) {
            if (previousField == field) {
                if (previousSort == 'ASC') {
                    sortOrder = 'DESC';
                } else {
                    sortOrder = 'ASC';
                }
            } else {
                sortOrder = 'ASC';
            }
        } else {
            sortOrder = 'ASC';
        }

        document.getElementById('sortType').value = sortOrder;
        document.getElementById('sortField').value = field;
        document.getElementById('Button').value = 'sort';  

		var bango = $("input[id='userId']").val();
		$.ajax({
			type: "POST",
			data: $('#numberForm').serialize(),
			url: "/inhouseEntry/handle-number-search/" + bango,
			success: function (response) {
				$('.number_search_partial_html').remove();
				$('#insert_partial_modal').before(response.html);
				buttonPress = 0;
			}
		})
        
    } else {
        doubleClick();
    }
}

function goNextPage() {
    buttonPress++;
    if (buttonPress == 1) {

        document.getElementById('paginationhelper').disabled = false;
        var i = document.getElementById("paginate").value;

        if (i < 1) {
            document.getElementById("paginationhelper").value = 1;
        } else {
            document.getElementById("paginationhelper").value = ++i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }
        document.getElementById('paginate').disabled = true;
        document.getElementById('paginationhelper').disabled = false;
        
        var bango = $("input[id='userId']").val();
		$.ajax({
			type: "POST",
			data: $('#numberForm').serialize(),
			url: "/inhouseEntry/handle-number-search/" + bango,
			success: function (response) {
				$('.number_search_partial_html').remove();
				$('#insert_partial_modal').before(response.html);
				buttonPress = 0;
			}
		})
    } else {
        doubleClick();
    }
}

function goPreviouPage() {
    buttonPress++;
    if (buttonPress == 1) {
        document.getElementById('paginationhelper').disabled = false;

        var i = document.getElementById("paginate").value;
        if (i <= 1) {
            document.getElementById("paginationhelper").value = 1;
        } else {
            document.getElementById("paginationhelper").value = --i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }
        document.getElementById('paginate').disabled = true;
        document.getElementById('paginationhelper').disabled = false;
        
        var bango = $("input[id='userId']").val();
		$.ajax({
			type: "POST",
			data: $('#numberForm').serialize(),
			url: "/inhouseEntry/handle-number-search/" + bango,
			success: function (response) {
				$('.number_search_partial_html').remove();
				$('#insert_partial_modal').before(response.html);
				buttonPress = 0;
			}
		})
    } else {
        doubleClick();
    }
}

function goCustomPage() {
    buttonPress++;
    if (buttonPress == 1) {

        var i = document.getElementById("paginate").value;

        if (i < 1) {
            document.getElementById("paginate").value = 1;
        } else {
            document.getElementById("paginate").value = i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }

        var bango = $("input[id='userId']").val();
		$.ajax({
			type: "POST",
			data: $('#numberForm').serialize(),
			url: "/inhouseEntry/handle-number-search/" + bango,
			success: function (response) {
				$('.number_search_partial_html').remove();
				$('#insert_partial_modal').before(response.html);
				buttonPress = 0;
			}
		})
    } else {
        doubleClick();
    }
}

function refreshData() {
    buttonPress++;
    if (buttonPress == 1) {
        document.getElementById("paginate").value = 1;
        document.getElementById('Button').value = 'refresh';
        
        var bango = $("input[id='userId']").val();
        $.ajax({
            type: "POST",
            data: $('#numberForm').serialize(),
            url: "/inhouseEntry/handle-number-search/" + bango,
            success: function (response) {
                    $('.number_search_partial_html').remove();
                    $('#insert_partial_modal').before(response.html);
                    buttonPress = 0;
            }
        })
    } else {
        doubleClick();
    }
}

function doubleClick() {
    alert('処理中です');
}


$(document).on("click", ".number_search_show", function () {
    $("#select-order-detail").prop('disabled', false);
})

$("#number_search").keyup(function(){
	var order_id = $(this).val();
	if(order_id.length == 10){
		$(".success-msg-box").css("display","none");
		var bango = $("input[id='userId']").val();
		$.ajax({
			url: '/inhouseEntry/order_detail_read/' + bango,
			type: 'GET',
                        async:false,
			data: {
				'bango': bango,
				'order_id': order_id,
				'req_type': 'input'
			},
			success: function (response) {
				console.log(response);
                                
				if(response.total_row > 0){
                                        
                                        $("#regButton").prop('disabled',false);
                                    
                                        var review_orderbango = parseInt($("#review_orderbango").val());
                                        var ordertypebango2 = response.orderDetail[0].ordertypebango2;
                                        var se_checking_amount = response.orderDetail[0].se_checking_amount;
                                        if(ordertypebango2 >= review_orderbango){
                                            $("#regButton").prop('disabled',true);
                                            var msg = "訂正回数が上限値"+review_orderbango+"回に達しました。";
                                            $("#modal_content").html(msg);
                                            $("#alert_pop_up_modal").modal('show');
                                            $('#numberSearchModal').modal("hide");
                                            return false;
                                        }

					$(document).find("#error_data").html("");
					
					var minyuko_bango = response.orderDetail[0].bango;
					var support_number = response.orderDetail[0].support_number;
					var information1 = response.orderDetail[0].information1;
					var information1_detail = response.orderDetail[0].information1_detail;
					var information3 = response.orderDetail[0].information3;
					var information3_detail = response.orderDetail[0].information3_detail;
					var orderuserbango = response.orderDetail[0].orderuserbango;
					var intorder01 = response.orderDetail[0].intorder01;
					var datachar09 = response.orderDetail[0].user_name_short;
					$("#minyuko_bango").val(minyuko_bango);
					$("#number_search").val(support_number);
					$("#information1").val(information1);
					$("#information1_detail").val(information1_detail);
					$("#information3").val(information3);
					$("#information3_detail").val(information3_detail);
					$("#orderuserbango").val(orderuserbango);
					$("#intorder01").val(intorder01);
					$("#datachar09").val(datachar09);
					
					$("#order_details").html(response.html);
					$("#hidden_sum_of_minyuko_syouhizeiritu").val(response.sum_of_minyuko_syouhizeiritu);
					$("#sum_of_minyuko_syouhizeiritu").html(response.formatted_sum_of_minyuko_syouhizeiritu);
					$("#hidden_sum_of_minyuko_syouhizeiritu_se").val(response.sum_of_minyuko_syouhizeiritu);
					$("#sum_of_minyuko_syouhizeiritu_se").html(response.formatted_sum_of_minyuko_syouhizeiritu);
					$("#max_minyuko_syouhinsyu").val(response.max_minyuko_syouhinsyu);
					$("#se_checking_amount").val(se_checking_amount);
					$("#sum_of_205").val(response.sum_of_205);
                                        $("#total_parent").val(response.max_minyuko_syouhinsyu);
                                        $("#count_deleted_parent").val(response.count_deleted_item);
					
					$('#numberSearchModal').modal("hide");
					//var isContainDeletedRow = delStatus;
					//$("#_hikitasukko_val").val(hikiatesyukko)
					//fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikiatesyukko);
				}else if ($.trim(response) == 'hikiatenyuko_dataint03_err'){
                                    $("#regButton").prop('disabled',true);
                                    $('.error').each(function () {
                                        if (this.classList.contains("error")) {
                                            this.classList.remove("error");
                                        }
                                    });
                                    var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">該当するデータがありません（サポート依頼兼請書が作成されていません）。</p>';
                                    $(document).find("#error_data").html(errMsg);
                                }else if ($.trim(response) == 'juchusyukko2_codename_err'){
                                    $("#regButton").prop('disabled',true);
                                    $('.error').each(function () {
                                        if (this.classList.contains("error")) {
                                            this.classList.remove("error");
                                        }
                                    });
                                    //var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">HSF020外注仕入完了検印者=済　です。</p>';
                                    //$(document).find("#error_data").html(errMsg);
                                    var msg = "HSF020外注仕入完了検印者=済　です。";
                                    $("#modal_content").html(msg);
                                    $("#alert_pop_up_modal").modal('show');
                                }else{
                                    $("#regButton").prop('disabled',true);
                                    setDefaultValue();
                                    var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">検索結果に該当するデータがありません。</p>';
                                    $(document).find("#error_data").html(err_msg);
                                    $("#error_data").show();
				}
			}
		})
	}else{
		console.log("Order Id sholud be 10digit");
                $("#count_deleted_parent").val(0);
                $("#error_data").html("");
		setDefaultValue();	
	}	
});

function setDefaultValue(){
	$("#minyuko_bango").val("");
	$("#information1").val("");
	$("#information1_detail").val("");
	$("#information3").val("");
	$("#information3_detail").val("");
	$("#orderuserbango").val("");
	$("#intorder01").val("");
	$("#datachar09").val("");
	
	$("#order_details").html("");
	$("#hidden_sum_of_minyuko_syouhizeiritu").val("");
	$("#sum_of_minyuko_syouhizeiritu").html("");
	$("#hidden_sum_of_minyuko_syouhizeiritu_se").val("");
	$("#sum_of_minyuko_syouhizeiritu_se").html("");
	$("#max_minyuko_syouhinsyu").val("");	
}

function readOrderDetail() {
    $(".success-msg-box").css("display","none");
    var bango = $("input[id='userId']").val();
    var selected_row_id = $('#order_show_table tr.add_border').attr('id');
    var codename = $('#order_show_table tr.add_border').data('codename');
    
    if(codename > 0){
        setDefaultValue();
        $("#number_search").val("");
        $("#regButton").prop('disabled',true);
        var msg = "HSF020外注仕入完了検印者=済　です。";
        $("#modal_content").html(msg);
        $("#alert_pop_up_modal").modal('show');
        $('#numberSearchModal').modal("hide");
        return false;
    }
    
    $.ajax({
        url: '/inhouseEntry/order_detail_read/' + bango,
        type: 'GET',
        data: {
            'bango': bango,
            'order_id': selected_row_id,
            'req_type': 'selected'
        },
        success: function (response) {
            
            if(response.total_row > 0){
                $("#regButton").prop('disabled',false);
            }
            
            $("#error_data").hide();
            $('.error').each(function () {
                if (this.classList.contains("error")) {
                    this.classList.remove("error");
                }
            });
            $("#number_search").css('cssText', 'border:1px solid #E1E1E1 !important;border-radius: 4px !important');
            
            var review_orderbango = $("#review_orderbango").val();
            var ordertypebango2 = response.orderDetail[0].ordertypebango2;
            var se_checking_amount = response.orderDetail[0].se_checking_amount;
            if(ordertypebango2 >= review_orderbango){
                $("#regButton").prop('disabled',true);
                var msg = "訂正回数が上限値"+review_orderbango+"回に達しました。";
                $("#modal_content").html(msg);
                $("#alert_pop_up_modal").modal('show');
                $('#numberSearchModal').modal("hide");
                return false;
            }
            
            console.log(response);
            var minyuko_bango = response.orderDetail[0].bango;
            var support_number = response.orderDetail[0].support_number;
            var information1 = response.orderDetail[0].information1;
            var information1_detail = response.orderDetail[0].information1_detail;
            var information3 = response.orderDetail[0].information3;
            var information3_detail = response.orderDetail[0].information3_detail;
            var orderuserbango = response.orderDetail[0].orderuserbango;
            var intorder01 = response.orderDetail[0].intorder01;
            var datachar09 = response.orderDetail[0].user_name_short;
            $("#minyuko_bango").val(minyuko_bango);
            $("#number_search").val(support_number);
            $("#information1").val(information1);
            $("#information1_detail").val(information1_detail);
            $("#information3").val(information3);
            $("#information3_detail").val(information3_detail);
            $("#orderuserbango").val(orderuserbango);
            $("#intorder01").val(intorder01);
            $("#datachar09").val(datachar09);
            
            $("#order_details").html(response.html);
            $("#hidden_sum_of_minyuko_syouhizeiritu").val(response.sum_of_minyuko_syouhizeiritu);
            $("#sum_of_minyuko_syouhizeiritu").html(response.formatted_sum_of_minyuko_syouhizeiritu);
            $("#hidden_sum_of_minyuko_syouhizeiritu_se").val(response.sum_of_minyuko_syouhizeiritu);
            $("#sum_of_minyuko_syouhizeiritu_se").html(response.formatted_sum_of_minyuko_syouhizeiritu);
            $("#max_minyuko_syouhinsyu").val(response.max_minyuko_syouhinsyu);
            $("#se_checking_amount").val(se_checking_amount);
            $("#sum_of_205").val(response.sum_of_205);
            $("#total_parent").val(response.max_minyuko_syouhinsyu);
            $("#count_deleted_parent").val(response.count_deleted_item);
            
            $('#numberSearchModal').modal("hide");
            //var isContainDeletedRow = delStatus;
            //$("#_hikitasukko_val").val(hikiatesyukko)
            //fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikiatesyukko);
        }
    })
}
$(document).on("click", "#select-order-detail", readOrderDetail);

function cloneRow(own){
	var $tableBody = $('#userTable').find("tbody");
	$trLast = $tableBody.find("tr:last");
	var $element = own.closest("tr");
        $element.find(".deleteBtn").prop("disabled",false);
        var temp_parent_id = $element.find(".parent_id").val();
        var $delete_check = $element.find(".delete_check").val().replace("original",'newCopy');
        if(temp_parent_id == ""){
            var hidden_minyuko_syouhinsyu = $element.find(".minyuko_syouhinsyu").val();
        }else{
           var hidden_minyuko_syouhinsyu =  temp_parent_id;
        }
	var $clone = $element.clone();
        
        var classification_amount = $element.find(".classification-amount").val();
        $clone.find(".classification-amount").val(classification_amount);
        var responsible_persion = $element.find(".responsible-persion").val();
        $clone.find(".responsible-persion").val(responsible_persion);
        
        $clone.find(".minyuko_idoutanabango").val("");
        $clone.find(".minyuko_yoteimeter").val("");
        $clone.find(".minyuko_nyukometer").val("");
        
        //supplier modal
        var temp_datachar19 = parseInt($("#temp_datachar19").val()) + 1;
        var db_datachar19_id = $clone.find(".db_datachar19").attr("id");
        var datachar19_id = $clone.find(".datachar19").attr("id");
        $clone.find(".db_datachar19").prop('id', temp_datachar19 + db_datachar19_id);
        $clone.find(".datachar19").prop('id', temp_datachar19 + datachar19_id);
        $("#temp_datachar19").val(temp_datachar19);
        var onclick_text = $clone.find(".supplier-btn").attr("onclick");
        onclick_text = onclick_text.replace(db_datachar19_id,temp_datachar19 + db_datachar19_id);
        onclick_text = onclick_text.replace(datachar19_id,temp_datachar19 + datachar19_id);
        $clone.find(".supplier-btn").attr('onclick', onclick_text);
        //supplier modal
        
	
	var max_minyuko_syouhinsyu = parseInt($("#max_minyuko_syouhinsyu").val());
	var $minyuko_syouhinsyu = $clone.find(".minyuko_syouhinsyu_display");
	var $current_minyuko_syouhinsyu = $clone.find(".current_minyuko_syouhinsyu");
	$clone.find(".deleteBtn").prop("disabled",false);
	var $parent_id = $clone.find(".parent_id");
        $clone.find(".delete_check").val($delete_check);
	$minyuko_syouhinsyu.html(max_minyuko_syouhinsyu+1);
	$current_minyuko_syouhinsyu.val(max_minyuko_syouhinsyu+1);
	$parent_id.val(hidden_minyuko_syouhinsyu);
	$("#max_minyuko_syouhinsyu").val(max_minyuko_syouhinsyu+1);
        
        var class_name = "active_parent_id_"+hidden_minyuko_syouhinsyu;
        $element.find(".parent_id").addClass(class_name);
        $parent_id.addClass(class_name);
        $activeLast = $tableBody.find("."+class_name+":last");
        if($activeLast.length > 0){
            $element = $activeLast.closest("tr");
        }
	
	var $is_new = $clone.find(".is_new");
	$is_new.val("yes");
	
	var new_tr = $element.after($clone);
       
	
	//grand total
	var grand_minyuko_syouhizeiritu = 0;
	$(".minyuko_syouhizeiritu").each(function(){
        var delete_status = $(this).parent().closest("tr").find('.is_deleted').val();
        if(delete_status == 'no'){
			grand_minyuko_syouhizeiritu = grand_minyuko_syouhizeiritu + parseInt($(this).val());
		}
	});
	var hidden_grand_minyuko_syouhizeiritu = grand_minyuko_syouhizeiritu;
	grand_minyuko_syouhizeiritu = "¥ "+ numberFormat(grand_minyuko_syouhizeiritu);
	$("#hidden_sum_of_minyuko_syouhizeiritu").val(hidden_grand_minyuko_syouhizeiritu);
	$("#sum_of_minyuko_syouhizeiritu").html(grand_minyuko_syouhizeiritu);
	//$("#sum_of_minyuko_syouhizeiritu_se").html(grand_minyuko_syouhizeiritu);
	//grand total
        
   $("#regButton").prop('disabled',false);
   costExceedCal();
	
}

function enableDeleteBtn(class_name){
    $("."+class_name).each(function(){
		console.log($(this));		
	});
}

function enableDisableRegButton(own){
    //if(own.hasClass('responsible-persion')){
    //    $("#regButton").prop('disabled',false);
    //}else{
        var $tr = own.closest("tr").find('.responsible-persion');
        var $tr2 = own.closest("tr").find('.supplier-btn');
        if(own.val() == 'V160'){
                $tr2.attr('disabled',false);
                $tr.attr('readonly',true);
                $tr.css('cssText', 'pointer-events:none;');
        }else{
                $tr2.attr('disabled',true);
                $tr.attr('readonly',false);
                $tr.css('cssText', 'pointer-events:auto;')
        }
        //$("#regButton").prop('disabled',false);
   // }
}


function deleteRow(own){
	var $tr = own.closest("tr");
        
        //check at least one parent not deleted 
        //var total_parent = parseInt($("#total_parent").val());
	//var parent_id_val = $tr.find('.parent_id').val();
        //var count_deleted_parent = parseInt($('#count_deleted_parent').val());
        //if(parent_id_val == "" && count_deleted_parent < total_parent){
        //    count_deleted_parent = count_deleted_parent + 1;
        //    $('#count_deleted_parent').val(count_deleted_parent);
        //}
        //var temp_count_deleted_parent = parseInt($('#count_deleted_parent').val());
        //if(parent_id_val == "" && total_parent == temp_count_deleted_parent){
        //    return false;
        //}
        //check at least one parent not deleted
        
	//var hdn_minyuko_syouhinsyu = $tr.find('.minyuko_syouhinsyu').val();
        //var class_name = "active_parent_id_"+hdn_minyuko_syouhinsyu;
	//var count = 0;
	//var temp_count = 0;
	//$("."+class_name).each(function(){
	//	if($(this).closest("tr").find(".is_deleted").val() == 'no'){
	//		temp_count++;
	//	}
	//	count++;
	//});
        
        
        
        
        var only_original = "yes";
        $(".delete_check").each(function(){
            //if($(this).closest("tr").find(".is_deleted").val() == 'no'){
                var str = $(this).val();
                if (str.indexOf("copy") >= 0){
                    only_original = 'no';
                }
            //}
	});
        
        
        var delete_check_val = $tr.find('.delete_check').val();
        var cn = 0;
        var copy_cn = 0;
        var cn2 = 0;
        if(only_original == 'yes'){
            $(".delete_check").each(function(){
               if($(this).closest("tr").find(".is_deleted").val() == 'no'){ 
                    cn2++;
                }
           });
        }else if (delete_check_val.indexOf("original") >= 0){
           var ck_val = delete_check_val.replace("original",'copy');
           $(".delete_check").each(function(){
               if($(this).closest("tr").find(".is_deleted").val() == 'no'){
                    var tmp_str = $(this).val();
                     if(ck_val == tmp_str){
                         cn++;
                     }
                 }
           });
        }else if(delete_check_val.indexOf("copy") >= 0){
            $(".delete_check").each(function(){
               if($(this).closest("tr").find(".is_deleted").val() == 'no'){ 
                    var tmp_str = $(this).val();
                    var tmp_str2 = "original_"+delete_check_val.split("_")[1];
                    var tmp_str3 = "copy_"+delete_check_val.split("_")[1];
                    if((tmp_str == tmp_str2) || (tmp_str == tmp_str3)){
                        copy_cn++;
                    }
                    
                }
           });
        }
        
        if(copy_cn > 1){
          cn = 1;  
        }
        
        //if(cn2 == 1){
        //  cn = 0;  
        //}else if(cn2 > 1){
        //  cn = 1;
        //}
		
		if(only_original == 'yes'){
			cn = 0;
		}
		
        console.log(only_original,cn2,copy_cn);
        if(delete_check_val.indexOf("newCopy") >= 0){
           //return true; 
        }else if(cn == 0){
            return false;
        }
        
        
        
        
        
	
	//if(temp_count != 1){
            var element = own.parent().find(".is_deleted");
            element.val("yes");
            own.prop("disabled",true);

            $tr.css("pointer-events","none");
            $tr.find('td').addClass("bg-gray-tr name");


            //$(element).remove();

            //grand total
            var grand_minyuko_syouhizeiritu = 0;
            $(".minyuko_syouhizeiritu").each(function(){
                    var delete_status = $(this).parent().closest("tr").find('.is_deleted').val();
                    if(delete_status == 'no'){
                            grand_minyuko_syouhizeiritu = grand_minyuko_syouhizeiritu + parseInt($(this).val());
                    }
            });
            var hidden_grand_minyuko_syouhizeiritu = grand_minyuko_syouhizeiritu;
            grand_minyuko_syouhizeiritu = "¥ "+ numberFormat(grand_minyuko_syouhizeiritu);
            $("#hidden_sum_of_minyuko_syouhizeiritu").val(hidden_grand_minyuko_syouhizeiritu);
            $("#sum_of_minyuko_syouhizeiritu").html(grand_minyuko_syouhizeiritu);
            //$("#sum_of_minyuko_syouhizeiritu_se").html(grand_minyuko_syouhizeiritu);
            //grand total
	//}
	
}

//calculate gross total
$(document).on('input keyup paste','.qty,.unit-price',function(){
    var val = $(this).val();
    if(val.length > 1){
        while (val.substring(0, 1) === '0') {   //First character is a '0'.
            val = val.substring(1);             //Trim the leading '0'
        }
        $(this).val(val);
    }
    
    //validate number,remove character
    var own_val = $(this).val() != "" ? $(this).val().replace(/[^0-9]/g,'') : 0 ;

	if($(this).hasClass("qty")){
		var qty = own_val;
		var unit_price = $(this).closest('tr').find('.unit-price').val().replace(/[^0-9]/g,'');
                if(unit_price == ""){
                   unit_price = 0;
                }
	}else{
		var qty = $(this).closest('tr').find('.qty').val().replace(/[^0-9]/g,'');
                if(qty == ""){
                   qty = 0;
                }
		var unit_price = own_val;
	}		
	
	var total = parseInt(qty) * parseInt(unit_price);
	$(this).closest('tr').find('.minyuko_syouhizeiritu').val(total);
	$(this).closest('tr').find('.syouhizeiritu_total').html(numberFormat(total));
	
	//grand total
	var grand_minyuko_syouhizeiritu = 0;
	$(".minyuko_syouhizeiritu").each(function(){
        var delete_status = $(this).parent().closest("tr").find('.is_deleted').val();
        if(delete_status == 'no'){
			grand_minyuko_syouhizeiritu = grand_minyuko_syouhizeiritu + parseInt($(this).val());
		}
	});
	//grand_minyuko_syouhizeiritu = "¥ "+ numberFormat(grand_minyuko_syouhizeiritu);
	var formatted_grand_minyuko_syouhizeiritu = "¥ "+ numberFormat(grand_minyuko_syouhizeiritu);
	$("#hidden_sum_of_minyuko_syouhizeiritu").val(grand_minyuko_syouhizeiritu);
	$("#sum_of_minyuko_syouhizeiritu").html(formatted_grand_minyuko_syouhizeiritu);
	//grand total
	
	$("#regButton").prop('disabled',false);
    
});

function costExceedCal(){
    var sum_of_minyuko_syouhizeiritu = 0;
    $(".classification-amount").each(function(){
        if($(this).val() == 'V160'){
            var minyuko_syouhizeiritu = $(this).parent().closest("tr").find('.minyuko_syouhizeiritu');
            var val = minyuko_syouhizeiritu.val();
            sum_of_minyuko_syouhizeiritu = sum_of_minyuko_syouhizeiritu + parseInt(val);
        }		
    });
    $("#minyuko_syouhizeiritu_limit").val(sum_of_minyuko_syouhizeiritu);
}

function checkSumOf205(){
    var sum_of_minyuko_syouhizeiritu = 0;
    $(".minyuko_idoutanabango").each(function(){
        if($(this).val() != ''){
            var minyuko_syouhizeiritu = $(this).parent().closest("tr").find('.minyuko_syouhizeiritu');
            var val = minyuko_syouhizeiritu.val();
            sum_of_minyuko_syouhizeiritu = sum_of_minyuko_syouhizeiritu + parseInt(val);
        }		
    });
    //$("#sum_of_205").val(sum_of_minyuko_syouhizeiritu);
}

//number format
function numberFormat(num) {
    if (num != "") {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function callforComma(self) {
    var test = numberFormat(self.value);
    self.value = test;
}

function callToRemoveComma(self) {
    var test = self.value.replace(/,+/g, '')
    self.value = test;
}


