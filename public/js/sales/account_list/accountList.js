function firstSearch(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var url = url;
        var data = $('#firstSearch').serialize();
        $.ajax({
            type:"POST",
            url: url,
            data:data,
            success:function(result){
                if($.trim(result) == 'ok'){
                    document.getElementById('first_csrf').disabled = false;
                    document.getElementById('firstButton').value = "FirstSearch";
                    document.getElementById("firstSearch").submit();
                }else{
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    console.log(inputError);

                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p>' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#search_error_data').html(html);

                        if (true) {
                        }
                        $("#search_error_data").show();
                    }
                    
                    
                    if (inputError.date) {
                        $('#date').addClass("error");
                    } else {
                        $('#date').removeClass("error");
                    }
                }
            }
        });
    } else {
        doubleClick();
    }
}

$(document).ready(function () {
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
            url: '/account-list/downloadAccountList',
            data: $('#firstSearch, #mainForm').serialize(),
            success: function (result) {
               filename = result[0];
               full_path = result[1];
                 
               if(result[0] == 2){
                    $(".progress").hide();
                    $('#progress-bar').css({"width": "0%"});
                    // no data
                    $('#search_error_data').html('<p style="color:red;">'+result[1]+'</p>');
                    $("#search_error_data").show();
                     // $("#billing_ledger_0408_pagination_header_html_pagination_new1").html("");
                    var element1 = document.getElementById("account_list_0420_pagination_header_html_pagination_new1");
                    if(element1){
                        element1.parentNode.removeChild(element1);
                    }
                    

                    $("#account_list_0420_pagination_header_html_pagination_new2").html("情報総数 0");
                  //  $("#billing_ledger_0408_pagination_header_html_pagination_new3").html("");
                    var element3 = document.getElementById("account_list_0420_pagination_header_html_pagination_new3");
                    if(element3){
                        element3.parentNode.removeChild(element3);
                    }
                    
                    $("#account_list_0420_pagination_header_html_pagination_new4").html("ページ総数 1");
                    $("#billing_ledger_0408_pagination_table_body").empty();
                    document.getElementById("excelDwld").disabled = true;
               }else{
                    $("#search_error_data").hide();
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

})