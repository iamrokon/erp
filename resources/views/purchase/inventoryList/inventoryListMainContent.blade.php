<div class="content-bottom-section" style="padding-bottom:46px;">
  <form id="mainForm" action="{{ route('inventoryList') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
  @csrf
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          在庫一覧
          </div>
        </div>
      </div>
    </div>
    <div class="content-bottom-pagination" >
      <div class="container">
        <div class="row">
          <div class="col">
           <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
       
            <!-- new pagination row starts here -->
            @include('purchase.inventoryList.pagination')
            <!----------pagination End----------------->
            
            <div class="row">
              <div class="col-6">
              </div>
              <div class="col-6">
                  <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                      <tbody>
                        <tr style="height: 28px;">
                          <td style=" border: none!important;">
                              <button type="button" id="choice_button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" class="btn bg-teal uskc-button text-white" data-dismiss="modal" style="width: 150px;"> <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->検　索
                              </button>
                            </td>
                            <td style=" border: none!important;">
                              <button type="button" id="" onclick="refresh()" class="btn text-white bg-default uskc-button" data-dismiss="modal" style="width: 150px;"> <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                              </button>
                            </td>
                            <td style=" border: none!important;">
                                <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button" data-dismiss="modal" style="width: 159px;background: #009640;" @if(count($inventoryListData)<1) disabled @endif><!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> EXCELエクスポート
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
  </div>
  <div class="content-bottom-bottom" style="margin-top: 10px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div class="table-responsive largeTable">
              <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    @foreach($headers as $header=>$field)
                      @if($field == "formatted_inventory_purchase_amount")
                        <th scope="col" class="signbtn"> <span onclick="AscDsc('{{'inventory_purchase_amount'}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field == "formatted_inventory_purchase_unit_price")
                        <th scope="col" class="signbtn"> <span onclick="AscDsc('{{'inventory_purchase_unit_price'}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field == "formatted_inventory_purchase_quantity")
                        <th scope="col" class="signbtn"> <span onclick="AscDsc('{{'inventory_purchase_quantity'}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field == "formatted_inventory_tax_amount")
                        <th scope="col" class="signbtn"> <span onclick="AscDsc('{{'inventory_tax_amount'}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                      @else
                        <th scope="col" class="signbtn"> <span onclick="AscDsc('{{$field}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                      @endif
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($headers as $header=>$field)
                      @if($field == "formatted_inventory_purchase_amount")
                        <td><input type="text" name="inventory_purchase_amount" value="{{isset($old['inventory_purchase_amount'])?$old['inventory_purchase_amount']:null}}" class="form-control"></td>
                      @elseif($field == "formatted_inventory_purchase_unit_price")
                        <td><input type="text" name="inventory_purchase_unit_price" value="{{isset($old['inventory_purchase_unit_price'])?$old['inventory_purchase_unit_price']:null}}" class="form-control"></td>
                      @elseif($field == "formatted_inventory_purchase_quantity")
                        <td><input type="text" name="inventory_purchase_quantity" value="{{isset($old['inventory_purchase_quantity'])?$old['inventory_purchase_quantity']:null}}" class="form-control"></td>
                      @elseif($field == "formatted_inventory_tax_amount")
                        <td><input type="text" name="inventory_tax_amount" value="{{isset($old['inventory_tax_amount'])?$old['inventory_tax_amount']:null}}" class="form-control"></td>
                      @elseif($field == "purchase_person")
                      <td><input type="text" name="purchase_person_sort" value="{{isset($old['purchase_person_sort'])?$old['purchase_person_sort']:null}}" class="form-control"></td>
                      @else
                        <td><input type="text" name="{{$field}}" value="{{isset($old[$field])?$old[$field]:null}}" class="form-control"></td>
                      @endif
                    @endforeach
                  </tr>
                  <!-- 2nd row -->
                  @if(isset($inventoryListData))
                    @foreach($inventoryListData as $key=>$val)
                      <tr>
                      @foreach($headers as $header=>$field)
                        @if($field == "formatted_inventory_purchase_amount")
                          <td style="text-align: right;">{{$val->inventory_purchase_amount != null?number_format($val->inventory_purchase_amount):$val->inventory_purchase_amount}}</td>
                        @elseif($field == "formatted_inventory_purchase_unit_price")
                          <td style="text-align: right;">{{$val->inventory_purchase_unit_price != null?number_format($val->inventory_purchase_unit_price):$val->inventory_purchase_unit_price}}</td>
                        @elseif($field == "formatted_inventory_purchase_quantity")
                          <td style="text-align: right;">{{$val->inventory_purchase_quantity != null?number_format($val->inventory_purchase_quantity):$val->inventory_purchase_quantity}}</td>
                        @elseif($field == "formatted_inventory_tax_amount")
                          <td style="text-align: right;">{{$val->inventory_tax_amount != null?number_format($val->inventory_tax_amount):$val->inventory_tax_amount}}</td>
                        @elseif($field == "purchase_person")
                          <td>{{$val->purchase_person_short}}</td>
                        @else
                          <td>{{$val->$field}}</td>
                        @endif
                      @endforeach
                      </tr>
                    @endforeach
                  @endif
                  <!-- <tr>
                    <td> 1 オリ営業部</td>
                    <td>1 Aグループ</td>
                    <td>2020/03/26</td>
                    <td>カイパラ/本社/シス </td>
                    <td class="text-right">99999 </td>
                    <td>ＮＮＮＮ５/ＮＮＮＮ０…</td>
                    <td class="text-right">55,537</td>
                    <td>2021/01/18</td>
                    <td> 0149100423</td>
                    <td>10 通常受注</td>
                    <td>50 外注</td>
                    <td>小川　卓也</td>
                    <td></td>
                  
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  
                  </tr> -->
                  <!-- 3rd row -->
                  <!-- <tr>
                    <td>9 NNNN5NNNN0</td>
                    <td>9 NNNN5NNNN0 </td>
                    <td>yyyy/mm/dd</td>
                    <td>ＮＮＮＮ５/ＮＮＮ/ＮＮＮ… </td>
                    <td class="text-right">99,999 </td>
                    <td>ＮＮＮＮ５/ＮＮＮＮ０…</td>
                    <td class="text-right" >999,999,999</td>
                    <td>yyyy/mm/dd</td>
                    <td> 9999999999</td>
                    <td>20 通常保守</td>
                    <td>99 NNNN</td>
                    <td>小川　卓也</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr> -->
                  <!-- 3rd row -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</div>