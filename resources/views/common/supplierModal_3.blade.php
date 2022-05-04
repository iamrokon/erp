<!-- S13 -->
<div class="modal custom-modal" data-backdrop="static" id="supplierModal3" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:1100 !important;">
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
                            <table class="table" style="border: none!important;width: auto;margin-bottom:0px;">
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

                                    }else{
                                        var companyid = searchValue.substr(0, 6);
                                        
                                        $("#supplier_err_msg_3").html("");
                                        $('.show_office_master_info3').show();

                                        if($("#3_"+companyid).length>0){ 
                                            document.getElementById("3_"+companyid).click();
                                            //sroll to selected item
                                            document.getElementById("3_"+companyid).scrollIntoView();
                                            $("#supplierModal3").modal("show");
                                        }else{
                                            $('.show_office_master_info3').removeClass('add_border');
                                            $('.show_office_master_info3').hide();
                                            
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
                        <div id="supplier_err_msg_3" style="margin-top:32px;font-size: 14px; color: #000;background: #aec7e7;line-height: 27px;padding: 0px 15px;">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="table_wrap">
                            <div class=" page4_table_design  table_hover  table-head-only">
                                <div id="initial_content_3">
                                    <div class="border-line" style="margin-bottom: 0px;"></div>
                                    <div style="height:77px;padding:29px 0px;">
                                        <h4><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>
                                    </div>
                                    <div class="modal-table-white " style="min-height: 80px;width: 100%;cursor: pointer;">
                                        <div class="first-table scrollbararea2"style="height: 225px;width: 100%;cursor: pointer;overflow-y:scroll;
">
                                            <table class="table content-table" id="table-body-3">
                                                <tbody class="" id="company_table_data_3">
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="office_content_div_last_3" style="margin-top: 33px;padding-left:17px;">
                            <div style="width: 100%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 25px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table3" style="display: none;height:665px;margin-bottom:0px !important;"
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
            <div class="modal-footer" style="height:86px;padding:32px 30px;">
                <input id="fillable_id3" type="hidden"/>
                <input id="db_fillable_id3" type="hidden"/>
                <input type="hidden" id="torihikisaki_cd_3" value="">
                <input id="selected_field_name_3" type="hidden"/>
                <input id="dependantStatus_3" type="hidden"/>

                <button type="button" id="clear_parent3" class="btn text-white uskc-button bg-teal mr-2" data-dismiss="modal" style="display: none;">親画面をクリア</button>
                <button type="button" id="reset_button3" class="btn text-white uskc-button bg-default" data-dismiss="">
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi3" onclick="sum3()" class="btn uskc-button bg-teal text-white ml-2"
                        data-dismiss="modal">入力する
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showCompanyData(this_data,login_bango,kokyaku) {
         //selection style
        $('.show_office_master_info3').not(this).removeClass('add_border');
        $(this_data).addClass('add_border');
        
        var kokyaku1Obj = JSON.parse('{"' + kokyaku.replace(/&/g, '","').replace(/=/g,'":"') + '"}', function(key, value) { return key===""?value:decodeURIComponent(value) });

        document.getElementById('choice_buttonApi3').disabled = false;
        document.getElementById('torihikisaki_cd_3').value = kokyaku1Obj.yobi12;
        //document.getElementById('table_office_name_3').innerHTML = "";

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
        var ytoiawsesaiban = kokyaku1Obj.ytoiawsesaiban_detail != null ? kokyaku1Obj.ytoiawsesaiban_detail : "";
        var ytoiawsestart = kokyaku1Obj.ytoiawsestart_supplier != null ? kokyaku1Obj.ytoiawsestart_supplier : "";
        var payment = ytoiawsestart + " " + ytoiawsesaiban + " " + yetoiawsestart;

        document.getElementById('table_datatxt0049_3').innerHTML = kokyaku1Obj.yobi12;
        document.getElementById('table_company_name_3').innerHTML = kokyaku1Obj.name;
        if(kokyaku1Obj.yobi13 != null){
           var yobi13 = '<a href="{{URL::to("/uploads/company_master")}}'+'/'+kokyaku1Obj.yobi13+'" target="_blank" style="color:#fff;">'+kokyaku1Obj.yobi13_short+'</a>';  
        }else{
           var yobi13 = "";
        }
        document.getElementById('table_yobi13_3').innerHTML = yobi13;
        document.getElementById('table_torihikisakibango_3').innerHTML = kokyaku1Obj.torihikisakibango;
        document.getElementById('table_denpyostart_3').innerHTML = formatNumber(kokyaku1Obj.denpyostart);
        document.getElementById('table_payment_3').innerHTML = payment;
        document.getElementById('table_mjn_mn_3').innerHTML = mjn_mn;
        document.getElementById('table_kensakukey_3').innerHTML = kokyaku1Obj.kensakukey;

    }

    function sum3() {
        var fillable_id = $("#fillable_id3").val();
        var db_fillable_id = $("#db_fillable_id3").val();
        var torihikisaki_cd = $('#torihikisaki_cd_3').val();
        var selected_field_name = $("#selected_field_name_3").val();
        var dependant_status = $("#dependantStatus_3").val();

        var bango='{{$bango}}';
        var url='/getTorihikisakiData/'+bango;
        $.ajax({
            url:  url,
            type: "GET",
            data: "torihikisaki_cd="+torihikisaki_cd+'&modal_type=min_short',
            success: function( response ){
                var torihikisaki_details = response[0][selected_field_name];
                document.getElementById(fillable_id).value= torihikisaki_details;
                document.getElementById(db_fillable_id).value= torihikisaki_cd;
                
                //trigger for font validation
                $('#'+fillable_id).trigger('keyup');
        
                $("#supplierModal3").modal('hide');
                document.getElementById('choice_buttonApi3').disabled=true;
            }
        });
    }
</script>
