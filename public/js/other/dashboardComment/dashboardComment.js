var dasComReg = 0;
var dasComEdt = 0;
var dasComDeleteOrRetrieve = 0;

function openRegistration() {
    dasComReg = 0;
    $("#error_data").empty();
    $("#dashboard_modal1 input").parent().find('input').val('');
    $("#dashboard_modal1 select").parent().find('select').val('');
    $("#dashboard_modal1 input").parent().find('input').removeClass("error");
    $("#dashboard_modal1 select").parent().find('select').removeClass("error");
    document.getElementById("cke_1_contents").style.border = "1px solid #ddd";
    $('#insert_yukouflag1').val(1);
    $('#insert_yukouflag2').val(2);
    $("#insert_yukouflag1").prop("checked", true);
    var d = new Date();
    var currentDate = d.getFullYear()  + "/" + ("0"+(d.getMonth()+1)).slice(-2) + "/" + ("0" + d.getDate()).slice(-2);
    //var nextDate = d.getFullYear()  + "/" + ("0"+(d.getMonth()+2)).slice(-2) + "/" + ("0" + d.getDate()).slice(-2);
    var date = new Date();
    var nextDate= Date.parse(date).add({ months: +1}).toString("yyyy/MM/dd")
    $('#insert_kinsyousu').val(currentDate);
    $('#insert_kinsyousetteisu').val(nextDate);
    $("#regFrontValidation").remove();
    $('#dashboard_modal1').modal('show');
    //$('#cke_1_contents').val('');
}

/////////registration function///////////////
function registerDashboardComment(url,field) {
    //IE support
    console.log('hlw',field);
    if(field == undefined){
        field = null;
    }
        var editor_data = CKEDITOR.instances.ckeditor1.getData();
        document.getElementById('status').value = editor_data;
        document.getElementById('status_validate').value = CKEDITOR.instances.ckeditor1.document.getBody().getText();
        var status_validate = document.getElementById('status_validate').value;
        var submit_confirmation = $("#submit_confirmation").val();
        var data = new FormData(document.getElementById('registrationForm'));
        data.append('submit_confirmation', submit_confirmation);
        if(field!=null){
            data.append('field',field);
        }else{
            document.getElementById('regButton').disabled = true;
        }
        $.ajax({
            type: 'POST',
            url: url,
            // async: false,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $(".loading").addClass('show');
            },
            success: function (result) {

              /*console.log(result.err_msg.length);*/
                if ($.trim(result.status) == 'ok') {
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#dashboardCommentReload").trigger("click");
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                    $(document).find("#error_data").html(confirmationMsg);
                    document.getElementById('regButton').disabled = false;
                    $('#registrationForm #insert_sitesyubetsu').removeClass("error");
                    $('#registrationForm #insert_kinsyousu').removeClass("error");
                    $('#registrationForm #insert_kinsyousetteisu').removeClass("error");
                    document.getElementById("cke_1_contents").style.border = "1px solid #ddd";
                    $('#registrationForm #insert_file_das').removeClass("error");
                }
                else {
                    if(field == null){
                        document.getElementById('regButton').disabled = false;
                    }
                    var inputError = result.err_field;
                    checkFrontendValidationAfterSubmit(inputError,1);
                    $("#dashboard_modal1 input").parent().find('input').removeClass("error");
                    $("#dashboard_modal1 select").parent().find('select').removeClass("error");
                    $("#registrationForm #error_data").empty();
                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#registrationForm #error_data').html(html);

                        $("#registrationForm #error_data").show();
                    }

                    if (inputError.sitesyubetsu) {
                        $('#registrationForm #insert_sitesyubetsu').addClass("error");
                    }

                    if (inputError.kinsyousu) {
                        $('#registrationForm #insert_kinsyousu').addClass("error");
                    }

                    if (inputError.kinsyousetteisu) {
                        $('#registrationForm #insert_kinsyousu').addClass("error");
                        $('#registrationForm #insert_kinsyousetteisu').addClass("error");
                    }

                    if (inputError.status_validate) {
                        document.getElementById("cke_1_contents").style.border = "1px solid red";
                    }else {
                      document.getElementById("cke_1_contents").style.border = "1px solid #ddd";
                    }

                    if (inputError.hanbaimode || inputError.filename) {
                        $('#registrationForm #insert_file_das').addClass("error");
                    } else {
                        $('#registrationForm #insert_file_das').removeClass("error");
                    }
                }
            },
            complete: function(result){
                $(".loading").addClass('hide');
            }
        });
}

///////////////end registration function//////
function getText(html) {
    // var tmp = document.createElement('div');
    // tmp.innerHTML = html;
    // return tmp.textContent || tmp.innerText;
    var txt = document.createElement('textarea');
	txt.innerHTML = html.replace(/<[^>]+>/g, '');
	return txt.value;
}
var editor2 = CKEDITOR.instances.ckeditor2;
editor2.on( 'change', function( evt ) {
    var htmlString = evt.editor.getData();
    // var stripedHtml = getText(htmlString);
    // var stripedHtml = htmlString.replace(/<[^>]+>/g, '');
    var stripedHtml = $("<div>").html(htmlString).text();
    // console.log(htmlString,stripedHtml);
    var len = 0;
    if(stripedHtml.length != 0){
        len = stripedHtml.length-1;
    }
    $('#editorText2').empty();
    $('#editorText2').append(len+'文字');
});

var editor1 = CKEDITOR.instances.ckeditor1;
editor1.on( 'change', function( evt ) {
    var htmlString = evt.editor.getData();
    // var stripedHtml = htmlString.replace(/<[^>]+>/g, '');
    var stripedHtml = $("<div>").html(htmlString).text();
    // var stripedHtml = getText(htmlString);
    // console.log(htmlString,stripedHtml);
    var len = 0;
    if(stripedHtml.length != 0){
        len = stripedHtml.length-1;
    }
    $('#editorText1').empty();
    $('#editorText1').append(len+'文字');
    // console.log($('#editorText1').html());
});

/////////edit function///////////////
function editDashboardComment(url,field) {
    if(field == undefined){
        field = null;
    }
    console.log('hlw',url,field);
    // if (dasComEdt == '0' && field==null) {
    //     dasComEdt++;
    //     var html = getConfirmationMessage(2);
    //     $('#editForm #error_dataEdit').html(html);
    //     $('#editForm #error_dataEdit').show();
    //
    // } else {
        var editor_data = CKEDITOR.instances.ckeditor2.getData();
        // console.log("editor Length",editor_data.length);
        document.getElementById('edit_status').value = editor_data;
        document.getElementById('edit_status_validate').value = CKEDITOR.instances.ckeditor2.document.getBody().getText();
        var status_validate = document.getElementById('edit_status_validate').value;
        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();
        var data = new FormData(document.getElementById('editForm'));
        data.append('submit_confirmation', submit_confirmation);
        if(field!=null){
            data.append('field',field);
        }else{
            $('#editForm #editButton').prop('disabled', true);
        }

        //console.log(data);
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $(".loading").addClass('show');
            },
            success: function (result) {
              console.log(result);
              // debugger;
              // alert("result");
              //   console.log(typeof(result));
              //   console.log($.trim(result));
                if ($.trim(result.status) == 'ok') {
                    // location.reload();
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#dashboardCommentReload").trigger("click");
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                    $(document).find("#error_dataEdit").html(confirmationMsg);
                    document.getElementById('editButton').disabled = false;
                    $('#editForm #edit_sitesyubetsu').removeClass("error");
                    $('#editForm #edit_kinsyousu').removeClass("error");
                    $('#editForm #edit_kinsyousetteisu').removeClass("error");
                    document.getElementById("cke_2_contents").style.border = "1px solid #ddd";
                    $('#editForm #edit_file_das').removeClass("error");
                }else {
                    if(field == null){
                        $('#editForm #editButton').prop('disabled', false);
                    }
                    var inputError = result.err_field;
                    checkFrontendValidationAfterSubmit(inputError,2);
                    //reset submit confirmation
                    // $("#submit_confirmation").val("");
                    console.log(inputError);
                    $("#dashboard_comments_modal3 input").parent().find('input').removeClass("error");
                    $("#dashboard_comments_modal3 select").parent().find('select').removeClass("error");

                    $(" #editForm #error_dataEdit").empty();
                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#editForm #error_dataEdit').html(html);

                        $("#editForm #error_dataEdit").show();
                    }

                    if (inputError.sitesyubetsu) {
                        $('#editForm #edit_sitesyubetsu').addClass("error");
                    }

                    if (inputError.kinsyousu) {
                        $('#editForm #edit_kinsyousu').addClass("error");
                    }

                    if (inputError.kinsyousetteisu) {
                        $('#editForm #edit_kinsyousu').addClass("error");
                        $('#editForm #edit_kinsyousetteisu').addClass("error");
                    }

                    if (inputError.status_validate) {
                        document.getElementById("cke_2_contents").style.border = "1px solid red";
                    }else {
                        document.getElementById("cke_2_contents").style.border = "1px solid #ddd";
                    }

                    if (inputError.hanbaimode || inputError.filename) {
                        $('#editForm #edit_file_das').addClass("error");
                    } else {
                        $('#editForm #edit_file_das').removeClass("error");
                    }
                }
            },
            complete: function(result){
                /*$(".loading").removeClass('show');*/
                $(".loading").addClass('hide');
            }
        });
    //}
}

///////////////end edit function//////

///////////view employee detail////////////

function viewDetail(url, id) {
    dasComEdt = 0;
    dasComDeleteOrRetrieve = 0;
    $("#editForm #error_dataEdit").hide();
    document.getElementById("cke_2_contents").style.border = "1px solid #ddd";
    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (result) {
            console.log(result);
            // var hanbaimode = result.hanbaimode;
            if(result.hanbaimode){
              // hanbaimode = hanbaimode.replace('_dc'+result.syouhinbango,'');
            }
            if (result.jidoujuchuflag == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('editButton').style.display = 'none';
            }

            $('#editForm #edit_sitesyubetsu').removeClass("error");
            $('#editForm #edit_kinsyousu').removeClass("error");
            $('#editForm #edit_kinsyousetteisu').removeClass("error");
            document.getElementById("cke_2_contents").style.border = "1px solid #ddd";
            $('#editForm #edit_file_das').removeClass("error");

            $("input[name=yukouflag][value=" + result.yukouflag + "]").prop('checked', true);
            $('#editForm #edit_sitesyubetsu').val(result.sitesyubetsu);
            $('#editForm #edit_kinsyousu').val(result.created_date);
            $('#editForm #edit_kinsyousetteisu').val(result.edited_date);
            $('#editForm #old_hanbaimode').val(result.hanbaimode);
            $('#editForm #edit_file_das').val(result.hanbaimode);
            $('#editForm #hiddenSyouhinbango').val(result.syouhinbango);
            $('#editForm #hiddenSitehinban').val(result.sitehinban);
            CKEDITOR.instances.ckeditor2.setData(result.status);
            $('#dashboard_comments_modal3').modal('show');

        }
    });
}



// Show uploaded image in print preview start
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = e.target.result;
            var img1 = img.split(";");
            if (img1[0] == "data:application/pdf") {
                $('#employee_print #print_datatxt0029').html('<object data="' + img + '#toolbar=0&navpanes=0&scrollbar=0" class="iframeelement" type="application/pdf" style="height: 2.25cm !important;width: 2.25cm !important;padding:0;margin:0;overflow:hidden"><embed src="' + img + '" type="application/pdf" style="padding:0;margin:0;overflow: hidden" /></object>');
            } else {
                $('#employee_print #print_datatxt0029').html('<img src="' + e.target.result + '" style="width:2.25cm !important;height:2.25cm !important">');
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#customFileDas").change(function () {
    readURL($('#customFileDas').val());
});
$("#regClose").click(function () {
  CKEDITOR.instances.ckeditor1.setData('');
});
// Show uploaded image in print preview end

// Settings Modal
$('#setting_display_modal').on('shown.bs.modal', function () {
    $("#setting_name").focus();
});

function deleteDashboardCommentMaster(url) {

    if (dasComDeleteOrRetrieve == 0) {
        dasComDeleteOrRetrieve++;
        var html = getConfirmationMessage(3);
        $('#editForm #error_dataEdit').html(html);
        $("#editForm #error_dataEdit").show();
    } else {
        var kesuId = $('#editForm #hiddenSyouhinbango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: kesuId,
            success: function (response) {
                console.log(response);
                //alert("response");
                location.reload();
            },
        });
    }

}

function returnDashboardCommentMaster(url) {
    if (dasComDeleteOrRetrieve == 0) {
        dasComDeleteOrRetrieve++;
        var html = getConfirmationMessage(4);
        $('#editForm #error_dataEdit').html(html);
        $("#editForm #error_dataEdit").show();
            //alert("ii");
        // $('#employeeDetailViewForm #detail_error_data').html(html);
        // $("#employeeDetailViewForm #detail_error_data").show();
    } else {
        var kesuId = $('#editForm #hiddenSyouhinbango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: kesuId,
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }

}
