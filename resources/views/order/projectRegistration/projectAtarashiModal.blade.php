<div class="modal custom-modal" data-backdrop="static"  id="company_selection_modal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 9999;" data-bind="nextFieldOnEnter:true">
    <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">取引先</h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true">&times;</i>
          </span>
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
                      <td style=" width: 100%; border: none!important;"><input type="text" autofocus class="form-control" id="lastname"
                          placeholder="検索ワード" style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;"></td>
                      <td style=" border: none!important;"><button type="button" class="btn bg-teal text-white btn_search"
                          id="searchButton" style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                        </button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    $('#searchButton').click(function(){
                        document.getElementById('choice_buttonApi').disabled=true;
                        //$("#company_content_div_last").hide();
                        var value = $('#lastname').val().toLowerCase();
                        var count = 0;
                        $("#table-basic tr").filter(function() {
                            if($(this).text().toLowerCase().indexOf(value) > -1) count++;

                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });

                        if(count == 0){
                            $("#supplier_err_msg").html("検索結果に該当するデータがありません");
                        }else{
                            $("#supplier_err_msg").html("");
                        }

                        $('#detail_yobi12').html("");
                        $('#detail_name').html("");
                        $('#detail_yobi13').html("");
                        $('#detail_torihikisakibango').html("");
                        $('#detail_denpyostart').html("");
                        $('#detail_yetoiawsestart').html("");
                        $('#detail_mjn_mn').html("");
                        $('#detail_kensakukey').html("");

                    });
                });
            </script>

            <div class="col-lg-6">
                <div id="supplier_err_msg" style="font-size: 14px; color: #ff0000;">

                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="table_wrap" >
                <div class=" page4_table_design mt-2  table_hover  table-head-only">

                  <div id="initial_content">
                    <div class="border-line"></div>
                    <h4 style="margin-bottom: 15px;margin-top: 10px;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>

                    <div class="modal-table-white scrollbararea" style="min-height: 80px; height: 310px; width: 100%;cursor: pointer; overflow-y: scroll;">
                      <div class="first-table">
                       <table class="table content-table" id="table-basic">
                            <tbody class="">
                                @foreach($popUpData['kokyaku1'] as $kokyaku)
                                <?php
                                $kokyaku1Arr = ["name"=>$kokyaku->name,"yobi13"=>$kokyaku->yobi13,"torihikisakibango"=>$kokyaku->torihikisakibango,"ytoiawsestart"=>$kokyaku->ytoiawsestart_supplier,"yetoiawsestart" => $kokyaku->yetoiawsestart,"denpyostart"=>$kokyaku->denpyostart,"ytoiawsesaiban"=>$kokyaku->ytoiawsesaiban_detail,"mail_jyushin_mb"=>$kokyaku->mail_jyushin_mb,"mail_nouhin"=>$kokyaku->mail_nouhin,"kensakukey"=>$kokyaku->kensakukey];
                                ?>
                                    <tr class="show_company_master_info table_hover2 grid trFocus" tabindex="0" id="{{$kokyaku->yobi12}}" onclick="getCompanyDetail('{{route('companyDetailApi',[$bango,$kokyaku->bango])}}','{{$kokyaku->bango}}','{{$kokyaku->yobi12}}','{{$kokyaku->address}}','{{json_encode($kokyaku1Arr)}}')">
                                        <td style="width: 50px; text-align: center;">{{$kokyaku->yobi12}}</td>
                                        <td> {{$kokyaku->name}} </td>
                                        <td style="display:none;"> {{$kokyaku->furigana}} </td>
                                    </tr>
                                @endforeach
                           </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-lg-6">
              <div id="company_content_div_last" style="margin-top: 22px;">
                <input type="hidden" id="kokyakuIP" value="">
                <input type="hidden" id="kokyakuAddress" value="">

                <div style="width: 99%;">
                  <div class="heading">

                  </div>
                  <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                  <table class="table modal-table-blue" id="detail_table_body">
                    <tbody>
                      <tr>
                        <td style="width: 112px;">番号</td>
                        <td style="width: 300px;" id="detail_yobi12"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">会社名</td>
                        <td style="width: 300px;" id="detail_name"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">帝国DB信用録PDF</td>
                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="detail_yobi13"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">帝国DB評点</td>
                        <td style="width: 300px;" id="detail_torihikisakibango"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">与信限度額</td>
                        <td style="width: 300px;" id="detail_denpyostart"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">入金日</td>
                        <td style="width: 300px;" id="detail_yetoiawsestart"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">請求書方式</td>
                        <td style="width: 300px;" id="detail_mjn_mn"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">社内備考（会社）</td>
                        <td style="width: 300px;white-space: normal;word-break: break-all;" id="detail_kensakukey"></td>
                      </tr>
                      <tr style="border:none;">
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                       <tr>
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                      <tr>
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>

            </div>
          </div>
          <!-- 2nd modal content end -->

          <!-- modal content enddd   -->

        </div>
        <div class="modal-footer pl-4 pr-4">
            <input id="fillable_id" type="hidden">
            <input id="fillable_show_id" type="hidden">
          <button type="button" id="reset_button" class="btn text-white w-145 bg-default"> <i class="" aria-hidden="true"
              style="margin-right: 5px;"></i>キャンセル
          </button>
          <button type="button" id="choice_buttonApi" onclick="sum()" class="btn bg-teal2 btn-info w-145 ml-2" data-dismiss="modal"> <i
              class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> 入力する
          </button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    function getCompanyDetail(url,id,yobi12,address,kokyaku1String)
    {
        document.getElementById('kokyakuIP').value = yobi12;
        document.getElementById('kokyakuAddress').value = address;
        
        var kokyaku1Obj = JSON.parse(kokyaku1String);

        if (yobi12 != null){
            document.getElementById('choice_buttonApi').disabled=false;
        }

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

        $('#detail_yobi12').html(yobi12);
        $('#detail_name').html(kokyaku1Obj.name);
        $('#detail_yobi13').html(kokyaku1Obj.yobi13);
        $('#detail_torihikisakibango').html(kokyaku1Obj.torihikisakibango);
        $('#detail_denpyostart').html(formatNumber(kokyaku1Obj.denpyostart));
        $('#detail_yetoiawsestart').html(payment);
        $('#detail_mjn_mn').html(mjn_mn);
        $('#detail_kensakukey').html(kokyaku1Obj.kensakukey);
    }

    function sum(){
        var kokyaku = document.getElementById('kokyakuIP').value;
        var kokyakuAddress = document.getElementById('kokyakuAddress').value;
        var fillable_id = $("#fillable_id").val();
        var fillable_show_id = $("#fillable_show_id").val();
        document.getElementById(fillable_id).value= kokyaku.toString();
        document.getElementById(fillable_show_id).value= kokyakuAddress.toString();

        //trigger for font validation
        $('#'+fillable_id).trigger('keyup');

        $("#company_selection_modal").modal('hide');
        document.getElementById('choice_buttonApi').disabled=true;
    }
</script>
