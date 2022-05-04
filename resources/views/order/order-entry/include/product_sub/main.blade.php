<div class="modal custom-modal" data-backdrop="static" id="productSubModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue" data-bind="nextFieldOnEnter:true">
            <input type="hidden" id="default">
            <input type="hidden" id="productCD">
            <input type="hidden" id="targetProductSubField">
            <input type="hidden" id="targetProductSubNameField">

            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>商品サブ</strong></h5>
                <button type="button" ignore class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                            <td style=" width: 100%; border: none!important;">
                                <input type="text" autofocus class="form-control" maxlength="30" id="productSubValue" placeholder="検索ワード" style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                            </td>
                            <td style=" border: none!important;">
                                <button type="button" class="btn bg-teal text-white btn_search" id="product_sub_search" style="border-radius: 0px;margin-left: -6px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-4 pr-4 dataModal6-1 square-title dataModal6" id="initial_content_product_sub">
                    <div class="border-line"></div>
                    <h4 style="margin-top: 20px;margin-bottom: 23px;">
                        <span>商品サブ名称（CD/名称）</span></h4>
                    <div class="scrollbararea" style="height: 170px; overflow-y: scroll; cursor: pointer;">
                        <table class="table modal-inner modal-table-white text-dark"
                               style="margin-bottom: 0px !important">
                            <thead class="header text-center" id="myHeader">
                            </thead>
                            <tbody id="insert_product_sub">
{{--                            insert product sub--}}
                            </tbody>
                        </table>
                    </div>
                    <h4 class="b-color" style="margin-bottom: 15px;margin-top: 20px;"><span>商品サブ情報</span></h4>
                    <div class="modal-div-row" style="width: 100%;" id="insert_product_sub_detail">
                        @include('order/order-entry/include/product_sub/product_sub_detail')
{{--                        insert product sub detail--}}
                    </div>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="clearProductSub" class="btn text-white w-145 bg-teal3"> <i class="" aria-hidden="true" style="margin-right: 5px;"></i>親画面をクリア
                    </button>

                    <button type="button" id="closeProductSub"  class="btn text-white bg-default w-145" >
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="selectProductSub" class="btn btn-info w-145 ml-2" >
                       入力する
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
