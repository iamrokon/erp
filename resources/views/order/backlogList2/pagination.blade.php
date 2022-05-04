<div class="content-bottom-pagination">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
            <div class="row mb-1">
              <div class="col-7">
                <div class="pagi-content mt-3">
                  <table>
                    <tbody>
                      <tr>
                        @if(isset($backlogList2Info) && $backlogList2Info->lastPage() > 1)
                            @include('layout.pagination_new.pagination_new1')
                        @endif

                        @include('layout.pagination_new.pagination_new2')

                        @if(isset($backlogList2Info) && $backlogList2Info->total() > 0)
                            @include('layout.pagination_new.pagination_new3')
                        @endif

                        @include('layout.pagination_new.pagination_new4')
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-5 d-flex justify-content-end">
                <div class=" mt-3 mb-3">
                  <table>
                    <tbody>
                      <tr>
                        @include('layout.pagination_new.pagination_new5')
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
              </div>
              <div class="col-6">
                <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                  <tbody>
                    <tr style="height: 28px;">
                      <td style=" border: none!important;">
                        <button onclick="Thesearch();" message="検索欄に入力した内容を検索します。" disabled type="button" id="choice_button"
                            class="btn bg-teal uskc-button text-white"
                             data-dismiss="modal" style="width: 150px;">
                         検　索
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button onclick="refresh()" message="データを一覧表示します。" disabled type="button" id="" class="btn text-white bg-default uskc-button"
                          data-dismiss="modal" style="width: 150px;">
                           一　覧
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button id="excelDwld" onclick="excelDownload()"
                              message="データをEXCELファイルとしてダウンロードします。" type="button" class="btn text-white uskc-button" data-dismiss="modal"
                          style="width: 159px;background: #009640;">
                           Excelエクスポート
                        </button>


                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div>
        </div>
      </div>


    </div>
  </div>