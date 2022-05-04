<div class="modal custom-data-modal" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white custom-form" id="table-basic">
                        <tbody class="pl-4 pr-4">
                        <tr>
                            <td class="border-left-0"
                                style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                                <div class="line-icon-box"></div>入金方法
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control"  autofocus>
                                        <option value="0">01 現金入金</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>入金月
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow" style="width: 85%;display: inline-block;">
                                    <select class="form-control" style="">
                                        <option value="0">検収条件を選択</option>
                                    </select>
                                </div>
                                <div style="width: 15%;display: inline-block;text-align: center;">ヵ月後</div>
                            </td>

                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>入金日
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" style="width: 85%;">
                                        <option value="0">1</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                                <div class="line-icon-box"></div>即時区分
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 20px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" >
                                        <option value="0">1 即時</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                                <div class="line-icon-box"></div>請求課税区分
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 20px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" >
                                        <option value="0">20 １０％</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                                <div class="line-icon-box"></div>仕入先
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 20px !important;">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="会社名／事業所／個人" readonly="">
                                    <div class="input-group-append" data-toggle="modal" data-target="">
                                        <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                                                                                                                 aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
                        入力する
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal custom-data-modal" data-backdrop="static" id="exampleModal2" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>商品</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
            </div>
            <div class="modal-body square-title pt-0 pr-1 pl-1" style="border: 2px solid #fff;"
                 data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white" id="table-basic">
                        <tbody class="pl-4 pr-4">
                        <tr>
                            <td
                                style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>品目群
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" autofocus>
                                        <option value="0">99　NNNNNNNNNNNNNNNNNNNN</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>製品区分
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control">
                                        <option value="0">製品区分を選択</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>品目区分
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control">
                                        <option value="0">品目区分を選択</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;">
                                <div class="line-icon-box"></div>販売形態
                            </td>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control">
                                        <option value="0">販売形態を選択</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;">
                                <div class="line-icon-box"></div>バージョン区分
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" style="width: 92%;float: right;">
                                        <option value="0">バージョン区分を選択</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-4 pr-4">
                    <h6 class="text-white" style="margin-top: 30px;margin-bottom: 23px;">
                        <div class="line-icon-box"></div>商品選択（商品CD/商品名）
                    </h6>
                    <div class="scrollbararea" style="height: 146px; overflow-y: scroll; cursor: pointer;">
                        <table class="table modal-inner modal-table-white text-dark bg-white"
                               style="margin-bottom: 0px !important;">
                            <thead class="header text-center" id="myHeader">
                            </thead>
                            <tbody>
                            <tr class="show_personal_master_info">
                                <td>99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info add_border">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>

                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">99999</td>
                                <td>NNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                                                                                                                 aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
                        入力する
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal custom-modal" data-backdrop="static" id="exampleModal4" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue" data-bind="nextFieldOnEnter:true">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>商品サブ</strong></h5>
                <span class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;">
                <div class="pl-4 pr-4" style="margin-top: 20px;">
                    <table class="table" style="border: none!important;width: auto;">
                        <tbody>
                        <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-box-icon mr-3"></div>
                            </td>
                            <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                            <td style=" width: 100%; border: none!important;"><input type="text" autofocus class="form-control"
                                                                                     id="lastname" placeholder="検索ワード"
                                                                                     style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;"></td>
                            <td style=" border: none!important;"><button type="button" class="btn text-white btn_search"
                                                                         id="searchButton_psub" style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                                    <!-- 検索 -->
                                </button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-4 pr-4 dataModal6-1 square-title dataModal6" id="initial_content_product_sub">
                    <div class="border-line"></div>
                    <h4 style="margin-top: 20px;margin-bottom: 23px;"><span>商品サブ名称（CD/名称）</span></h4>
                    <div class="scrollbararea" style="height: 200px; overflow-y: scroll; cursor: pointer;">
                        <table class="table modal-inner modal-table-white text-dark" style="margin-bottom: 0px !important">
                            <thead class="header text-center" id="myHeader">
                            </thead>
                            <tbody>
                            <tr class="show_personal_master_info">
                                <td>XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info add_border">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>

                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            <tr class="show_personal_master_info">
                                <td style="width:50px;">XXXXXXXXXX</td>
                                <td>NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="b-color" style="margin-bottom: 15px;margin-top: 20px;"><span>商品サブ情報</span></h4>
                    <div class="modal-div-row" style="width: 100%;">
                        <div
                            style="border-bottom: 1px solid #22476b; padding: 3px 8px;overflow: hidden;font-size: 12px;color: #fff;">
                            <div style="width: 84px;float: left;">
                                商品サブCD
                            </div>
                            <div class="separate" style="float: left;padding-left: 10px;padding-right: 10px;">
                                XXXXXXXXXX
                            </div>
                            <div class="" style="float: left;padding-left: 10px;">
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #22476b; padding: 3px 8px;overflow: hidden;font-size: 12px;color: #fff;">
                            <div style="width: 84px;float: left;">
                                商品サブ名称
                            </div>
                            <div class="separate" style="float: left;padding-left: 10px;padding-right: 10px;">
                                NNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
                            </div>
                            <div class="" style="float: left;padding-left: 10px;">
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #22476b; padding: 3px 8px;overflow: hidden;font-size: 12px;color: #fff;">
                            <div style="width: 84px;float: left;">
                                取引先
                            </div>
                            <div class="separate" style="width: 56px;float: left;padding-left: 10px;">
                                99999
                            </div>
                            <div class="separate" style="float: left;padding-left: 10px;">
                                NNNNNNNNNNNNNNN
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #22476b; padding: 3px 8px;overflow: hidden;font-size: 12px;color: #fff;">
                            <div style="width: 84px;float: left;">
                                データ種
                            </div>
                            <div class="separate" style="width: 56px;float: left;padding-left: 10px;">
                                999
                            </div>
                            <div class="separate" style="float: left;padding-left: 10px;">
                                NNNNNNNNNNNNNNN
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #22476b; padding: 3px 8px;overflow: hidden;font-size: 12px;color: #fff;">
                            <div style="width: 84px;float: left;">
                                バージョン
                            </div>
                            <div class="separate" style="width: 56px;float: left;padding-left: 10px;">
                                99
                            </div>
                            <div class="separate" style="float: left;padding-left: 10px;">
                                NNNNNNNNNNNNNNN
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="" class="btn text-white bg-default w-145" data-dismiss="modal"> <i class=""
                                                                                                                 aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="pr_sub_choice_button" class="btn bg-teal text-white w-145 ml-2"
                            data-dismiss="modal">
                        入力する
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" data-keyboard="false" data-backdrop="static" id="detailsModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(詳細)</h6> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="development_page_top_table heading_mt" style="margin:11px;">

                    <!--======================= button start ======================-->

                    <div class="row titlebr" style="margin-bottom: 15px;">

                        <div class="col-lg-6 pl-1" style="padding-top: 9px;">
                            <h5 class="">商品説明マスタ(詳細)</h5>
                        </div>

                        <div class="col-lg-6" style="">
                            {{-- <table class="dev_tble_button" style="float: right;">
                              <tbody>
                                <tr class="marge_in">
                                  <td class="">

                                    <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal"
                                      data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                                      </i>削除
                                    </a>


                                  </td>
                                  <td class="">
                                    <a class="btn btn-info scroll" id="product_des_Button3" data-toggle="modal"
                                      data-target="#editModal" style="width: 100%;"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                                  </td>
                                  <td class="" style="padding-left:6px!important;">
                                    <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                                        style="margin-right: 5px;"></i>データを戻す</a>
                                  </td>

                                  {{-- <td class="">
                                    <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true"
                                        style="margin-right: 5px;"></i>印刷</a>
                                  </td> --}}
                            </tr>
                            </tbody>
                            </table>

                        </div>

                    </div>

                    <!--======================= button  end ======================-->
                </div>
                <!--======================= modal 2 table start here ======================-->
                <div class="row mt-1 mb-3">

                    <div class="col-lg-12 col-md-12 col-sm-12">


                        <div class="tbl_name">
                            <div class="w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明CD区分</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            {{-- <div class="col-lg-2 col-md-2 col-sm-2 ">

                                                        <div class="m_t"></div>
                                                    </div> --}}
                                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                                                <div class="m_t" style="font-size:12px;">
                                                    商品　
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>商品説明CD </span> <span style="color: red;">※</span> </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-2 col-md-2 col-sm-3 ">

                                                <div style="position:relative;">

                                                    <div class="m_t">00571</div>


                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 ">
                                                <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
                                            </div>

                                        </div>



                                    </div>

                                </div>
                            </div>
                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>見積明細備考</span> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">

                                            <div class="m_t">(成果物) システム計画書</div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>サービス内容</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">

                                            <div class="m_t" style="white-space: normal;word-break: break-all;">
                                                <div>事前打ち合わせ、製品機能説明、社内環境整備、パッケージ操作指導（開発ツールは含まず）</div>
                                                <div>＊開発指導のみの場合不要</div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>工数目安</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">

                                            <div class="m_t" style="white-space: normal; word-break: break-all;">
                                                <div>社内0.5日</div>
                                                <div>打合せ1～1.5日</div>
                                                <div>訪問作業0.5日</div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>成果物</span> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">

                                            <div class="m_t">システム計画書</div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>社内備考</span> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-3 col-sm-3 ">

                                            <div class="m_t"></div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>販売時留意点</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">

                                            <div class="m_t" style="white-space: normal;word-break: break-all;"></div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>商品説明PDF</span> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <div style="position:relative;">

                                                <div class="m_t">20191225AM-notes.PDF</div>

                                            </div>



                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>補足説明</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                            <div class="m_t" style="white-space: normal;word-break: break-all;">(当面未使用)</div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row" style="border-bottom: none;">
                                        <div class="col-lg-2 col-md-2 col-sm-2 ">

                                            <div class="m_t">2</div>

                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                                            <div class="m_t" style="font-size:12px;">
                                                0：訂正不可　1：訂正可
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!--======================= modal 2 table end here ======================-->
        </div>
    </div>
</div>
<div class="modal" data-keyboard="false" data-backdrop="static" id="messageModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(詳細)</h6> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="tbl_name">
                            <div class="w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-12 col-md-3 col-sm-3">
                                        <div><span>商品説明CD区分 商品説明CD区分</span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;padding-top: 0px;">
                <button style="background: #2C66B0" type="button" class="btn btn-primary" data-dismiss="modal">はい</button>
            </div>
        </div>
    </div>
</div>
