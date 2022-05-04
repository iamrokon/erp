<!-- S11 -->
<div class="modal custom-modal" data-backdrop="static" id="supplierModal" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:1100 !important;">
    <div class="modal-dialog" role="document" style="max-width: 1350px;overflow-x: visible;
    width: 1330px">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">
            <div class="modal-header" style="height: 68px;padding: 23px 28px;">
                <h5 class="modal-title" >取引先</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0px 29px 0px 30px;">
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div style="height:90px;padding:29px 0px;">
                            <table class="table" style="border: none!important;width: auto;margin-bottom:0px !important;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-box-icon mr-3"></div>
                                    </td>
                                    <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                                    <td style=" width: 100%; border: none!important;">
                                        <input type="text" autofocus class="form-control" id="lastname" maxlength="30" placeholder="検索ワード" style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                                    </td>
                                    <td style=" border: none!important;">
                                        <button type="button" class="btn bg-teal text-white btn_search" id="office_search_button" style="border-radius: 0px;margin-left: -6px;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <script type="text/javascript">
                            $(function(){
                                $('#office_search_button').click(function(){
                                    var searchValue = $('#lastname').val();
                                    var pattern = /^\d+$/;

                                    if(searchValue == "" || !pattern.test(searchValue)){
                                        $('.show_office_master_info').removeClass('add_border');
                                        document.getElementById('choice_buttonApi').disabled=true;
                                        $("#office_content_div_last_table").show();
                                        $("#office_master_content_div_table").hide();
                                        $("#personal_master_content_div_table").hide();

                                        var value = $('#lastname').val().toLowerCase();
                                        var count = 0;
                                        $("#table-body tr").filter(function() {
                                            if($(this).text().toLowerCase().indexOf(value) > -1) count++;

                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });

                                        if(count == 0){
                                            $("#supplier_err_msg").html("検索結果に該当するデータがありません");
                                        }else{
                                            $("#supplier_err_msg").html("");
                                        }

                                        //reset business partner information
                                        resetBusinessPartnerInfo();

                                        $("#product_supplier_content1").show();
                                    }else{
                                        var companyid = searchValue.substr(0, 6);
                                        var officeid = searchValue.substr(6, 2);
                                        var personalId = searchValue.substr(8, 3);

                                        $("#supplier_err_msg").html("");
                                        $('.show_office_master_info').show();

                                        if($("#"+companyid).length>0){
                                            document.getElementById(companyid).click();

                                            //sroll to selected item
                                            document.getElementById(companyid).scrollIntoView();

                                            $("#office_master_content_div_table").show();
                                            setTimeout(function () {
                                                if(officeid != "" && $("#ets_"+officeid).length>0){
                                                    document.getElementById("ets_"+officeid).click();
                                                    //sroll to selected item
                                                    document.getElementById("ets_"+officeid).scrollIntoView();
                                                    etsuransya();
                                                }else if(officeid == ""){
                                                    $("#office_master_content_div_table").show();
                                                    $("#personal_master_content_div_table").hide();
                                                }else{
                                                    $("#office_master_content_div_table").hide();
                                                    $("#personal_master_content_div_table").hide();
                                                }
                                            },1500)
                                            $("#personal_master_content_div_table").show();

                                            function etsuransya(){
                                                setTimeout(function (){
                                                    var newPersonalId = $(`[data-serial="${personalId}"]`).prop("id")

                                                    if($("#"+newPersonalId).length>0){
                                                        document.getElementById(newPersonalId).click();
                                                        //sroll to selected item
                                                        document.getElementById(newPersonalId).scrollIntoView();
                                                    }else if(personalId == ""){
                                                        $("#office_master_content_div_table").show();
                                                    }else{
                                                        $("#personal_master_content_div_table").hide();
                                                    }
                                                    $("#SoldToModal").modal("show");
                                                },1700)
                                            }
                                        }else{
                                            $('.show_office_master_info').removeClass('add_border');
                                            $('.show_office_master_info').hide();
                                            $("#office_master_content_div_table").hide();
                                            $("#personal_master_content_div_table").hide();

                                            //reset business partner information
                                            resetBusinessPartnerInfo();
                                            $("#supplier_err_msg").html("検索結果に該当するデータがありません");
                                        }
                                    }

                                });
                            });

                        </script>
                       
                    </div>
                    <div class="col-lg-6">
                        <div id="supplier_err_msg" style="margin-top:32px;font-size: 14px; color: #000; background-color: #aec7e7; line-height: 27px;padding: 0px 10px;margin-left:4px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 pr-0">
                        <div class="table_wrap">
                            <div class=" page4_table_design table_hover  table-head-only">
                                <div id="initial_content">
                                    <div class="border-line" style="margin-bottom: 0px !important;"></div>
                                    <div style="height:77px;padding:29px 0px;">
                                        <h4><span class="ml-2">会社マスタ　（会社CD/会社名）</span>
                                    </h4>
                                    </div>
                                    <div class="modal-table-white" style="min-height: 80px;width: 100%;cursor: pointer;">
                                        <div class="first-table scrollbararea" style="height: 225px; overflow-y: scroll; cursor: pointer;">
                                            <table class="table content-table" id="table-body">
                                                <tbody class="" id="company_table_data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="office_master_content_div">
                                    <!-- 2nd modal content -->
                                    <div style="height:75px;padding:29px 0px;">
                                        <h4>事業所マスタ　（事業所CD/事業所名/住所）</h4>
                                    </div>
                                    <div class="scrollbararea" style="height: 164px; background: #fff;overflow-y:scroll;">
                                        <div id="office_master_content_div_table" class="modal-table-white" style="min-height: 80px;width: 100%;cursor: pointer;">
                                            <div class="second-table" style="height: 113px; cursor: pointer;">
                                                <table class="table ">
                                                    <thead class="header text-center" id="myHeader"></thead>
                                                    <tbody id="haisou-table">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="personal_master_content_div">
                                    <div style="height:78px;padding:30px 0px;">
                                        <h4>個人マスタ　（個人CD/個人名/部署）</h4>
                                    </div>

                                    <input type="hidden" id="kokyakuIP" value="">
                                    <input type="hidden" id="haisouIP" value="">
                                    <input type="hidden" id="etsuransyaIP" value="">
                                    <input type="hidden" id="torihikisaki_cd" value="">

                                    <div class="scrollbararea" style="height: 123px; background: #fff;overflow-y: scroll;">
                                        <div id="personal_master_content_div_table" class=" modal-table-white" style="width: 100%; min-height: 80px;cursor: pointer;">
                                            <div class="third-table" style="height: 85px; cursor: pointer;">
                                                <table class="table">
                                                    <tbody id="etsuransya-table">

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
                        <div id="office_content_div_last" style="margin-top: 33px;padding-left:17px;">
                            <div style="width: 100%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 25px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table" style="display: none;height:665px;margin-bottom:0px !important;" class="table modal-table-blue">
                                    <tbody>
                                    <tr>
                                        <td style="width: 112px;">番号</td>
                                        <td style="width: 300px;" id="table_datatxt0049"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">会社名</td>
                                        <td style="width: 300px;" id="table_company_name"></td> <!-- id="table_datatxt0014" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">事業所名</td>
                                        <td style="width: 300px;" id="table_office_name"></td> <!-- id="table_datatxt0015" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">部署</td>
                                        <td style="width: 300px;" id="table_mail2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">役職</td>
                                        <td style="width: 300px;" id="table_mail3"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">氏名</td>
                                        <td style="width: 300px;" id="table_tantousya"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">メールアドレス</td>
                                        <td style="width: 300px;" id="table_mail1"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">電話番号</td>
                                        <td style="width: 300px;" id="table_datatxt0016"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB信用録PDF</td>
                                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_yobi13"></td> <!-- sample-sinyo.pdf -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB評点</td>
                                        <td style="width: 300px;" id="table_torihikisakibango"></td> <!-- 59 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;" id="table_denpyostart_label">与信限度額</td>
                                        <td style="width: 300px;" id="table_denpyostart"></td> <!-- 3,000,000／残 750,000 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;" id="changable_payment_label">入金日</td>
                                        <td style="width: 300px;" id="table_payment"></td> <!-- 10日締 翌々月 20日 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;" id="changable_invoice_label">請求書方式</td>
                                        <td style="width: 300px;" id="table_mjn_mn"></td> <!-- 1 郵送／1 PDFメール送信 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">社内備考（会社）</td>
                                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="table_kensakukey"></td> <!-- 社内備考 -->
                                    </tr>
                                    <tr style="border:none;">
                                        <td class="line-title"
                                            style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td class="line-title"
                                            style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td class="line-title"
                                            style="border-bottom:none !important;width: 112px;height: 30px;"></td>
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
                <input id="fillable_id" type="hidden" />
                <input id="db_fillable_id" type="hidden"/>
                <input id="selected_field_name" type="hidden"/>
                <input id="dependantStatus" type="hidden"/>

                <button type="button" id="clear_parent" style="display:none;" class="btn uskc-button bg-teal text-white ml-2" data-dismiss="modal">親画面をクリア</button>
                <button type="button" id="reset_button" class="btn text-white uskc-button bg-default" data-dismiss="">
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi" onclick="sum()" class="btn uskc-button bg-teal text-white ml-2" data-dismiss="modal">入力する</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function getHaisouData(this_data,login_bango,kokyaku){
    //selection style
    $('.show_office_master_info').not(this).removeClass('add_border');
    $(this_data).addClass('add_border');

    //reset business partner info except company
    resetBusinessPartnerInfoExceptCompany();

    var kokyaku1Obj = JSON.parse('{"' + kokyaku.replace(/&/g, '","').replace(/=/g,'":"') + '"}', function(key, value) { return key===""?value:decodeURIComponent(value) });

    $("#office_content_div_last_table").show();
    $("#personal_master_content_div_table").hide();
    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('kokyakuIP').value= kokyaku1Obj.yobi12;
    document.getElementById('table_office_name').innerHTML = "";

    //if(kokyaku1Obj.mail_jyushin_mb== null){
    //    if(kokyaku1Obj.mail_nouhin == null){
    //        var mjn_mn = "";
    //    }else{
    //        var mjn_mn = "/"+kokyaku1Obj.mail_nouhin;
    //    }
    //}else if(kokyaku1Obj.mail_nouhin == null){
    //    if(kokyaku1Obj.mail_jyushin_mb == null){
    //        var mjn_mn = "";
    //    }else{
    //        var mjn_mn = kokyaku1Obj.mail_jyushin_mb;
    //    }
    //}else{
    //    var mjn_mn = kokyaku1Obj.mail_jyushin_mb+"/"+kokyaku1Obj.mail_nouhin;
    //}

    //var yetoiawsestart = kokyaku1Obj.yetoiawsestart != null ? kokyaku1Obj.yetoiawsestart + "日" : "";
    //var ytoiawsesaiban = kokyaku1Obj.ytoiawsesaiban_detail != null ? kokyaku1Obj.ytoiawsesaiban_detail : "";
    //var ytoiawsestart = kokyaku1Obj.ytoiawsestart_supplier != null ? kokyaku1Obj.ytoiawsestart_supplier : "";

    //var payment = ytoiawsestart + " " + ytoiawsesaiban + " " + yetoiawsestart;

    var fillable_id = $("#fillable_id").val();
    var len = fillable_id.split("v2").length;
    
    document.getElementById('table_company_name').innerHTML = kokyaku1Obj.name;
    if(kokyaku1Obj.yobi13 != null){
      var yobi13 = '<a href="{{URL::to("/uploads/company_master")}}'+'/'+kokyaku1Obj.yobi13+'" target="_blank" style="color:#fff;">'+kokyaku1Obj.yobi13_short+'</a>';
    }else{
      var yobi13 = "";
    }
    document.getElementById('table_yobi13').innerHTML = yobi13;
    document.getElementById('table_torihikisakibango').innerHTML = kokyaku1Obj.torihikisakibango;
    if(len > 1){
        document.getElementById('table_denpyostart').innerHTML = "";
    }else{
        document.getElementById('table_denpyostart').innerHTML = formatNumber(kokyaku1Obj.denpyostart);
    }
    //document.getElementById('table_payment').innerHTML = payment;
    //document.getElementById('table_mjn_mn').innerHTML = mjn_mn;
    document.getElementById('table_kensakukey').innerHTML = kokyaku1Obj.kensakukey;

    if(len > 1){
        var url = '{{URL::to('/')}}/office/haisouApi_2/'+login_bango+"/"+kokyaku1Obj.bango;
    }else{
        var url = '{{URL::to('/')}}/office/haisouApi/'+login_bango+"/"+kokyaku1Obj.bango;
    }

     $.ajax({
        url:  url,
        type: "GET",
        data: '',
        success: function( response )
        {
         var html=null;
         $("#haisou-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
            var addrs = response[i]['address'] != null ? response[i]['address'] : "";
            html+='<tr class="show_personal_master_info trfocus" tabindex="0" id="ets_'+response[i]['torihikisakibango']+'">'
            html+='<td style="width:50px;">'+response[i]['torihikisakibango']+'</td>';
            html+='<td>'+response[i]['name']+'</td>';
            html += '<td>' + addrs + '</td>';
            html+='</tr>'
          }

          $("#haisou-table").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['torihikisakibango'];
           var c= response[i]['haisoumoji1'];
           var officeName = response[i]['name'];
           var payment_day = response[i]['payment_day'];
           if(len > 1){
                var invoice_method = response[i]['payment_method'];
            }else{
                var invoice_method = response[i]['invoice_method'];
            }
           document.getElementById("ets_" +response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya('+d+',"'+b+'","'+c+'","'+officeName+'","'+payment_day+'","'+invoice_method+'")');
          }
          $("#office_master_content_div_table").show();
        },
      });
}

function goToEtsuransya(id,b,haisoumoji1,officeName,payment_day,invoice_method){
    //reset business partner info except office info
    resetBusinessPartnerInfoFromOffice();

    document.getElementById('table_payment').innerHTML = payment_day;
    document.getElementById('table_mjn_mn').innerHTML = invoice_method;

    $("#office_content_div_last_table").show();
    $("#personal_master_content_div_table").hide();

    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('haisouIP').value= b;
    document.getElementById('table_office_name').innerHTML = officeName;

    var num=id;
    var bango='{{$bango}}';
    var url='/office/etsuransyaApi/'+bango+'/'+num ;
    $.ajax({
        url:  url,
        type: "GET",
       // data: url,
        success: function( response )
        {
         var html=null;
         $("#etsuransya-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
            var ml2 = response[i]['mail2'] != null ? response[i]['mail2'] : "";

            html+='<tr class="show_content_last trfocus" tabindex="0" data-serial="'+response[i]['datatxt0049']+'" id="'+response[i]['bango']+'">'
            html+='<td style="width:50px;">'+response[i]['datatxt0049']+'</td>';
            html+='<td id="etsr_tantousya">'+response[i]['tantousya']+'</td>';
            html += '<td>' + ml2 + '</td>';
            html+='</tr>'

          }

          $("#etsuransya-table").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['datatxt0049'];
           var c= response[i]['tantousya'];
           document.getElementById(response[i]['bango']).setAttribute("onclick", 'goToEtsuransyaDetail('+d+',"'+b+'","'+c+'")');
          }
          $("#personal_master_content_div_table").show();
        }
    });
}

function goToEtsuransyaDetail(id,b,tantousya){
    $("#office_content_div_last_table").show();
    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('etsuransyaIP').value= b;

    var num=id;
    var bango='{{$bango}}';
    var url='/office/etsuransyaDetailApi/'+bango+'/'+num ;
    $.ajax({
        url:  url,
        type: "GET",
        success: function( response ){
            var kokyaku = document.getElementById('kokyakuIP').value;
            var haisou = document.getElementById('haisouIP').value;
            var etsuransya = document.getElementById('etsuransyaIP').value;
            var dbHiddenValue = kokyaku + haisou + etsuransya;

            if (response.datatxt0049 != null){
                document.getElementById('choice_buttonApi').disabled=false;
            }

            $('#torihikisaki_cd').val(dbHiddenValue);

            $('#etsuransyaMail4').val(response.mail4);
            $('#table_datatxt0049').html(dbHiddenValue);
            $('#table_datatxt0015').html(response.datatxt0015);
            $('#table_mail1').html(breakData(response.mail1, 35));
            $('#table_mail2').html(breakData(response.mail2, 35));
            $('#table_mail3').html(response.mail3);
            $('#table_tantousya').html(response.tantousya);
            $('#table_datatxt0016').html(response.datatxt0016);

            $("#office_content_div_last_table").show();
        }

    });
}

function sum(){
    var fillable_id = $("#fillable_id").val();
    var db_fillable_id = $("#db_fillable_id").val();
    var torihikisaki_cd = $('#torihikisaki_cd').val();
    var selected_field_name = $("#selected_field_name").val();
    var dependant_status = $("#dependantStatus").val();

    var bango='{{$bango}}';
    var url='/getTorihikisakiData/'+bango;
    $.ajax({
        url:  url,
        type: "GET",
        data: "torihikisaki_cd="+torihikisaki_cd,
        success: function( response ){
            var torihikisaki_details = response[0][selected_field_name];
            document.getElementById(fillable_id).value= torihikisaki_details;
            document.getElementById(db_fillable_id).value= torihikisaki_cd;
            $("#supplierModal").modal('hide');
            document.getElementById('choice_buttonApi').disabled=true;

            //load flat rate entry dependant data
            if($("#page_name").length > 0 && $("#page_name").val() == 'flatRateEntry' && dependant_status == 1){
                loadFlatRateDependantData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
            }

            //load order entry dependant data
            if($("#page_name").length > 0 && $("#page_name").val() == 'orderEntry' && dependant_status == 1){
                loadOrderEntryData1(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
            }
            if($("#page_name").length > 0 && $("#page_name").val() == 'orderEntry' && dependant_status == 2){
                loadOrderEntryData2(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
            }

            //load deposit application data
            if($("#page_name").length > 0 && $("#page_name").val() == 'depositApplication'){
                loadDepositApplicationData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
            }


        }
    });

}
</script>

