<form id="detailViewForm" action="{{ route('employeeMaster',$bango) }}" method="post">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="product_code_modal2" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 840px;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="row titlebr" style="margin-bottom: 15px;">

            {{-- Error Message Starts Here --}}
            <div class="col-12">
              <div id="detail_product_error_data" style="margin-left: -14px;"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="col-6">
              <h5>商品マスタ(詳細)</h5>
            </div>
            <div class="col-6">
              <div>
                <table class="dev_tble_button" style="float: right;">
                  <tbody>
                    <tr class="marge_in">
                      @if($tantousya->innerlevel <= 10) 
                      <td class="" style="padding-right: 7px!important;">
                        <a id="deleteThis" class="btn btn-info scroll" style="background-color: #3e6ec1!important;"
                          data-toggle="modal" data-target="#"
                          onclick="deleteProductMaster('{{route('deleteOrReturnProduct',[$bango])}}')" autofocus>
                          <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                      </td>
                      @endif
                      <td class="productButton3" style="padding-left: 0px!important;width: 70px!important;">
                        <a href="#" class="btn btn-info" id="productButton3" style="width: 100%;" data-toggle="modal"
                          data-target="#product_code_modal3">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                        </a>
                      </td>
                      @if($deleted_item )
                      <td class="">
                        <a class="btn btn-info scroll" onclick="returnProductMaster('{{route('deleteOrReturnProduct',[$bango,1])}}')" id="btnRestore" style="">データを戻す</a>
                      </td>
                      @endif
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="row mt-1 mb-3">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品CD</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="detail_kokyakusyouhinbango">
                            00335
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品名</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_name">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品名略称</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_size"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>品目群</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_jouhou">03 Autoメール名人</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>製品区分</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_koyuujouhou">01 製品</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>品目区分</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_color">03 Autoメール名人</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>販売形態</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_bumon">1 1年ﾗｲｾﾝｽ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>バージョン</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_syouhin1_yoyaku"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>保守区分</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_data21">1 NULL</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>継続区分</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_tokuchou">1 NULL</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>新規VUP区分</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_data22">1 NULL</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>サブ区分</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_data23"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力区分１</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="m_t" id="detail_data24"> 1 入力可</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>仕入先</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-4 ">
                          <div class="m_t" id="detail_season"> 000001</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="tbl_product w-100">
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>基本販売価格</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_kakaku" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>PB販売価格</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_hanbaisu" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>営業粗利</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_jyougensu" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>PB営業粗利</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_yoyaku" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="tbl_product w-100">
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>仕入価格</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_yoyakusu" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>仕切(SE)</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_yoyakukanousu" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>仕切(研究所)</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_sortbango" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>仕切(出荷ｾﾝﾀｰ)</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_dataint01" style="text-align: right;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="tbl_product w-100">
                <div class=" row row_data" style="margin-top: 29px;">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>価格設定区分</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_meker"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data" style="">
                  <div class="col-lg-4">
                    <div class="margin_t ">
                      <span>単位</span>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_konpoumei"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data" style="">
                  <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="margin_t ">
                      <span>単価区分</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_data101"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-12">
              <div class="tbl_product w-100">
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>入力区分２</span> <span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data25">0 マスタ索引</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>上市開始日</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_synchrosyouhinbango"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>終売日</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="m_t" id="detail_endtime"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>製品仕入品区分</span><span style="color: red;">※</span>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data52">1 自社品</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>事業分類</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data53">01 自社製品</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>保守サブスク区分</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data54">03 Autoメール名人</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>商品分類3</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data100">99 製品</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data50">1 ﾎﾞﾘｭｰﾑﾗｲｾﾝｽﾊﾟﾀｰﾝ①</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="m_t" id="detail_data51">1 ﾒｼﾞｬｰ50％</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>最新ﾊﾞｰｼﾞｮﾝ区分</span> 
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="m_t" id="detail_data26"> 1 最新</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>前受請求区分</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="m_t" id="detail_data27">1 通常</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>請求課税区分</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_data28">1 通常1 10%</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>販売可能</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_data29"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="outer row">
                      <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="margin_t ">
                          <span>保守作成区分</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="m_t" id="detail_url"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="tbl_product w-100">
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>受注先限定</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="m_t" id="detail_jouhou2"></div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data" id="d_url_mobile">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>保守商品CD</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_url_mobile"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>セット商品上位CD</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-4 col-md-4 col-sm-4 ">
                        <div class="m_t" id="detail_chardata4"></div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-8 col-md-8 col-sm-8">
              <div class="tbl_product w-100">
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>メーカー品番</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_kongouritsu"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>メーカー品名</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="detail_mdjouhou"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="margin_t ">
                      <span>保守会社</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="m_t" id="detail_data104"></div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>内訳製品粗利比率</span>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12">
                        <div class="m_t" id="detail_dspbango"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>UIS対象商品</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12">
                        <div class="m_t" id="detail_syouhin4_color"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>納品方法</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12 ">
                        <div class="m_t" id="detail_syouhin4_size"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>予備4</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12 ">
                        <div class="m_t" id="detail_syouhingroup"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>予備5</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12">
                        <div class="m_t" id="detail_ruijihinbango"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>予備6</span>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12">
                        <div class="m_t" id="detail_chardata1"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3 col-md-3 sm-3">
                    <div class="margin_t ">
                      <span>予備7</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 sm-9">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 sm-12 ">
                        <div class="m_t" id="detail_chardata2"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
</form>
