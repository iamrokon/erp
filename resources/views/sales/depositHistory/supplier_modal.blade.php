<div class="modal custom-modal" data-backdrop="static" id="SoldToModal" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">
            <div class="modal-header">
                <h5 class="modal-title">取引先</h5>
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
                                        <input type="text" autofocus class="form-control" id="lastname"
                                               placeholder="検索ワード"
                                               style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                                    </td>
                                    <td style=" border: none!important;">
                                        <button type="button" class="btn bg-teal text-white btn_search"
                                                id="office_search_button" style="border-radius: 0px;margin-left: -6px;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                                    <div class="modal-table-white"
                                         style="min-height: 80px;width: 100%;cursor: pointer;">
                                        <div class="first-table scrollbararea"
                                             style="height: 161px; overflow-y: scroll; cursor: pointer;">
                                            <table class="table content-table" id="table-body">
                                                <tbody class="">
                                                @foreach($popUpData['kokyaku1'] as $kokyaku)
                                                    <?php
                                                    $kokyaku1Arr = ["name" => $kokyaku->name, "yobi13" => $kokyaku->yobi13, "torihikisakibango" => $kokyaku->torihikisakibango, "ytoiawsestart" => $kokyaku->ytoiawsestart_supplier, "yetoiawsestart" => $kokyaku->yetoiawsestart, "denpyostart" => $kokyaku->denpyostart, "ytoiawsesaiban" => $kokyaku->ytoiawsesaiban_detail, "mail_jyushin_mb" => $kokyaku->mail_jyushin_mb, "mail_nouhin" => $kokyaku->mail_nouhin, "kensakukey" => $kokyaku->kensakukey];
                                                    ?>
                                                    <tr class="show_office_master_info table_hover2 grid trfocus"
                                                        tabindex="0" id="{{$kokyaku->yobi12}}"
                                                        onclick="getHaisouData('{{route('haisouApi',[$bango,$kokyaku->bango])}}','{{$kokyaku->yobi12}}','{{$kokyaku->address}}','{{json_encode($kokyaku1Arr)}}')">
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
                                        <div id="office_master_content_div_table" class="modal-table-white"
                                             style="min-height: 80px;width: 100%;cursor: pointer;">
                                            <div class="second-table scrollbararea"
                                                 style="height: 113px; overflow-y: scroll; cursor: pointer;">
                                                <table class="table ">
                                                    <thead class="header text-center" id="myHeader"></thead>
                                                    <tbody id="haisou-table">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="kokyakuIP" value="">
                                <input type="hidden" id="haisouIP" value="">
                                <input type="hidden" id="kokyakuAddress" value="">
                                <input type="hidden" id="haisouHaisoumoji1" value="">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div id="office_content_div_last" style="margin-top: 38px;">
                            <div style="width: 99%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                                <table id="office_content_div_last_table" style="display: none;"
                                       class="table modal-table-blue">
                                    <tbody>
                                    <tr>
                                        <td style="width: 112px;">番号</td>
                                        <td style="width: 300px;" id="table_datatxt0049"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">会社名</td>
                                        <td style="width: 300px;" id="table_company_name"></td>
                                        <!-- id="table_datatxt0014" -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">事業所名</td>
                                        <td style="width: 300px;" id="table_office_name"></td>
                                        <!-- id="table_datatxt0015" -->
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
                                        <td style="width: 300px;white-space: normal;word-break: break-all;"
                                            id="table_yobi13"></td> <!-- sample-sinyo.pdf -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">帝国DB評点</td>
                                        <td style="width: 300px;" id="table_torihikisakibango"></td> <!-- 59 -->
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">与信限度額</td>
                                        <td style="width: 300px;" id="table_denpyostart"></td>
                                        <!-- 3,000,000／残 750,000 -->
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
                                        <td style="width: 300px;white-space: normal;word-break: break-all;"
                                            id="table_kensakukey"></td> <!-- 社内備考 -->
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
                <input id="fillable_id" type="hidden"/>
                <input id="db_fillable_id" type="hidden"/>
                <button type="button" id="dismiss_button" class="btn text-white w-145 bg-teal3" >
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>親画面をクリア
                </button>
                <button type="button" id="reset_button" class="btn text-white w-145 bg-default" >
                    <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_buttonApi" onclick="sum()" class="btn w-145 bg-teal text-white ml-2"
                        data-dismiss="modal">入力する
                </button>
            </div>
        </div>
    </div>
</div>
