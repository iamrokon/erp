
<div class="content-bottom-section mainContentPart2" id="mainContentPart2" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            明細
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-bottom-bottom">
    <div class="container">
      <div class="row">
       <div class="col-12">
        <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
         <div class="table-responsive largeTable">
           <table id="detailTable" class="table table-bordered table-fill table-striped custom-form"
             style="margin-bottom: 20px!important;">
             <thead class="thead-dark header text-center" id="detailTableHeader">
               <tr>
                 <th scope="col" class="signbtn"> <span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">発注番号行番号</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">品番</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 250px;margin: auto;background-color:#3e6ec1;color: #fff;">品名</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">数量</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 65px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 65px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 80px;margin: auto;background-color:#3e6ec1;color: #fff;">消費税</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                   style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 100px;margin: auto;background-color:#3e6ec1;color: #fff;">課税</span>
               </th>
               <th scope="col" class="signbtn"><span
                 style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 200px;margin: auto;background-color:#3e6ec1;color: #fff;">会計科目</span>
                </th>
               <th scope="col" class="signbtn"><span
               style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 200px;margin: auto;background-color:#3e6ec1;color: #fff;">会計科目内訳</span>
               </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 180px;margin: auto;background-color:#3e6ec1;color: #fff;">受注先</span>
                 </th>
                 <th scope="col" class="signbtn"><span
                     style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 280px;margin: auto;background-color:#3e6ec1;color: #fff;">明細備考</span>
                 </th>
               </tr>
             </thead>
             <tbody>
             <div class="" id="insertRowBefore"></div>
               <!-- 2nd row -->
               @php
                $i = 0;
                function numberFormat($value)
                {
                    return gettype($value) == 'double' ? number_format($value, 2) : number_format($value);
                }
                @endphp
                @if (!empty($products))
                @foreach ($products as $product)
                @php
                    $i++;
                @endphp
                  <tr id="LineBranch{{$i}}" class="table-line line-form">
                    <td>
                      <div class="data-box-content" style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                          <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                            <span id="lineValue" class="lineValue">{{$i}}</span>
                            <input type="hidden" class="line-input" name="line[]" value="{{$i}}">
                            </div>
                            <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                              <button class="lineBtn" id="lineBtn-{{$i}}" style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                              <button class="deleteBtn" id="deleteBtn-{{$i}}" data-toggle="modal" data-target="#confirm_line_delation_Modal_deposit" style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                  <div style="width: 175px !important;">
                      <div class="input-group position-relative">
                        <input type="text" class="form-control orderNumber" value="{{ $product->ordernumber ? $product->ordernumber : null }}" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="13" id="orderNumber-{{ $loop->index }}" name="orderNumber[]" placeholder=""  style="width: 114px!important;padding: 0!important; background:white!important;">
                        <div class="input-group-append">
                          <button class="input-group-text btn orderNumberModalOpener" style="background:#2c66b1!important;">表  示</button>                      
                        </div>
                      </div>
                  </div>
                </td>
                    <td>
                      <div style="width: 175px !important;">
                          <div class="input-group input-group-sm position-relative">
                            <input type="text" class="form-control productNumber" id="productNumber-{{ $loop->index }}" name="productNumber[]" value="{{ $product->datachar07 ? $product->datachar07 : null }}" placeholder="" readonly=""  style="width: 127px!important;padding: 0!important; background:white!important;">
                            <div class="input-group-append">
                              <button class="input-group-text btn productNumberModalOpener" style="background:#2c66b1!important;"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                      </div>
                    </td>
                    <td><input type="text" value="{{ $product->datachar08 ? $product->datachar08 : null }}" maxlength="40" class="form-control productName " id="productName-{{ $loop->index }}" name="productName[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" value="{{ $product->nyukosu ? numberFormat($product->nyukosu) : null }}" 
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="5" class="form-control productQuantity text-right" id="productQuantity-{{ $loop->index }}" name="productQuantity[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" value="{{ $product->kingaku ? numberFormat($product->kingaku) : null }}" 
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productUnitPrice text-right" id="productUnitPrice-{{ $loop->index }}" name="productUnitPrice[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" value="{{ $product->syouhizeiritu ? numberFormat($product->syouhizeiritu) : null }}" 
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productAmount text-right" id="productAmount-{{ $loop->index }}" name="productAmount[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" value="{{ $product->soukobango ? numberFormat($product->soukobango) : null }}" 
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productTax text-right" id="productTax-{{ $loop->index }}" name="productTax[]" placeholder=""  style="padding: 0!important;"></td>
                    
                    <td> <div class="custom-arrow">
                      <select class="form-control taxation" id="taxation-{{ $loop->index }}" name="taxation[]">
                          @foreach ($data309 as $categoryKanri) 
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" {{ ( ($categoryKanri->category1 . $categoryKanri->category2) == $product->datachar18) ? 'selected' : '' }}>
                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                      </select>
                    </div></td>
                    <td> <div class="custom-arrow">
                      <select class="form-control accountingSubject" id="accountingSubject-{{ $loop->index }}" name="accountingSubject[]">
                            <option value=""> - </option>
                            @foreach ($data310 as $categoryKanri) 
                              <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" {{ ( ($categoryKanri->category1 . $categoryKanri->category2) == $product->barcode) ? 'selected' : '' }}>
                              {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                              </option>
                            @endforeach
                      </select>
                    </div></td>
                    <td> <div class="custom-arrow ">
                      <select class="form-control accountingItems" id="accountingItems-{{ $loop->index }}" name="accountingItems[]">
                          <option value=""> - </option>
                          @foreach ($data311 as $categoryKanri) 
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" {{ ( ($categoryKanri->category1 . $categoryKanri->category2) == $product->codename) ? 'selected' : '' }}>
                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                      </select>
                    </div></td>
                    <td class="tableContractor" id="tableContractor-{{ $loop->index }}" >{{ $product->orderhenkan_datachar10 ? $product->orderhenkan_datachar10 : null }}</td>
                    <input type="hidden" name="table_contractor[]" class="table-contractor" id="table-contractor-{{ $loop->index }}" value="{{ $product->contractor ? $product->contractor : null }}">
                    <td><input type="text" class="form-control detailedRemarks" id="detailedRemarks-{{ $loop->index }}" name="detailedRemarks[]" value="{{ $product->datachar08 ? $product->datachar11 : null }}" placeholder="" maxlength="40"  style="padding: 0!important;"></td>
                    <td hidden><input type="hidden" class="form-control syouhinid" id="syouhinid-{{ $loop->index }}" name="syouhinid[]" value="{{ $product->syouhinid ? $product->syouhinid : null }}"  style="padding: 0!important;"></td>
                    <td hidden><input type="hidden" class="form-control syouhinsyu" id="syouhinsyu-{{ $loop->index }}" name="syouhinsyu[]" value="{{ $product->syouhinsyu ? $product->syouhinsyu : null }}"  style="padding: 0!important;"></td>
                  </tr>
                @endforeach 
              @else
              <tr id="LineBranch1" class="table-line line-form">
                  <input type="hidden" name="addedRowNumberOfBacklogTable[]" id="addedRowNumberOfBacklogTable" class="addedRowNumberOfBacklogTable">
                    <td>
                      <div class="data-box-content" style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                          <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                            <span id="lineValue" class="lineValue">1</span>
                            <input type="hidden" class="line-input" name="line[]" value="1">
                            </div>
                            <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                              <button type="button" class="lineBtn" id="lineBtn" style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                              <button type="button" class="deleteBtn" id="deleteBtn"  style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                  <div style="width: 175px !important;">
                      <div class="input-group position-relative">
                        <input type="text" class="form-control orderNumber" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="13" id="orderNumber" name="orderNumber[]" placeholder=""  style="width: 114px!important;padding: 0!important; background:white!important;">
                        <div class="input-group-append">
                          <button type="button" class="input-group-text btn orderNumberModalOpener" style="background:#2c66b1!important;">表  示</button>                      
                        </div>
                      </div>
                  </div>
                </td>
                    <td>
                      <div style="width: 175px !important;">
                          <div class="input-group input-group-sm position-relative">
                            <input type="text" class="form-control productNumber" id="productNumber" name="productNumber[]" placeholder="" readonly=""  style="width: 127px!important;padding: 0!important; background:white!important;">
                            <div class="input-group-append">
                              <button type="button" class="input-group-text btn productNumberModalOpener" style="background:#2c66b1!important;"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                      </div>
                    </td>
                    <td><input type="text" maxlength="40" class="form-control productName " id="productName" name="productName[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="5" class="form-control productQuantity text-right" id="productQuantity" name="productQuantity[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                     oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productUnitPrice text-right" id="productUnitPrice" name="productUnitPrice[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" 
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productAmount text-right" id="productAmount" name="productAmount[]" placeholder=""  style="padding: 0!important;"></td>
                    <td class="text-right"><input type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" 
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="9" class="form-control productTax text-right" id="productTax" name="productTax[]" placeholder=""  style="padding: 0!important;"></td>
                    
                    <td> <div class="custom-arrow">
                      <select class="form-control taxation" id="taxation" name="taxation[]">
                          @foreach ($data309 as $categoryKanri) 
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" {{ ( ($categoryKanri->category1 . $categoryKanri->category2) == 'E120') ? 'selected' : '' }}>
                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                      </select>
                    </div></td>
                    <td> <div class="custom-arrow">
                      <select class="form-control accountingSubject" id="accountingSubject" name="accountingSubject[]">
                            <option value=""> - </option>
                            @foreach ($data310 as $categoryKanri) 
                              <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                              {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                              </option>
                            @endforeach
                      </select>
                    </div></td>
                    <td> <div class="custom-arrow ">
                      <select class="form-control accountingItems" id="accountingItems" name="accountingItems[]">
                          <option value=""> - </option>
                          @foreach ($data311 as $categoryKanri) 
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                      </select>
                    </div></td>
                    <td class="tableContractor" id="tableContractor" ></td>
                    <input type="hidden" name="table_contractor[]" class="table-contractor" id="table-contractor">
                    <td><input type="text" class="form-control detailedRemarks" id="detailedRemarks" name="detailedRemarks[]" placeholder="" maxlength="40"  style="padding: 0!important;"></td>
                    <td hidden><input type="hidden" class="form-control syouhinid" id="syouhinid" name="syouhinid[]" style="padding: 0!important;"></td>
                    <td hidden><input type="hidden" class="form-control syouhinsyu" id="syouhinsyu" name="syouhinsyu[]"  style="padding: 0!important;"></td>
                  </tr>
              @endif
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
   <div class="ml-3 mr-3 d-flex  w-100 justify-content-end" style="background-color: #fff;">
     <div  class="mt-2">
       <table class="table custom-form" style="border: none!important;width:auto;">
       <tbody>
         <tr style="height: 28px;">
           <td style="width: 23px!important;padding: 0!important;border:0!important;">
             <div class="line-icon-box"></div>
           </td>
           <td style=" border: none!important;width: 40px!important;color: #000;font-weight: bold;font-size: 0.9em;">合計</td>
           <input type="hidden" id="totalSalesDb" name="totalSales">
           <td id="totalSales" style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">¥</td>
           
           <td style=" border: none!important;width: 15px!important;"></td>
           
         </tr>
       </tbody>
       </table>
     </div>
     <div  class="mt-2">
       <table class="table custom-form" style="border: none!important;width:auto;">
       <tbody>
         <tr style="height: 28px;">
           <td style="width: 23px!important;padding: 0!important;border:0!important;">
             <div class="line-icon-box"></div>
           </td>
           <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">消費税</td>
           <td id="salesTax" style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">¥</td>
           <input type="hidden" id="salesTaxDb" name="salesTax">
           <td style=" border: none!important;width: 15px!important;"></td>
         </tr>
       </tbody>
       </table>
     </div>
     <div  class="mt-2">
       <table class="table custom-form" style="border: none!important;width:auto;">
       <tbody>
         <tr style="height: 28px;">
           <td style="width: 23px!important;padding: 0!important;border:0!important;">
             <div class="line-icon-box"></div>
           </td>
           <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">税込合計</td>
           <td id="totalTax" style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">¥</td>
           <input type="hidden" id="totalTaxDb" name="totalTax">
           <td style=" border: none!important;width: 5px!important;"></td>
         </tr>
       </tbody>
       </table>
     </div>
   </div>

   </div>

   <div class="content-head-bottom">
   <div class="row mt-2">
           <div class="col-8">
             <table class="table custom-form" style="border: none!important;width: 100%;margin-bottom: 4px!important;">
               <tbody>
                 <tr>
                   <td style="width: 23px!important;padding: 0!important;border:0!important;">
                     <div class="line-icon-box"></div>
                   </td>
                   <td style=" border: none!important;width: 54px!important;">伝票備考</td>
                   <td style=" border: none!important;">
                   <input type="text" id="comments" class="form-control comments" name="comments" maxlength="40" placeholder="伝票備考（全角４０文字まで）">
                   </td>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>

         <div class="row">
         <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
           <div class="form-button"> 
             <button  href="#" class="btn btn-info uskc-button registrationButton" id="registrationButton" style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
           </div>
         </div>
       </div>
       </div>
 </div>
</div> 
</div>
<script type="text/javascript">
    function numberCommaFormat(num) {
        if (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }
        return null;
    }

    function callforComma(self) {
        var test = numberCommaFormat(self.value);
        self.value = test;
    }

    function callToRemoveComma(self) {
        var test = self.value.replace(/,+/g, '')
        self.value = test;
    }
</script>