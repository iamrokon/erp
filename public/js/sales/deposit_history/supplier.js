function supplierModalOpener(fillable_id, db_fillable_id) {
    $("#lastname").val("");
    $("#office_search_button").click();
    $("#fillable_id").val(fillable_id);
    $("#db_fillable_id").val(db_fillable_id)
    var soldModalValue = $("#db_fillable_id").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info').removeClass('add_border');
    $('.show_personal_master_info').removeClass('add_border');
    $('.show_content_last').removeClass('add_border');

    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        var officeid = prevValue.substr(6, 2);
        // var personalId = prevValue.substr(8, 3);
        console.log({prevValue, companyid, officeid})
        document.getElementById(companyid).click();
        setTimeout(function () {
            document.getElementById(officeid).click();
            //sroll to selected item
            document.getElementById(officeid).scrollIntoView();
            $("#SoldToModal").modal("show");
        }, 1500)

        // function etsuransya() {
        //     setTimeout(function () {
        //         var newPersonalId = $(`[data-serial="${personalId}"]`).prop("id")
        //         document.getElementById(newPersonalId).click();
        //         //sroll to selected item
        //         document.getElementById(newPersonalId).scrollIntoView();
        //         $("#SoldToModal").modal("show");
        //     }, 1500)
        // }

    } else {
        $("#SoldToModal").modal("show");
    }
}

function resetBusinessPartnerInfoExceptCompany() {
    $("#table_datatxt0049").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
}

function resetBusinessPartnerInfo() {
    $("#table_datatxt0049").text("");
    $("#table_company_name").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
    $("#table_yobi13").text("");
    $("#table_torihikisakibango").text("");
    $("#table_denpyostart").text("");
    $("#table_payment").text("");
    $("#table_mjn_mn").text("");
    $("#table_kensakukey").text("");
}

function resetBusinessPartnerInfoFromOffice() {
    $("#etsuransyaMail4").text("");
    $("#table_datatxt0049").text("");
    $("#table_datatxt0015").text("");
    $("#table_mail1").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_datatxt0016").text("");
}

function getHaisouData(url, kokyaku, address, kokyaku1String) {
    //reset business partner info except company
    resetBusinessPartnerInfoExceptCompany();

    var kokyaku1Obj = JSON.parse(kokyaku1String);

    $("#office_content_div_last_table").show();
    $("#office_master_content_div").hide();
    // $("#personal_master_content_div_table").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    document.getElementById('kokyakuIP').value = kokyaku;
    document.getElementById('kokyakuAddress').value = address;
    document.getElementById('table_office_name').innerHTML = "";

    if (kokyaku1Obj.mail_jyushin_mb == null) {
        if (kokyaku1Obj.mail_nouhin == null) {
            var mjn_mn = "";
        } else {
            var mjn_mn = "/" + kokyaku1Obj.mail_nouhin;
        }
    } else if (kokyaku1Obj.mail_nouhin == null) {
        if (kokyaku1Obj.mail_jyushin_mb == null) {
            var mjn_mn = "";
        } else {
            var mjn_mn = kokyaku1Obj.mail_jyushin_mb;
        }
    } else {
        var mjn_mn = kokyaku1Obj.mail_jyushin_mb + "/" + kokyaku1Obj.mail_nouhin;
    }

    var yetoiawsestart = kokyaku1Obj.yetoiawsestart != null ? kokyaku1Obj.yetoiawsestart + "日" : "";
    var ytoiawsesaiban = kokyaku1Obj.ytoiawsesaiban != null ? kokyaku1Obj.ytoiawsesaiban : "";
    var ytoiawsestart = kokyaku1Obj.ytoiawsestart != null ? kokyaku1Obj.ytoiawsestart : "";

    var payment = ytoiawsestart + " " + ytoiawsesaiban + " " + yetoiawsestart;

    document.getElementById('table_company_name').innerHTML = kokyaku1Obj.name;
    document.getElementById('table_yobi13').innerHTML = kokyaku1Obj.yobi13;
    document.getElementById('table_torihikisakibango').innerHTML = kokyaku1Obj.torihikisakibango;
    document.getElementById('table_denpyostart').innerHTML = formatNumber(kokyaku1Obj.denpyostart);
    document.getElementById('table_payment').innerHTML = payment;
    document.getElementById('table_mjn_mn').innerHTML = mjn_mn;
    document.getElementById('table_kensakukey').innerHTML = kokyaku1Obj.kensakukey;

    $.ajax({
        url: url,
        type: "GET",
        data: url,
        success: function (response) {
            //console.log(response)
            var html = null;
            $("#haisou-table tr").remove();
            for (var i = 0; i < response.length; i++) {
                var addrs = response[i]['address'] != null ? response[i]['address'] : "";
                html += '<tr class="show_personal_master_info trfocus" tabindex="0" id="' + response[i]['torihikisakibango'] + '">'
                /* for (var key in response[i])
                   {*/
                //console.log(key+'='+ response[i][key]);
                html += '<td style="width:50px;">' + response[i]['torihikisakibango'] + '</td>';
                html += '<td>' + response[i]['name'] + '</td>';
                html += '<td>' + addrs + '</td>';
                // }
                html += '</tr>'

            }
            //console.log(html);
            //$("#office_master_content_div").show();
            $("#haisou-table").append(html);
            for (var i = 0; i < response.length; i++) {
                var d = response[i]['bango'];
                var b = response[i]['torihikisakibango'];
                var c = response[i]['haisoumoji1'];
                var officeName = response[i]['name'];
                document.getElementById(response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya(' + d + ',"' + b + '","' + c + '","' + officeName + '")');
            }
            $("#office_master_content_div_table").show();
        },
    });
}

function goToEtsuransya(id, b, haisoumoji1, officeName) {
    //reset business partner info except office info
    resetBusinessPartnerInfoFromOffice();

    $("#office_content_div_last_table").show();
    // $("#personal_master_content_div_table").hide();

    document.getElementById('choice_buttonApi').disabled = true;
    document.getElementById('haisouIP').value = b;
    document.getElementById('haisouHaisoumoji1').value = haisoumoji1;
    document.getElementById('table_office_name').innerHTML = officeName;
    document.getElementById('choice_buttonApi').disabled = false;
    var kokyaku = document.getElementById('kokyakuIP').value;
    var haisou = document.getElementById('haisouIP').value;
    var dbHiddenValue = kokyaku + haisou
    $('#table_datatxt0049').html(dbHiddenValue);
}

function setDepositAmount(payment_date, billing_address) {
    if (payment_date && billing_address) {
        let _token = $("#csrf").val()
        let bango = $("#userId").val()
        $.ajax({
            url: "deposit-input/expected-deposit-amount/" + bango,
            type: 'POST',
            data: {billing_address, payment_date, _token},
            success: function (res) {
                $("#expected_deposit_amount").html(formatNumber(res.deposit_amount) ? formatNumber(res.deposit_amount) : "0")
                $('input[name=expected_deposit_amount]').val(res.deposit_amount)

            }
        })
    } else {
        $("#expected_deposit_amount").html("0")
        $('input[name=expected_deposit_amount]').val(0)
    }
}

function sum() {
    var kokyaku = document.getElementById('kokyakuIP').value;
    var haisou = document.getElementById('haisouIP').value;
    // var etsuransya= document.getElementById('etsuransyaIP').value;

    var kokyakuAddr = document.getElementById('kokyakuAddress').value;
    var haisouHaism = document.getElementById('haisouHaisoumoji1').value;
    // var etsuransyaTant= document.getElementById('etsuransyaTantousya').value;
    //  var etsuransyaMail4= document.getElementById('etsuransyaMail4').value;
    var abbr_detail = kokyakuAddr + "/" + haisouHaism + "/"
    // +etsuransyaTant;

    var dbHiddenValue = kokyaku + haisou
    // + etsuransya;
    var fillable_id = $("#fillable_id").val();
    var db_fillable_id = $("#db_fillable_id").val();

    if (haisouHaism.toString() == "") {
        var show_data = kokyakuAddr.toString();
    } else {
        var show_data = kokyakuAddr.toString() + "／" + haisouHaism.toString();
    }

    document.getElementById(fillable_id).value = show_data;
    document.getElementById(db_fillable_id).value = dbHiddenValue;
    var payment_date = $("#payment_date").val()
    setDepositAmount(payment_date, dbHiddenValue)

    $("#SoldToModal").modal('hide');
    document.getElementById('choice_buttonApi').disabled = true;

}

$(document).ready(function () {
    $('#searchButton').on('click', function (event) {
        $("#initial_content").show();
    });
    $('.show_office_master_info').on('click', function (event) {
        $('.show_office_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div").show();
    });

    $(document).on('click', '.show_personal_master_info', function () {
        $('.show_personal_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

    $(document).on('click', '.show_content_last', function () {
        $('.show_content_last').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });
    $(document).on("click", "#reset_button", function () {
        $("#SoldToModal").modal("hide");
    });
    $(document).on("click", "#dismiss_button", function () {
        var fillable_id = $("#fillable_id").val()
        var db_fillable_id = $("#db_fillable_id").val()
        $("#" + fillable_id) ? $("#" + fillable_id).val('') : ''
        $("#" + db_fillable_id) ? $("#" + db_fillable_id).val('') : ''
        $("#SoldToModal").modal("hide");
    });

    $(document).on('click', '#office_search_button', function () {
        var searchValue = $('#lastname').val();
        var pattern = /^\d+$/;
        //alert(searchValue);
        if (searchValue == "" || !pattern.test(searchValue)) {
            $('.show_office_master_info').removeClass('add_border');
            document.getElementById('choice_buttonApi').disabled = true;
            $("#office_content_div_last_table").show();
            $("#office_master_content_div_table").hide();
            // $("#personal_master_content_div_table").hide();

            var value = $('#lastname').val().toLowerCase();
            var count = 0;
            $("#table-body tr").filter(function () {
                if ($(this).text().toLowerCase().indexOf(value) > -1) count++;

                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

            if (count == 0) {
                $("#supplier_err_msg").html("検索結果に該当するデータがありません。");
            } else {
                $("#supplier_err_msg").html("");
            }

            //reset business partner information
            resetBusinessPartnerInfo();

            $("#product_supplier_content1").show();
        } else {
            var companyid = searchValue.substr(0, 6);
            var officeid = searchValue.substr(6, 2);
            //var personalId = searchValue.substr(8, 3);
                //alert(companyid);

            $("#supplier_err_msg").html("");
            $('.show_office_master_info').show();

            if ($("#" + companyid).length > 0) {
                document.getElementById(companyid).click();

                //sroll to selected item
                document.getElementById(companyid).scrollIntoView();

                $("#office_master_content_div_table").show();
                setTimeout(function () {
                    if (officeid != "" && $("#" + officeid).length > 0) {
                        document.getElementById(officeid).click();
                        //sroll to selected item
                        document.getElementById(officeid).scrollIntoView();
                        //etsuransya();
                    } else if (officeid == "") {
                        $("#office_master_content_div_table").show();
                        // $("#personal_master_content_div_table").hide();
                    } else {
                        $("#office_master_content_div_table").hide();
                        // $("#personal_master_content_div_table").hide();
                    }
                }, 1500)

                // $("#personal_master_content_div_table").show();
            } else {
                $('.show_office_master_info').removeClass('add_border');
                $('.show_office_master_info').hide();
                $("#office_master_content_div_table").hide();
                //   $("#personal_master_content_div_table").hide();

                //reset business partner information
                resetBusinessPartnerInfo();
                $("#supplier_err_msg").html("検索結果に該当するデータがありません。");
            }
        }

    });
})
