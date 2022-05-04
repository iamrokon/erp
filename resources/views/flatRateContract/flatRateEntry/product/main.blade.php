<div class="modal custom-data-modal" data-backdrop="static" id="productModal" tabindex="-1" role="dialog"
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
                      <select onchange="filterProductModalData(this)" class="form-control itemGroup" autofocus>
                        <option value="">選択無し</option>
                        @foreach($catC4Data as $ctC4Data)
                            <option data-categoryType="{{ $ctC4Data->category1 }}" data-categoryValue="{{$ctC4Data->category2 }}"
                                value="{{$ctC4Data->category1.$ctC4Data->category2}}">
                              {{$ctC4Data->category2." ".$ctC4Data->category4}}
                            </option>
                        @endforeach
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
                    <div class="custom-arrow ">
                      <select class="form-control productCategory">
                        <option value="">選択無し</option>
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
                      <select class="form-control itemClassification">
                        <option value="">選択無し</option>
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
                      <select class="form-control salesFrom">
                        <option value="">選択無し</option>
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
                      <select class="form-control versionClassification" style="width: 92%;float: right;">
                        <option value="">選択無し</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="pl-4 pr-4">
            <h6 class="text-white insert_table_data" style="margin-top: 30px;margin-bottom: 23px;">
              <div class="line-icon-box"></div>商品選択（商品CD/商品名）
            </h6>
            
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="productSelect" class="btn w-145 bg-teal text-white ml-2" disabled>
             入力する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>