<div class="modal custom-data-modal" data-backdrop="static" id="productModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog parentOfPoductPopUp" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>商品</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </span>
            </div>
            <!-- <input type="hidden" id="saveProductId" name="saveProductId" value=""> -->
            <div class="modal-body square-title pt-0 pr-1 pl-1" style="border: 2px solid #fff;"
                 data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white" id="table-basic">
                        <input type="hidden" id="productInputId"/>
                        <input type="hidden" id="productInputName"/>
                        <input type="hidden" id="syohin100"/>
                        <input type="hidden" id="childProductCount"/>
                        <input type="hidden" id="shoyinProductStatus"/>
                        <input type="hidden" id="shoyinKongouritsu"/>
                        <input type="hidden" id="shoyinMdjouhou"/>
                        <input type="hidden" id="shoyinColor"/>
                        <input type="hidden" id="shoyinUrl"/>
                        <input type="hidden" id="shoyinTokuchou"/>
                        <input type="hidden" id="shoyinData22"/>
                        <input type="hidden" id="shoyinData51"/>
                        <input type="hidden" id="manufactureProductNameMd"/>
                        <input type="hidden" id="manufacturePartNumberMd"/>
                        <input type="hidden" id="maintanceMd"/>
                        <input type="hidden" id="sourceProduct"/>
                        <input type="hidden" id="shippingInstructionId"/>
                        <tbody class="pl-4 pr-4">
                        <tr>
                            <td style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>
                                品目群
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control itemGroup" autofocus id="" onchange="filterCategoryKanri($(this))">
                                        <option data-categoryType="C4" data-categoryValue="" value="">選択無し</option>
                                        @foreach($c4Categorykanries as $category)
                                            <option data-categoryType="{{ $category->category1 }}"
                                                    data-categoryValue="{{$category->category2 }}"
                                                    value="{{ $category->category1 . $category->category2 }}"> {{ $category->category2 ." ". $category->category4 }}</option>
                                            "
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>
                                製品区分
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control productCategory" id="" onchange="filterCategoryKanri($(this))">
                                        <option data-categorytype="" data-categoryvalue="" value="">選択無し</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>
                                品目区分
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control itemClassification" id="" onchange="handleProductChangeOnly($(this))">
                                        <option data-categorytype="" data-categoryvalue="" value="">選択無し</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;">
                                <div class="line-icon-box"></div>
                                販売形態
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control salesFrom" id="" onchange="handleProductChangeOnly($(this))">
                                        <option data-categoryType="" data-categoryValue="" value="">選択無し</option>

                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;">
                                <div class="line-icon-box"></div>
                                バージョン区分
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control versionClassification" style="width: 92%;float: right;"
                                            id="" onchange="handleProductChangeOnly($(this))">
                                        <option data-categorytype="" data-categoryvalue="" value="">選択無し</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-4 pr-4">
                    <h6 class="text-white insert_table_data" style="margin-top: 30px;margin-bottom: 23px;">
                        <div class="line-icon-box"></div>
                        商品選択（商品CD/商品名）
                    </h6>


                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="productModalClose" class="btn text-white w-145 bg-default">
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="productSelect" class="btn w-145 bg-teal text-white ml-2" disabled="disabled">入力する</button>
                </div>
            </div>
        </div>
    </div>
</div>
