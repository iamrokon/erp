// Knockout
ko.bindingHandlers.nextFieldOnEnter = {
    init: function(element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function(e) {
            var self = $(this),
                form = $(element),
                focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
                focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                next = focusable.eq(nextIndex);
                next.focus();
                return false;
            }
            if (e.keyCode == 9) {
                e.preventDefault();
            }
        });
    }
};
ko.applyBindings({});

$('#categorykanri').on('change', function() {
    var billingCancellationSupplier_db = $('#billingCancellationSupplier_db').val();
    var categorykanri = $(this).val().split('A8');
    var catDate = categorykanri[1];
    console.log(catDate)
    if (billingCancellationSupplier_db && catDate){
        $.ajax({
            type: 'GET',
            url: '/findBillingCancellationMaxDate/',
            data: {'lastDayDate': catDate , 'companyCode': billingCancellationSupplier_db },
            dataType: 'json',
            success: function (data) {
                // console.log(data==null,data);
                if (data.length>0){
                    // console.log(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                    $('#datepicker1_oen').val(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                }
                else {
                    //for current month's last date
                    /*var date = new Date();
                    if (catDate=='31'){
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        $('#datepicker1_oen').val(lastDayDate);
                    }else {
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
                        $('#datepicker1_oen').val(expectedDate);
                    }*/
                    $('#datepicker1_oen').val('');
                }

            }
        });
    }
    else {
        $('#datepicker1_oen').val('');
    }
});

function loadBillingCancellationSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    var billingCancellationSupplier_db = torihikisaki_cd;
    var categorykanri = $('#categorykanri').val().split('A8');
    var catDate = categorykanri[1];
    if (billingCancellationSupplier_db && catDate){
        $.ajax({
            type: 'GET',
            url: '/findBillingCancellationMaxDate/',
            data: {'lastDayDate': catDate , 'companyCode': billingCancellationSupplier_db },
            dataType: 'json',
            success: function (data) {
                // console.log(data==null,data);
                if (data.length>0){
                    // console.log(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                    $('#datepicker1_oen').val(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                }
                else {
                    //for current month's last date
                    /*var date = new Date();
                    if (catDate=='31'){
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        $('#datepicker1_oen').val(lastDayDate);
                    }else {
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
                        $('#datepicker1_oen').val(expectedDate);
                    }*/
                    $('#datepicker1_oen').val('');
                }

            }
        });
    }
    else {
        $('#datepicker1_oen').val('');
    }
}

function searchOrder() {
    var msg = '';
    var bango = $("input[name='userId']").val();
    var categorykanri = $('#categorykanri').val();
    var billingCancellationSupplier_db = $('#billingCancellationSupplier_db').val();
    var billingDate = $('#datepicker1_oen').val();
    console.log(billingCancellationSupplier_db, categorykanri);
    /*debugger;*/
    if (categorykanri == '') {
        $('#categorykanri').addClass("error");
        var msg = msg + '<p>【締め日】必須項目に入力がありません。</p>\n'

    } else {
        $('#categorykanri').removeClass("error");

    }
    if (billingCancellationSupplier_db == '') {
        $('#billingCancellationSupplier').addClass("error");
        var msg = msg + '<p>【売上請求先】必須項目に入力がありません。</p>\n'

    } else {
        $('#billingCancellationSupplier').removeClass("error");

    }
    if (billingDate == '') {
        $('#datepicker1_oen').addClass("error");
        var msg = msg + '<p>【請求日】必須項目に入力がありません。</p>\n'

    } else {
        $('#datepicker1_oen').removeClass("error");

    }

    if (msg != '') {
        $("#errorMsgDiv").html(msg);
        $('#contenthide').blur();
        $(".loading-icon").toggle();
    } else {
        var data = $('#searchForm').serialize();
        console.log(bango, data);
        var url = "/billingCancellation/searchOrder/" + 'id=' + bango;

        console.log(data)
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(res) {
                // console.log(res);
                $('#errorMsgDiv').empty();
                if (res.errorMessage) {
                    console.log(res.errorMessage)
                    var msg = '<p>' + res.errorMessage + '</p>';
                    $('#errorMsgDiv').html(msg);
                    $('#contenthide').blur();
                    $(".loading-icon").hide();
                } else if (res.successMessage) {
                    var msg = '<div class="row" id="success_msg">\n' +
                        '            <div class="col-12">\n' +
                        '                <div class="alert alert-primary alert-dismissible">\n' +
                        '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                        '                            style="background-color: white;" onclick="$(\'#categorykanri\').focus();">\n' +
                        '                        &times;\n' +
                        '                    </button>\n' +
                        '                    <strong style="font-size: 12px !important;">正常に終了しました</strong>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>';
                    $(".loading-icon").hide();
                    $('#contenthide').blur();
                    $('.dismissMe').focus();
                    $('#datepicker1_oen').val('');
                    $('.datePickerHidden').val('');
                    $('#billingCancellationSupplier').val('');
                    $('#billingCancellationSupplier_db').val('');
                    $('#categorykanri').val('');
                    $('#errorMsgDiv').html(msg);
                    console.log(res.successMessage)
                }
            }
        })

    }

}
