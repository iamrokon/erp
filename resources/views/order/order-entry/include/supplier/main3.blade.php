<div class="modal custom-modal" data-backdrop="static" id="SoldToModal3" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">
            <div class="modal-header">
                <h5 class="modal-title">仕入先</h5>
                <button type="button" ignore class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div style="margin-bottom: 5px;">
                            <table class="table" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-box-icon mr-3"></div>
                                    </td>
                                    <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                                    <td style=" width: 100%; border: none!important;">
                                        <input type="text" autofocus class="form-control" id="lastname3"
                                               placeholder="検索ワード"
                                               style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                                    </td>
                                    <td style=" border: none!important;">
                                        <button type="button" class="btn bg-teal text-white btn_search"
                                                id="office_search_button3" style="border-radius: 0px;margin-left: -6px;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#office_search_button3').click(function () {
                                    var searchValue = $('#lastname3').val();
                                    var pattern = /^\d+$/;
                                    
                                    if(searchValue == "" || !pattern.test(searchValue)){
                                        $('.show_office_master_info3').removeClass('add_border');
                                        document.getElementById('choice_buttonApi3').disabled = true;
                                        $("#office_content_div_last_table3").show();
                                        $("#office_master_content_div_table3").hide();
                                        $("#personal_master_content_div_table3").hide();

                                        var value = $('#lastname3').val().toLowerCase();
                                        var count = 0;
                                        $("#table-body-3 tr").filter(function () {
                                            if ($(this).text().toLowerCase().indexOf(value) > -1) count++;

                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });

                                        if (count == 0) {
                                            $("#supplier_err_msg_3").html("検索結果に該当するデータがありません");
                                        } else {
                                            $("#supplier_err_msg_3").html("");
                                        }

                                        //reset business partner information
                                        resetBusinessPartnerInfo3();

                                        //$("#product_supplier_content1").show();
                                    }else{
                                        var companyid = searchValue.substr(0, 6);
                                        var officeid = searchValue.substr(6, 2);
                                        var personalId = searchValue.substr(8, 3);
                                        
                                        $("#supplier_err_msg_3").html("");
                                        $('.show_office_master_info3').show();

                                        if($("#3_"+companyid).length>0){
                                            document.getElementById("3_"+companyid).click();
                                            
                                            //sroll to selected item
                                            document.getElementById("3_"+companyid).scrollIntoView();

                                            $("#office_master_content_div_table3").show();
                                            setTimeout(function () {
                                                if($("#3_"+officeid).length>0){
                                                    document.getElementById("3_"+officeid).click();
                                                    //sroll to selected item
                                                    document.getElementById("3_"+officeid).scrollIntoView();
                                                    etsuransya();
                                                }else if(officeid == ""){
                                                    $("#office_master_content_div_table3").show();
                                                    $("#personal_master_content_div_table3").hide();
                                                }else{
                                                    $("#office_master_content_div_table3").hide();
                                                    $("#personal_master_content_div_table3").hide();
                                                }
                                            },1500)
                                            $("#personal_master_content_div_table3").show();

                                            function etsuransya(){
                                                setTimeout(function (){
                                                    var newPersonalId = $(`[data-serial="3_${personalId}"]`).prop("id")

                                                    if($("#"+newPersonalId).length>0){
                                                        document.getElementById(newPersonalId).click();
                                                        //sroll to selected item
                                                        document.getElementById(newPersonalId).scrollIntoView();
                                                    }else if(personalId == ""){
                                                        $("#office_master_content_div_table3").show();
                                                    }else{
                                                        $("#personal_master_content_div_table3").hide();
                                                    }
                                                    $("#SoldToModal3").modal("show");
                                                },1700)
                                            }
                                        }else{
                                            $('.show_office_master_info3').removeClass('add_border');
                                            $('.show_office_master_info3').hide();
                                            $("#office_master_content_div_table3").hide();
                                            $("#personal_master_content_div_table3").hide();
                                            
                                            //reset business partner information
                                            resetBusinessPartnerInfo3();
                                            $("#supplier_err_msg_3").html("検索結果に該当するデータがありません");
                                        } 
                                    }
                                    
                                });
                            });

                        </script>

                    </div>
                    <div class="col-lg-6">
                        <div id="supplier_err_msg_3" style="font-size: 14px; color: #ff0000;">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="table_wrap">
                            <div class=" page4_table_design mt-2  table_hover  table-head-only">
                                <div id="initial_content_3">
                                    <div class="border-line"></div>
                                    <h4 style="margin-bottom: 15px;margin-top: 10px;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span>
                                    </h4>
                                    <div class="modal-table-white"
                                         style="min-height: 80px;width: 100%;cursor: pointer;">
                                        <div class="first-table scrollbararea"
                                             style="height: 161px; overflow-y: scroll; cursor: pointer;">
                                            <table class="table content-table" id="table-body-3">
                                                <tbody class="">
                                                @foreach($popUpData['kokyaku1_3'] as $kokyaku3)
                                                    <?php
                                                    $kokyaku1Arr3 = ["name" => $kokyaku3->name, "yobi13" => $kokyaku3->yobi13, "torihikisakibango" => $kokyaku3->torihikisakibango, "ytoiawsestart" => $kokyaku3->ytoiawsestart_supplier, "yetoiawsestart" => $kokyaku3->yetoiawsestart, "denpyostart" => $kokyaku3->denpyostart, "ytoiawsesaiban" => $kokyaku3->ytoiawsesaiban_detail, "mail_jyushin_mb" => $kokyaku3->mail_jyushin_mb, "mail_nouhin" => $kokyaku3->mail_nouhin, "kensakukey" => $kokyaku3->kensakukey];
                                                    ?>
                                                    <tr class="show_office_master_info3 table_hover2 grid trfocus" tabindex="0"
                                                        id="3_{{$kokyaku3->yobi12}}"
                                                        onclick="getHaisouData3('{{route('haisouApi',[$bango,$kokyaku3->bango])}}','{{$kokyaku3->yobi12}}','{{$kokyaku3->address}}','{{json_encode($kokyaku1Arr3)}}')">
                                                        <td style="width: 50px;">{{$kokyaku3->yobi12}}</td>
                                                        <td> {{$kokyaku3->name}} </td>
                                                        <td style="display:none;"> {{$kokyaku3->furigana}} </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="office_master_content_div3">
                                    <!-- 2nd modal content -->
                                    <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ　（事業所CD/事業所名）</h4>
                                    <div style="height: 113px; background: #fff;">
                                        <div id="office_master_content_div_table3" class="modal-table-white"
                                             style="min-height: 80px;width: 100%;cursor: pointer;">
                                            <div class="second-table scrollbararea"
                                                 style="height: 113px; overflow-y: scroll; cursor: pointer;">
                                                <table class="table ">
                                                    <thead class="header text-center" id="myHeader3"></thead>
                                                    <tbody id="haisou-table-3">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="personal_master_content_div_3">
                                    <h4 style=" margin-top: 10px;">個人マスタ　（個人CD/名称）</h4>

                                    <input type="hidden" id="kokyakuIP3" value="">
                                    <input type="hidden" id="haisouIP3" value="">
                                    <input type="hidden" id="etsuransyaIP3" value="">

                                    <input type="hidden" id="kokyakuAddress3" value="">
                                    <input type="hidden" id="haisouHaisoumoji13" value="">
                                    <input type="hidden" id="etsuransyaTantousya3" value="">
                                    <input type="hidden" id="etsuransyaMail4_3" value="">
                                    <div style="height: 85px; background: #fff;">
                                        <div id="personal_master_content_div_table3" class=" modal-table-white"
                                             style="width: 100%; min-height: 80px;cursor: pointer;">
                                            <div class="third-table scrollbararea"
                                                 style="height: 85px; overflow-y: scroll; cursor: pointer;">
                                                <table class="table">
                                                    <tbody id="etsuransya-table-3">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div id="office_content_div_last_3" style="margin-top: 38px;">
                            <div style="width: 99%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table3" style="display: none;"
                                       class="table modal-table-blue">
                                    <tbody>
                                    <tr>
                                        <td style="width: 112px;">番号</td>
                                        <td style="width: 300px;" id="table_datatxt0049_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">会社名</td>
                                        <td style="width: 300px;" id="table_company_name_3"></td>
                                        <!-- id="table_datatxt0014" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">事業所名</td>
                                        <td style="width: 300px;" id="table_office_name_3"></td>
                                        <!-- id="table_datatxt0015_3" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">部署</td>
                                        <td style="width: 300px;" id="table_mail2_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">役職</td>
                                        <td style="width: 300px;" id="table_mail3_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">氏名</td>
                                        <td style="width: 300px;" id="table_tantousya_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">メールアドレス</td>
                                        <td style="width: 300px;" id="table_mail1_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">電話番号</td>
                                        <td style="width: 300px;" id="table_datatxt0016_3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB信用録PDF</td>
                                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_yobi13_3"></td> <!-- sample-sinyo.pdf -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB評点</td>
                                        <td style="width: 300px;" id="table_torihikisakibango_3"></td> <!-- 59 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">与信限度額</td>
                                        <td style="width: 300px;" id="table_denpyostart_3"></td>
                                        <!-- 3,000,000／残 750,000 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">入金日</td>
                                        <td style="width: 300px;" id="table_payment_3"></td> <!-- 10日締 翌々月 20日 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">請求書方式</td>
                                        <td style="width: 300px;" id="table_mjn_mn_3"></td> <!-- 1 郵送／1 PDFメール送信 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">社内備考（会社）</td>
                                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_kensakukey_3"></td> <!-- 社内備考 -->
                                    </tr>
                                    <tr style="border:none;display: none;">
                                        <td class="line-title"
                                            style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    <tr style="display: none;">
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
            <div class="modal-footer pl-4 pr-4">
                <input id="fillable_id3" type="hidden"/>
                <input id="db_fillable_id3" type="hidden"/>
                <input id="fillable_id_input_status3" type="hidden"/>

                <button type="button" id="clear_parent3" class="btn text-white w-145 bg-teal mr-2" style="display: none;">親画面をクリア</button>
                <button type="button" id="reset_button3" class="btn text-white w-145 bg-default" data-dismiss="">
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi3" onclick="sum3()" class="btn w-145 bg-teal text-white ml-2"
                        data-dismiss="modal">入力する
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getHaisouData3(url, kokyaku, address, kokyaku1String) {
        //reset business partner info except company
        resetBusinessPartnerInfoExceptCompany3();

        var kokyaku1Obj = JSON.parse(kokyaku1String);

        $("#office_content_div_last_table3").show();
        $("#office_master_content_div3").hide();
        //$("#personal_master_content_div_table3").hide();
        document.getElementById('choice_buttonApi3').disabled = true;
        document.getElementById('kokyakuIP3').value = kokyaku;
        document.getElementById('kokyakuAddress3').value = address;
        document.getElementById('table_office_name_3').innerHTML = "";

        if (kokyaku1Obj.mail_jyushin_mb == null) {
            if(kokyaku1Obj.mail_nouhin == null){
                var mjn_mn = "";
            }else{
                var mjn_mn = "/"+kokyaku1Obj.mail_nouhin;
            }
        } else if (kokyaku1Obj.mail_nouhin == null) {
            if(kokyaku1Obj.mail_jyushin_mb == null){
                var mjn_mn = "";
            }else{
                var mjn_mn = kokyaku1Obj.mail_jyushin_mb;
            }
        } else {
            var mjn_mn = kokyaku1Obj.mail_jyushin_mb + "/" + kokyaku1Obj.mail_nouhin;
        }

        var yetoiawsestart = kokyaku1Obj.yetoiawsestart != null ? kokyaku1Obj.yetoiawsestart + "日" : "";
        var ytoiawsesaiban = kokyaku1Obj.ytoiawsesaiban != null ? kokyaku1Obj.ytoiawsesaiban : "";
        var ytoiawsestart = kokyaku1Obj.ytoiawsestart != null ? kokyaku1Obj.ytoiawsestart : "";

        var payment = ytoiawsestart + " " + ytoiawsesaiban + " " + yetoiawsestart;

        document.getElementById('table_company_name_3').innerHTML = kokyaku1Obj.name;
        document.getElementById('table_yobi13_3').innerHTML = kokyaku1Obj.yobi13;
        document.getElementById('table_torihikisakibango_3').innerHTML = kokyaku1Obj.torihikisakibango;
        document.getElementById('table_denpyostart_3').innerHTML = formatNumber(kokyaku1Obj.denpyostart);
        document.getElementById('table_payment_3').innerHTML = payment;
        document.getElementById('table_mjn_mn_3').innerHTML = mjn_mn;
        document.getElementById('table_kensakukey_3').innerHTML = kokyaku1Obj.kensakukey;

        $.ajax({
            url: url,
            type: "GET",
            data: url,
            success: function (response) {
                //console.log(response)
                var html = null;
                $("#haisou-table-3 tr").remove();
                for (var i = 0; i < response.length; i++) {
                    var addrs = response[i]['address'] != null ? response[i]['address'] : "";
                    html += '<tr class="show_personal_master_info3 trfocus" tabindex="0" id="3_' + response[i]['torihikisakibango'] + '">'
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
                //$("#office_master_content_div3").show();
                $("#haisou-table-3").append(html);
                for (var i = 0; i < response.length; i++) {
                    var d = response[i]['bango'];
                    var b = response[i]['torihikisakibango'];
                    var c = response[i]['haisoumoji1'];
                    var officeName = response[i]['name'];
                    document.getElementById("3_"+response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya3(' + d + ',"' + b + '","' + c + '","' + officeName + '")');
                }

                $("#office_master_content_div_table3").show();
            },
        });
    }

    function goToEtsuransya3(id, b, haisoumoji1, officeName) {
        //reset business partner info except office info
        resetBusinessPartnerInfoFromOffice3();

        $("#office_content_div_last_table3").show();
        $("#personal_master_content_div_table3").hide();

        document.getElementById('choice_buttonApi3').disabled = true;
        document.getElementById('haisouIP3').value = b;
        document.getElementById('haisouHaisoumoji13').value = haisoumoji1;

        document.getElementById('table_office_name_3').innerHTML = officeName;

        var num = id;
        var bango = '{{$bango}}';
        var url = '/office/etsuransyaApi/' + bango + '/' + num;
        $.ajax({
            url: url,
            type: "GET",
            // data: url,
            success: function (response) {
                //console.log(response)
                var html = null;
                $("#etsuransya-table-3 tr").remove();
                for (var i = 0; i < response.length; i++) {
                    var ml2 = response[i]['mail2'] != null ? response[i]['mail2'] : "";

                    html += '<tr class="show_content_last3 trfocus" tabindex="0" data-serial="3_'+response[i]['datatxt0049']+'"  id="ets3_' + response[i]['bango'] + '">'
                    /* for (var key in response[i])
                       {*/
                    //console.log(key+'='+ response[i][key]);
                    html += '<td style="width:50px;">' + response[i]['datatxt0049'] + '</td>';
                    html += '<td id="etsr_tantousya_3">' + response[i]['tantousya'] + '</td>';
                    html += '<td>' + ml2 + '</td>';
                    // }
                    html += '</tr>'

                }
                //console.log(html);
                //$("#office_master_content_div3").show();
                $("#etsuransya-table-3").append(html);
                for (var i = 0; i < response.length; i++) {
                    var d = response[i]['bango'];
                    var b = response[i]['datatxt0049'];
                    var c = response[i]['tantousya'];
                    console.log(response);
                    document.getElementById("ets3_"+response[i]['bango']).setAttribute("onclick", 'goToEtsuransyaDetail3(' + d + ',"' + b + '","' + c + '")');
                }

                $("#personal_master_content_div_table3").show();
            }
        });
    }

    function goToEtsuransyaDetail3(id, b, tantousya) {
        $("#office_content_div_last_table3").show();
        document.getElementById('choice_buttonApi3').disabled = true;
        document.getElementById('etsuransyaIP3').value = b;
        document.getElementById('etsuransyaTantousya3').value = tantousya;

        var num = id;
        var bango = '{{$bango}}';
        var url = '/office/etsuransyaDetailApi/' + bango + '/' + num;
        $.ajax({
            url: url,
            type: "GET",
            // data: url,
            success: function (response) {
                var kokyaku = document.getElementById('kokyakuIP3').value;
                var haisou = document.getElementById('haisouIP3').value;
                var etsuransya = document.getElementById('etsuransyaIP3').value;
                var dbHiddenValue = kokyaku + haisou + etsuransya;

                if (response.datatxt0049 != null) {
                    document.getElementById('choice_buttonApi3').disabled = false;
                }

                $('#etsuransyaMail4_3').val(response.mail4);
                //console.log(response);
                $('#table_datatxt0049_3').html(dbHiddenValue);
                $('#table_datatxt0015_3').html(response.datatxt0015);
                $('#table_mail1_3').html(breakData(response.mail1, 35));
                $('#table_mail2_3').html(breakData(response.mail2, 35));
                $('#table_mail3_3').html(response.mail3);
                $('#table_tantousya_3').html(response.tantousya);
                $('#table_datatxt0016_3').html(response.datatxt0016);

                $("#office_content_div_last_table3").show();
            }

        });
    }

    function sum3() {
        var kokyaku = document.getElementById('kokyakuIP3').value;
        var haisou = document.getElementById('haisouIP3').value;
        var etsuransya = document.getElementById('etsuransyaIP3').value;

        var kokyakuAddr = document.getElementById('kokyakuAddress3').value;
        var haisouHaism = document.getElementById('haisouHaisoumoji13').value;
        var etsuransyaTant = document.getElementById('etsuransyaTantousya3').value;
        var etsuransyaMail4_3 = document.getElementById('etsuransyaMail4_3').value;
        var abbr_detail = kokyakuAddr + "/" + haisouHaism + "/" + etsuransyaTant;
        console.warn({kokyaku, haisou, etsuransya, kokyakuAddr, haisouHaism, etsuransyaTant})
        var fillable_id3 = $(document).find("#fillable_id3").val();
        var db_fillable_id3 = $(document).find("#db_fillable_id3").val();
        var fillableValue = kokyakuAddr.toString() + "/" + haisouHaism.toString() + "/" + etsuransyaMail4_3.toString();
        var dbHiddenValue = kokyaku + haisou + etsuransya;
        document.getElementById(fillable_id3).value = fillableValue
        document.getElementById(db_fillable_id3).value = dbHiddenValue
        if (fillable_id3 == 'reg_sold_to') {
            var sold_to_value = $("#reg_sold_to_db").val();
            sold_to_value = sold_to_value ?  sold_to_value.substr(0,6) : 0;
            if(sold_to_value){
              var bango = $("input[id='userId']").val();
                $.ajax({
                    url : 'order-entry/sold-wise-pj-value/'+bango,
                    data : {catchsm : sold_to_value},
                    success : function (res){
                       $("#pj").html(res)
                    }

                })
            }

            if (!$("#reg_sales_billing_destination").val()) {
                $("#reg_sales_billing_destination").val(fillableValue);
                $("#reg_sales_billing_destination_db").val(dbHiddenValue);
            }
            if (!$("#reg_end_customer").val()) {
                $("#reg_end_customer").val(fillableValue);
                $("#reg_end_customer_db").val(dbHiddenValue);
            }
            if (!$("#reg_bill_to").val()) {
                $("#reg_bill_to").val(fillableValue);
                $("#reg_bill_to_db").val(dbHiddenValue);
            }

        }
        if ($('#reg_sales_billing_destination').val()) {
            $('#igroup1').prop("disabled", false);
        } else if (!$('#reg_sales_billing_destination').val()) {
            $('#igroup1').prop("disabled", true);
        }
        $("#SoldToModal3").modal('hide');
        document.getElementById('choice_buttonApi3').disabled = true;

    }
</script>
