<div class="modal custom-modal" data-backdrop="static" id="SoldToModal" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">
            <div class="modal-header">
                <h5 class="modal-title" >取引先</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <input type="text" autofocus class="form-control" id="lastname" placeholder="検索ワード" style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
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
                        <div id="supplier_err_msg" style="font-size: 14px; color: #ff0000;">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="table_wrap">
                            <div class=" page4_table_design mt-2  table_hover  table-head-only">
                                <div id="initial_content">
                                    <div class="border-line"></div>
                                    <h4 style="margin-bottom: 15px;margin-top: 10px;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span>
                                    </h4>
                                    <div class="modal-table-white" style="min-height: 80px;width: 100%;cursor: pointer;">
                                        <div class="first-table scrollbararea" style="height: 161px; overflow-y: scroll; cursor: pointer;">
                                            <table class="table content-table" id="table-body">
                                                <tbody class="">
                                                    @foreach($popUpData['kokyaku1'] as $kokyaku)
                                                    <?php
                                                    $kokyaku1Arr = ["name"=>$kokyaku->name,"yobi13"=>$kokyaku->yobi13,"torihikisakibango"=>$kokyaku->torihikisakibango,"ytoiawsestart"=>$kokyaku->ytoiawsestart_supplier,"yetoiawsestart" => $kokyaku->yetoiawsestart,"denpyostart"=>$kokyaku->denpyostart,"ytoiawsesaiban"=>$kokyaku->ytoiawsesaiban_detail,"mail_jyushin_mb"=>$kokyaku->mail_jyushin_mb,"mail_nouhin"=>$kokyaku->mail_nouhin,"kensakukey"=>$kokyaku->kensakukey];
                                                    ?>
                                                        <tr class="show_office_master_info table_hover2 grid trFocus trfocus" tabindex="0" id="{{$kokyaku->yobi12}}" onclick="getHaisouData('{{route('haisouApi',[$bango,$kokyaku->bango])}}','{{$kokyaku->yobi12}}','{{$kokyaku->address}}','{{json_encode($kokyaku1Arr)}}')">
                                                            <td style="width: 50px;">{{$kokyaku->yobi12}}</td>
                                                            <td> {{$kokyaku->name}} </td>
                                                            <td style="display:none;"> {{$kokyaku->furigana}} </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="office_master_content_div">
                                    <!-- 2nd modal content -->
                                    <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ　（事業所CD/事業所名）</h4>
                                    <div style="height: 113px; background: #fff;">
                                        <div id="office_master_content_div_table" class="modal-table-white" style="min-height: 80px;width: 100%;cursor: pointer;">
                                            <div class="second-table scrollbararea" style="height: 113px; overflow-y: scroll; cursor: pointer;">
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
                                    <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ　（個人CD/名称）</h4>

                                    <input type="hidden" id="kokyakuIP" value="">
                                    <input type="hidden" id="haisouIP" value="">
                                    <input type="hidden" id="etsuransyaIP" value="">

                                    <input type="hidden" id="kokyakuAddress" value="">
                                    <input type="hidden" id="haisouHaisoumoji1" value="">
                                    <input type="hidden" id="etsuransyaTantousya" value="">
                                    <input type="hidden" id="etsuransyaMail4" value="">

                                    <div style="height: 85px; background: #fff;">
                                        <div id="personal_master_content_div_table" class=" modal-table-white" style="width: 100%; min-height: 80px;cursor: pointer;">
                                            <div class="third-table scrollbararea" style="height: 85px; overflow-y: scroll; cursor: pointer;">
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
                        <div id="office_content_div_last" style="margin-top: 38px;">
                            <div style="width: 99%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table" style="display: none;" class="table modal-table-blue">
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
                                        <td style="width: 112px;">与信限度額</td>
                                        <td style="width: 300px;" id="table_denpyostart"></td> <!-- 3,000,000／残 750,000 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">入金日</td>
                                        <td style="width: 300px;" id="table_payment"></td> <!-- 10日締 翌々月 20日 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">請求書方式</td>
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
                                    <tr style="display: none;">
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
            <div class="modal-footer pl-4 pr-4">
                <input id="fillable_id" type="hidden" />
                <input id="db_fillable_id" type="hidden"/>
                <button type="button" id="reset_button" class="btn text-white w-145 bg-default" data-dismiss="">
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi" onclick="sum()" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">入力する</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function getHaisouData(url,kokyaku,address,kokyaku1String){
    //reset business partner info except company
    resetBusinessPartnerInfoExceptCompany();

    var kokyaku1Obj = JSON.parse(kokyaku1String);

    $("#office_content_div_last_table").show();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div_table").hide();
    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('kokyakuIP').value= kokyaku;
    document.getElementById('kokyakuAddress').value= address;
    document.getElementById('table_office_name').innerHTML = "";

    if(kokyaku1Obj.mail_jyushin_mb== null){
        if(kokyaku1Obj.mail_nouhin == null){
            var mjn_mn = "";
        }else{
            var mjn_mn = "/"+kokyaku1Obj.mail_nouhin;
        }
    }else if(kokyaku1Obj.mail_nouhin == null){
        if(kokyaku1Obj.mail_jyushin_mb == null){
            var mjn_mn = "";
        }else{
            var mjn_mn = kokyaku1Obj.mail_jyushin_mb;
        }
    }else{
        var mjn_mn = kokyaku1Obj.mail_jyushin_mb+"/"+kokyaku1Obj.mail_nouhin;
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
        url:  url,
        type: "GET",
        data: url,
        success: function( response )
        {
         //console.log(response)
         var html=null;
         $("#haisou-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             var addrs = response[i]['address'] != null ? response[i]['address'] : "";
             html+='<tr class="show_personal_master_info trFocus trfocus" tabindex="0" id="ets_'+response[i]['torihikisakibango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;">'+response[i]['torihikisakibango']+'</td>';
                    html+='<td>'+response[i]['name']+'</td>';
                    html += '<td>' + addrs + '</td>';
               // }
               html+='</tr>'

          }
          //console.log(html);
          //$("#office_master_content_div").show();
          $("#haisou-table").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['torihikisakibango'];
           var c= response[i]['haisoumoji1'];
           var officeName = response[i]['name'];
           document.getElementById("ets_" +response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya('+d+',"'+b+'","'+c+'","'+officeName+'")');
          }
          $("#office_master_content_div_table").show();
        },
      });
}

function goToEtsuransya(id,b,haisoumoji1,officeName){
    //reset business partner info except office info
    resetBusinessPartnerInfoFromOffice();

    $("#office_content_div_last_table").show();
    $("#personal_master_content_div_table").hide();

    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('haisouIP').value= b;
    document.getElementById('haisouHaisoumoji1').value= haisoumoji1;

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
         // console.log(response)
         var html=null;
         $("#etsuransya-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             var ml2 = response[i]['mail2'] != null ? response[i]['mail2'] : "";

             html+='<tr class="show_content_last trFocus trfocus" tabindex="0" data-serial="'+response[i]['datatxt0049']+'" id="'+response[i]['bango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;">'+response[i]['datatxt0049']+'</td>';
                    html+='<td id="etsr_tantousya">'+response[i]['tantousya']+'</td>';
                    html += '<td>' + ml2 + '</td>';
               // }
               html+='</tr>'

          }
          //console.log(html);
          //$("#office_master_content_div").show();
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
    document.getElementById('etsuransyaTantousya').value= tantousya;

    var num=id;
    var bango='{{$bango}}';
    var url='/office/etsuransyaDetailApi/'+bango+'/'+num ;
    //console.log(url)
    $.ajax({
        url:  url,
        type: "GET",
       // data: url,
        success: function( response ){
            var kokyaku = document.getElementById('kokyakuIP').value;
            var haisou = document.getElementById('haisouIP').value;
            var etsuransya = document.getElementById('etsuransyaIP').value;
            var dbHiddenValue = kokyaku + haisou + etsuransya;

            if (response.datatxt0049 != null){
                document.getElementById('choice_buttonApi').disabled=false;
            }

            $('#etsuransyaMail4').val(response.mail4);
            console.log(response);
            $('#table_datatxt0049').html(dbHiddenValue);
            //$('#table_datatxt0014').html(response.datatxt0014);
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
   var kokyaku= document.getElementById('kokyakuIP').value;
   var haisou= document.getElementById('haisouIP').value;
   var etsuransya= document.getElementById('etsuransyaIP').value;

   var kokyakuAddr= document.getElementById('kokyakuAddress').value;
   var haisouHaism= document.getElementById('haisouHaisoumoji1').value;
   var etsuransyaTant= document.getElementById('etsuransyaTantousya').value;
   var etsuransyaMail4= document.getElementById('etsuransyaMail4').value;
   var abbr_detail = kokyakuAddr+"/"+haisouHaism+"/"+etsuransyaTant;

   var dbHiddenValue = kokyaku + haisou + etsuransya;
   var fillable_id = $("#fillable_id").val();
   var db_fillable_id = $("#db_fillable_id").val();

   if(etsuransyaMail4.toString() == ""){
       var show_data = kokyakuAddr.toString()+"/"+haisouHaism.toString();
   }else if(haisouHaism.toString() == "" && etsuransyaMail4.toString() == ""){
       var show_data = kokyakuAddr.toString();
   }else{
       var show_data = kokyakuAddr.toString()+"/"+haisouHaism.toString()+"/"+etsuransyaMail4.toString();
   }

   document.getElementById(fillable_id).value= show_data;
   document.getElementById(db_fillable_id).value= dbHiddenValue;

   $("#SoldToModal").modal('hide');
   document.getElementById('choice_buttonApi').disabled=true;

}
</script>
