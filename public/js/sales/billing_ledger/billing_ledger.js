$(document).ready(function () {

    // @20220304
    // Pdf button and download the pdf
    $(document).on('click','#pdfCreationBtn',function(){
        $("#firstSearch").attr("onsubmit", 'return false');
    });

    $(document).on('click','#pdfCreationBtn',function(){
        $(".progress").show();

        var progressBar = $('#progress-bar');
        width = 0;
        progressBar.width(width);
        var interval = setInterval(function() {
            width += 5;
            progressBar.css('width', width + '%');
            if (width >= 100) {
                width = 0;
                clearInterval(interval);
            }
        }, 3000);

        $.ajax({
            type: "POST",
            url: '/billing-ledger/downloadBillingLedger',
            data: $('#firstSearch, #mainForm').serialize(),
            success: function (result) {
               filename = result[0];
               full_path = result[1];

               if(result[0] == 2){
                    $(".progress").hide();
                    $('#progress-bar').css({"width": "0%"});
                    // no data
                    $('#error_data').html('<p style="color:red;">'+result[1]+'</p>');
                    $("#error_data").show();
                     // $("#billing_ledger_0408_pagination_header_html_pagination_new1").html("");
                    var element1 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new1");
                    if(element1){
                        element1.parentNode.removeChild(element1);
                    }
                    

                    $("#billing_ledger_0408_pagination_header_html_pagination_new2").html("情報総数 0");
                  //  $("#billing_ledger_0408_pagination_header_html_pagination_new3").html("");
                    var element3 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new3");
                    if(element3){
                        element3.parentNode.removeChild(element3);
                    }
                    
                    $("#billing_ledger_0408_pagination_header_html_pagination_new4").html("ページ総数 1");
                    $("#billing_ledger_0408_pagination_table_body").empty();
                    document.getElementById("excelDwld").disabled = true;
               }else{
                    $("#error_data").hide();
                    document.getElementById("excelDwld").disabled = false;
                    // progress bar
                    
                     width = 100;
                     progressBar.css('width', width + '%');
                    download(filename, full_path);
               }
               
                //var inputError = result.err_field;
               // let err_msg = result.err_msg;
                /*if(inputError){
                    $('#error_data').html(createMsg(err_msg));
                    $("#error_data").show();
                    if (inputError.ledger_year_start) {
                        $('#ledger_year_start').addClass("error");
                    } else {
                        $('#ledger_year_start').removeClass("error");
                    }
                    if (inputError.ledger_year_end) {
                        $('#ledger_year_end').addClass("error");
                    } else {
                        $('#ledger_year_end').removeClass("error");
                    }
                    if (inputError.billing_address_text) {
                        $('#billing_address').addClass("error");
                    } else {
                        $('#billing_address').removeClass("error");
                    }
                     // $("#billing_ledger_0408_pagination_header_html_pagination_new1").html("");
                    var element1 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new1");
                    if(element1){
                        element1.parentNode.removeChild(element1);
                    }
                    

                    $("#billing_ledger_0408_pagination_header_html_pagination_new2").html("情報総数 0");
                  //  $("#billing_ledger_0408_pagination_header_html_pagination_new3").html("");
                    var element3 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new3");
                    if(element3){
                        element3.parentNode.removeChild(element3);
                    }
                    
                    $("#billing_ledger_0408_pagination_header_html_pagination_new4").html("ページ総数 1");
                    $("#billing_ledger_0408_pagination_table_body").empty();

                }else{
                    $('#ledger_year_start').removeClass("error");
                    $('#ledger_year_end').removeClass("error");
                    $('#billing_address').removeClass("error");
                    if(result[0] == 2){
                        // no data
                        $('#error_data').html('<p style="color:red;">'+result[1]+'</p>');
                        $("#error_data").show();
                         // $("#billing_ledger_0408_pagination_header_html_pagination_new1").html("");
                        var element1 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new1");
                        if(element1){
                            element1.parentNode.removeChild(element1);
                        }
                        

                        $("#billing_ledger_0408_pagination_header_html_pagination_new2").html("情報総数 0");
                      //  $("#billing_ledger_0408_pagination_header_html_pagination_new3").html("");
                        var element3 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new3");
                        if(element3){
                            element3.parentNode.removeChild(element3);
                        }
                        
                        $("#billing_ledger_0408_pagination_header_html_pagination_new4").html("ページ総数 1");
                        $("#billing_ledger_0408_pagination_table_body").empty();
                   }else{
                        $("#error_data").hide();
                        download(filename, full_path);
                   }
                }*/
            }
        });
    });

    function createMsg(err_msg, type) {
        console.log(typeof (err_msg));
        var typeMessage = type ? 'blue' : 'red';
        var html = '<div>';
        if (typeof (err_msg) != 'string') {
            var errmsg = err_msg.filter(onlyUnique)
            for (var count = 0; count < errmsg.length; count++) {
                html += '<p style="color:' + typeMessage + ';">' + errmsg[count] + '</p>';
            }
        } else {
            html += '<p style="color:' + typeMessage + ';">' + err_msg + '</p>';
        }

        html += '</div>';
        return html;
    }

    function download(filename, full_path){
        fetch(full_path)
            .then(resp => resp.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                // the filename you want
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                $(".progress").hide();
                $('#progress-bar').css({"width": "0%"});
            });
    }


    $('.datePicker1_1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_1'
    });

    $(document).on('change focus', '.datePicker1_1', function () {
        if ($(this).val().length == 7) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_1', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 5) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_1', function (e) {
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 6) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
            $(this).datepicker('update');
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_1', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_1").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker1_1").datepicker('hide');
        }
    });


    // End
    $('.datePicker1_2').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function () {
        if ($(this).val().length == 7) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_2', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 5) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 6) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
            $(this).datepicker('update');
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_2', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_2").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker1_2").datepicker('hide');
        }
    });
})
