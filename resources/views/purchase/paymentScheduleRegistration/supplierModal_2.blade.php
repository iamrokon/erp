<!-- S12 -->
<div class="modal custom-modal" data-backdrop="static" id="supplierModal2" role="dialog"
     aria-labelledby="supplierModal2" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1330px!important;overflow-x: visible;width: 1330px;">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">
            <div class="modal-header" style="height: 68px;padding: 23px 28px;">
                <h5 class="modal-title">取引先</h5>
                <button type="button" ignore class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0px 29px 0px 30px;">
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div style="height:90px;padding:29px 0px;">
                            <table class="table" style="border: none!important;width: auto;margin-bottom:0px !important;">
                                <tbody>
                                <tr >
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-box-icon mr-3"></div>
                                    </td>
                                    <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                                    <td style=" width: 100%; border: none!important;">
                                        <input type="text" autofocus class="form-control" id="lastname2" maxlength="30"
                                               placeholder="検索ワード"
                                               style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                                    </td>
                                    <td style=" border: none!important;">
                                        <button type="button" class="btn bg-teal text-white btn_search"
                                                id="office_search_button2"
                                                style="border-radius: 0px;margin-left: -6px;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <script type="text/javascript">
                            $(function () {
                                $('#office_search_button2').click(function () {

                                    var searchValue = $('#lastname2').val();
                                    var pattern = /^\d+$/;

                                    if(searchValue == "" || !pattern.test(searchValue)){
                                        $('.show_office_master_info2').removeClass('add_border');
                                        document.getElementById('choice_buttonApi2').disabled = true;
                                        $("#office_content_div_last_table2").show();
                                        $("#office_master_content_div_table2").hide();
                                        //$("#personal_master_content_div_table2").hide();

                                        var value = $('#lastname2').val().toLowerCase();
                                        var count = 0;
                                        $("#table-body-2 tr").filter(function () {
                                            if ($(this).text().toLowerCase().indexOf(value) > -1) count++;

                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });

                                        if (count == 0) {
                                            $("#supplier_err_msg_2").html("検索結果に該当するデータがありません");
                                        } else {
                                            $("#supplier_err_msg_2").html("");
                                        }

                                        //reset business partner information
                                        resetBusinessPartnerInfo2();

                                        //$("#product_supplier_content1").show();

                                    }else{
                                        var companyid = searchValue.substr(0, 6);
                                        var officeid = searchValue.substr(6, 2);

                                        $("#supplier_err_msg_2").html("");
                                        $('.show_office_master_info2').show();

                                        if($("#2_"+companyid).length>0){
                                            document.getElementById("2_"+companyid).click();

                                            //sroll to selected item
                                            document.getElementById("2_"+companyid).scrollIntoView();

                                            $("#office_master_content_div_table2").show();
                                            setTimeout(function () {
                                                if($("#2_"+officeid).length>0){
                                                    document.getElementById("2_"+officeid).click();
                                                    //sroll to selected item
                                                    document.getElementById("2_"+officeid).scrollIntoView();
                                                }else if(officeid == ""){
                                                    $("#office_master_content_div_table2").show();
                                                }else{
                                                    $("#office_master_content_div_table2").hide();
                                                }
                                            },1500)

                                        }else{
                                            $('.show_office_master_info2').removeClass('add_border');
                                            $('.show_office_master_info2').hide();
                                            $("#office_master_content_div_table2").hide();

                                            //reset business partner information
                                            resetBusinessPartnerInfo2();
                                            $("#supplier_err_msg_2").html("検索結果に該当するデータがありません");
                                        }
                                    }

                                });
                            });
                        </script>

                    </div>
                    <div class="col-lg-6">
                        <div id="supplier_err_msg_2" style="margin-top:32px;font-size: 14px; color: #000; background-color: #aec7e7; line-height: 27px;padding: 0px 10px;margin-left:4px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="table_wrap">
                            <div class=" page4_table_design  table_hover  table-head-only">
                                <div id="initial_content_2">
                                    <div class="border-line" style="margin-bottom: 0px !important;"></div>
                                    <div style="height:77px;padding:29px 0px;">
                                    <h4 style="margin-bottom: 0px !important;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span>
                                    </h4>
                                    </div>
                                    <div class="modal-table-white scrollbararea" style="height: 225px;width: 100%;cursor: pointer;overflow-y:scroll">
                                        <div class="first-table">
                                            <table class="table content-table" id="table-body-2">
                                                <tbody class="" id="company_table_data_2">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="office_master_content_div2">
                                    <!-- 2nd modal content -->
                                    <div style="height:75px;padding:29px 0px;">
                                        <h4>事業所マスタ&nbsp;&nbsp;&nbsp;（事業所CD/事業所名/住所）</h4>
                                    </div>
                                    <div class="scrollbararea" style="height: 164px;width: 100%;cursor: pointer;background:white;overflow-y:scroll;">
                                        <div id="office_master_content_div_table2" class="modal-table-white" style="width: 100%;cursor: pointer;">
                                            <div class="second-table">
                                                <table class="table ">
                                                    <thead class="header text-center" id="myHeader2"></thead>
                                                    <tbody id="haisou-table-2">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="kokyakuIP2" value="">
                                <input type="hidden" id="haisouIP2" value="">
                                <input type="hidden" id="etsuransyaIP2" value="">
                                <input type="hidden" id="torihikisaki_cd_2" value="">

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div id="office_content_div_last_2" style="margin-top: 33px;padding-left:17px;">
                            <div style="width: 100%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 25px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table2" style="display: none;height:665px;margin-bottom:0px !important;"
                                       class="table modal-table-blue">
                                    <tbody>
                                    <tr>
                                        <td style="width: 112px;">番号</td>
                                        <td style="width: 300px;" id="table_datatxt0049_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">会社名</td>
                                        <td style="width: 300px;" id="table_company_name_2"></td>
                                        <!-- id="table_datatxt0014" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">事業所名</td>
                                        <td style="width: 300px;" id="table_office_name_2"></td>
                                        <!-- id="table_datatxt0015_2" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">部署</td>
                                        <td style="width: 300px;" id="table_mail2_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">役職</td>
                                        <td style="width: 300px;" id="table_mail3_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">氏名</td>
                                        <td style="width: 300px;" id="table_tantousya_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">メールアドレス</td>
                                        <td style="width: 300px;" id="table_mail1_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">電話番号</td>
                                        <td style="width: 300px;" id="table_datatxt0016_2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB信用録PDF</td>
                                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_yobi13_2"></td> <!-- sample-sinyo.pdf -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB評点</td>
                                        <td style="width: 300px;" id="table_torihikisakibango_2"></td> <!-- 59 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;" id="table_denpyostart_2_label">与信限度額</td>
                                        <td style="width: 300px;" id="table_denpyostart_2"></td>
                                        <!-- 3,000,000／残 750,000 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;" id="changable_payment_2_label">入金日</td>
                                        <td style="width: 300px;" id="table_payment_2"></td> <!-- 10日締 翌々月 20日 -->
                                    </tr>
                                        <tr>
                                            <td style="width: 112px;" id="changable_invoice_2_label">請求書方式</td>
                                            <td style="width: 300px;" id="table_mjn_mn_2"></td> <!-- 1 郵送／1 PDFメール送信 -->
                                        </tr>
                                        <tr>
                                            <td style="width: 112px;">社内備考（会社）</td>
                                            <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_kensakukey_2"></td> <!-- 社内備考 -->
                                        </tr>
                                        <tr style="border:none;">
                                            <td class="line-title"
                                                style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                            <td style="border-bottom:none !important;width: 300px;"></td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td class="line-title"
                                                style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                            <td style="border-bottom:none !important;width: 300px;"></td>
                                        </tr>
                                        <tr>
                                            <td class="line-title"
                                                style="border-bottom:none !important;width: 112px;height: 39px;"></td>
                                            <td style="border-bottom:none !important;width: 300px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- 2nd modal content end -->

                <!-- 3rd modal content  -->

                <div class="row">
                    <div class="col-lg-6"></div>

                </div>


                <!-- 4th modal content end  -->
                <!-- modal content enddd   -->

            </div>
            <div class="modal-footer" style="height:86px;padding:32px 29px;">
                <input id="fillable_id2" type="hidden"/>
                <input id="db_fillable_id2" type="hidden"/>
                <input id="fillable_id_input_status_2" type="hidden"/>
                <input id="selected_field_name_2" type="hidden"/>
                <input id="dependantStatus_2" type="hidden"/>

                <button type="button" id="clear_parent2" class="btn text-white uskc-button bg-teal mr-2" data-dismiss="modal"
                        style="display: none;">親画面をクリア
                </button>
                <button type="button" id="reset_button2" class="btn text-white uskc-button bg-default" data-dismiss="">
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi2" onclick="sum2()" class="btn uskc-button bg-teal text-white ml-2"
                        data-dismiss="modal">入力する
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getHaisouData2(this_data,login_bango,kokyaku) {
        //selection style
        $('.show_office_master_info2').not(this).removeClass('add_border');
        $(this_data).addClass('add_border');

        //reset business partner info except company
        resetBusinessPartnerInfoExceptCompany2();

        var kokyaku1Obj = JSON.parse('{"' + kokyaku.replace(/&/g, '","').replace(/=/g,'":"') + '"}', function(key, value) { return key===""?value:decodeURIComponent(value) });

        $("#office_content_div_last_table2").show();
        //$("#office_master_content_div2").hide();
        $("#personal_master_content_div_table2").hide();
        document.getElementById('choice_buttonApi2').disabled = true;
        document.getElementById('kokyakuIP2').value = kokyaku1Obj.yobi12;
        //document.getElementById('kokyakuAddress2').value = kokyaku1Obj.address;
        document.getElementById('table_office_name_2').innerHTML = "";

        //if (kokyaku1Obj.mail_jyushin_mb == null) {
        //    if (kokyaku1Obj.mail_nouhin == null) {
        //        var mjn_mn = "";
        //    } else {
        //        var mjn_mn = "/" + kokyaku1Obj.mail_nouhin;
        //    }
        //} else if (kokyaku1Obj.mail_nouhin == null) {
        //    if (kokyaku1Obj.mail_jyushin_mb == null) {
        //        var mjn_mn = "";
        //    } else {
        //        var mjn_mn = kokyaku1Obj.mail_jyushin_mb;
        //    }
        //} else {
        //    var mjn_mn = kokyaku1Obj.mail_jyushin_mb + "/" + kokyaku1Obj.mail_nouhin;
        //}

        //var yetoiawsestart = kokyaku1Obj.yetoiawsestart != null ? kokyaku1Obj.yetoiawsestart + "日" : "";
        //var ytoiawsesaiban = kokyaku1Obj.ytoiawsesaiban_detail != null ? kokyaku1Obj.ytoiawsesaiban_detail : "";
        //var ytoiawsestart = kokyaku1Obj.ytoiawsestart_supplier != null ? kokyaku1Obj.ytoiawsestart_supplier : "";

        //var payment = ytoiawsestart + " " + ytoiawsesaiban + " " + yetoiawsestart;

        var fillable_id = $("#fillable_id2").val();
        var len = fillable_id.split("v2").length;

        document.getElementById('table_company_name_2').innerHTML = kokyaku1Obj.name;
        if(kokyaku1Obj.yobi13 != null){
           var yobi13 = '<a href="{{URL::to("/uploads/company_master")}}'+'/'+kokyaku1Obj.yobi13+'" target="_blank" style="color:#fff;">'+kokyaku1Obj.yobi13_short+'</a>';
        }else{
           var yobi13 = "";
        }
        document.getElementById('table_yobi13_2').innerHTML = yobi13;
        document.getElementById('table_torihikisakibango_2').innerHTML = kokyaku1Obj.torihikisakibango;
        if(len > 1){
            document.getElementById('table_denpyostart_2').innerHTML = "";
        }else{
            document.getElementById('table_denpyostart_2').innerHTML = formatNumber(kokyaku1Obj.denpyostart);
        }
        //document.getElementById('table_payment_2').innerHTML = payment;
        //document.getElementById('table_mjn_mn_2').innerHTML = mjn_mn;
        document.getElementById('table_kensakukey_2').innerHTML = kokyaku1Obj.kensakukey;

        if(len > 1){
                var url = '{{URL::to('/')}}/office/haisouApi_2/'+login_bango+"/"+kokyaku1Obj.bango;
        }else{
                var url = '{{URL::to('/')}}/office/haisouApi/'+login_bango+"/"+kokyaku1Obj.bango;
        }

        $.ajax({
            url: url,
            type: "GET",
            data: '',
            success: function (response) {
                //console.log(response)
                var html = null;
                $("#haisou-table-2 tr").remove();
                for (var i = 0; i < response.length; i++) {
                    var addrs = response[i]['address'] != null ? response[i]['address'] : "";
                    html += '<tr class="show_personal_master_info2 trfocus" tabindex="0" id="2_' + response[i]['torihikisakibango'] + '">'
                    html += '<td style="width:50px;">' + response[i]['torihikisakibango'] + '</td>';
                    html += '<td>' + response[i]['name'] + '</td>';
                    html += '<td>' + addrs + '</td>';
                    html += '</tr>'

                }

                $("#office_master_content_div2").show();
                $("#haisou-table-2").append(html);
                for (var i = 0; i < response.length; i++) {
                    var d = response[i]['bango'];
                    var b = response[i]['torihikisakibango'];
                    var c = response[i]['haisoumoji1'];
                    var officeName = response[i]['name'];
                    var payment_day = response[i]['payment_day'];
                    if(len > 1){
                        var invoice_method = response[i]['payment_method'];
                    }else{
                        var invoice_method = response[i]['invoice_method'];
                    }
                    document.getElementById("2_" + response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya2(' + d + ',"' + b + '","' + c + '","' + officeName + '","'+payment_day+'","'+invoice_method+'")');
                }

                $("#office_master_content_div_table2").show();
            },
        });
    }

    function goToEtsuransya2(id, b, haisoumoji1, officeName,payment_day,invoice_method) {
        //reset business partner info except office info
        resetBusinessPartnerInfoFromOffice2();

        document.getElementById('table_payment_2').innerHTML = payment_day;
        document.getElementById('table_mjn_mn_2').innerHTML = invoice_method;

        $("#office_content_div_last_table2").show();
        //$("#personal_master_content_div_table2").hide();

        document.getElementById('choice_buttonApi2').disabled = false;
        document.getElementById('haisouIP2').value = b;
        //document.getElementById('haisouHaisoumoji1_2').value = haisoumoji1;

        document.getElementById('table_office_name_2').innerHTML = officeName;

        var kokyaku = document.getElementById('kokyakuIP2').value;
        var haisou = document.getElementById('haisouIP2').value;
        var dbHiddenValue = kokyaku + haisou
        $('#torihikisaki_cd_2').val(dbHiddenValue);
        $('#table_datatxt0049_2').html(dbHiddenValue);

    }


    function sum2() {
        var fillable_id = $("#fillable_id2").val();
        var db_fillable_id = $("#db_fillable_id2").val();
        var torihikisaki_cd = $('#torihikisaki_cd_2').val();
        var selected_field_name = $("#selected_field_name_2").val();
        var dependant_status = $("#dependantStatus_2").val();

        var bango='{{$bango}}';
        var url='/getTorihikisakiData/'+bango;
        $.ajax({
            url:  url,
            type: "GET",
            data: "torihikisaki_cd="+torihikisaki_cd+'&modal_type=short',
            success: function( response ){
                $("#supplierModal2").modal('hide');

                $("#purchase_payment_schedule_reg_102").val(response[0]["r17_3cd"]);
                // script.blade.php
              //  process_2_202_display_validation_checking();
            }
        });
    }

    function process_2_202_display_validation_checking(){
        var purchase_payment_schedule_reg_101 = $("#purchase_payment_schedule_reg_101").val();
          var purchase_payment_schedule_reg_102 = $("#purchase_payment_schedule_reg_102").val();

          // console.log('purchase_payment_schedule_reg_101 : ' + purchase_payment_schedule_reg_101)
          // console.log('purchase_payment_schedule_reg_102: ' + purchase_payment_schedule_reg_102)

          var flag = 0;
          
          var html = '';
          html = '<div>';
          
          if(purchase_payment_schedule_reg_101 == ''){
            $("#purchase_payment_schedule_reg_101").addClass("error");
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">【締切日】必須項目に入力がありません。</p>';
            flag++;
          }else{
            $("#purchase_payment_schedule_reg_101").removeClass("error");
          }

          if(purchase_payment_schedule_reg_102 == ''){
            $("#purchase_payment_schedule_reg_102").addClass("error");
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">【仕入先・購入先】必須項目に入力がありません。</p>';
            flag++;
          }else{
            $("#purchase_payment_schedule_reg_102").removeClass("error");
          }

          if(flag > 0){
            html += '</div>';
            $('#error_data').html(html);
            $("#error_data").show();
          }else{
            $("#error_data").hide();
          }
    }


    function sum2_old() {
        var fillable_id = $("#fillable_id2").val();
        var db_fillable_id = $("#db_fillable_id2").val();
        var torihikisaki_cd = $('#torihikisaki_cd_2').val();
        var selected_field_name = $("#selected_field_name_2").val();
        var dependant_status = $("#dependantStatus_2").val();

        var bango='{{$bango}}';
        var url='/getTorihikisakiData/'+bango;
        $.ajax({
            url:  url,
            type: "GET",
            data: "torihikisaki_cd="+torihikisaki_cd+'&modal_type=short',
            success: function( response ){

                $("#purchase_payment_schedule_reg_102").val(response[0]["r17_3cd"]);
                var torihikisaki_details = response[0][selected_field_name];
                document.getElementById(fillable_id).value= torihikisaki_details;
                document.getElementById(db_fillable_id).value= torihikisaki_cd;
                $("#supplierModal2").modal('hide');
                document.getElementById('choice_buttonApi2').disabled=true;
                if($("#page_name").length > 0 && $("#page_name").val() == 'depositInput' ){
                    loadDepositInputData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }
                if($("#page_name").length > 0 && $("#page_name").val() == 'depositApplication'){
                    $("#error_data").empty();
                    loadDepositApplicationData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                    $("#div_sales_subject").html('');
                }

                //load invoice deadline data
                if($("#page_name").length > 0 && $("#page_name").val() == 'invoiceDeadline'){
                    loadInvoiceDeadlineSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }

                //load billing deadline data
                if($("#page_name").length > 0 && $("#page_name").val() == 'billingDeadline'){
                    loadBillingDeadlineSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }

                //load customer ledger data
                if($("#page_name").length > 0 && $("#page_name").val() == 'customer_ledger'){
                    loadCustomerLedgerSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }

                //load billing cancelation data
                if($("#page_name").length > 0 && $("#page_name").val() == 'billingCancellation'){
                    loadBillingCancellationSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }
                //purchaseInput data
                if($("#page_name").length > 0 && $("#page_name").val() == 'purchaseInput'){
                    loadPurchaseInputData2(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
                }

            }
        });
    }
</script>
