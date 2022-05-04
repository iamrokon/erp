<div class="content-bottom-section" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            調整先
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-bottom-bottom">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 10px 10px 10px;">
            <div class="table-responsive largeTable">
              <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    <th scope="col" class="signbtn"> <span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品CD</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品名</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">数量</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">発注金額分類</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">担当</span>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
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
                  <tr id="LineBranch{{$i}}" class="line-form">
                    <td>
                      <div class="data-box-content"
                        style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                          <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                            <span id="lineValue-{{$i}}" class="lineValue">{{$i}}</span>
                            <input type="hidden" class="line-input" name="line[]" value="{{$i}}">
                            </div>
                            <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                              <button class="btn lineBtn" id="lineBtn-{{$i}}"
                                style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i
                                  class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                              <button class="btn deleteBtn" id="deleteBtn-{{$i}}" data-toggle="modal"
                                data-target="#confirm_line_delation_Modal_deposit"
                                style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                                  class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group position-relative">
                          <input type="text" class="form-control productNumber" id="productNumber-{{ $loop->index }}" name="productNumber[]" value="" placeholder="01360"
                            style="width: 114px!important;padding: 0!important; background:white!important;">
                            <div class="input-group-append" id="modalarea">
                            <button class="input-group-text btn productNumberModalOpener"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control productName" id="productName-{{ $loop->index }}" name="productName[]" placeholder="" readonly=""
                            style="width: 127px!important;padding: 0!important; background:white!important;">
                        </div>
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control text-right productQuantity" maxlength="2" id="productQuantity-{{ $loop->index }}" name="productQuantity[]" placeholder="" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"style="padding: 0!important;">
                    </td>
                    <td>
                      <input type="text" class="form-control text-right productUnitPrice" maxlength="8" id="productUnitPrice-{{ $loop->index }}" name="productUnitPrice[]" placeholder="" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" style="padding: 0!important;">
                   </td>
                    <td><input type="text" class="form-control text-right productAmount" id="productAmount-{{ $loop->index }}" name="productAmount[]" placeholder="" readonly=""
                        style="padding: 0!important;"></td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control orderAmountClassification" id="orderAmountClassification-{{ $loop->index }}" name="orderAmountClassification[]">
                        <option value="">-</option>  
                        @foreach ($categorykanriesU1 as $categoryKanri)
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control responsiblePerson" id="responsiblePerson-{{ $loop->index }}" name="responsiblePersonCD[]">
                        <option value="">-</option>
                        @foreach ($name as $tanto)
                            <option value="{{ $tanto->bango}}" >
                                {{ $tanto->bango." ".$tanto->name }}
                            </option>
                          @endforeach
                        </select>
                        <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD">
                        {{--@if($isSelected)
                          <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD"  value="{{$isSelected}}">
                        @else
                          <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD">
                        @endif --}}
                      </div>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td>
                      <div class="data-box-content"
                        style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                          <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                              <span>2</span>
                            </div>
                            <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                              <button class="btn"
                                style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i
                                  class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                              <button class="btn" data-toggle="modal"
                                data-target="#confirm_line_delation_Modal_deposit"
                                style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                                  class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group position-relative">
                          <input type="text" class="form-control" placeholder="01360"
                            style="width: 114px!important;padding: 0!important; background:white!important;">
                            <div class="input-group-append" id="modalarea" data-toggle="modal"
                            data-target="#exampleModal2">
                            <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control" placeholder="amazingEDI設計料" readonly=""
                            style="width: 127px!important;padding: 0!important; background:white!important;">
                        </div>
                      </div>
                    </td>
                    <td><input type="text" class="form-control text-right" placeholder="999,999,999" style="padding: 0!important;"></td>
                    <td><input type="text" class="form-control text-right" placeholder="999,999,999"
                        style="padding: 0!important;"></td>
                    <td><input type="text" class="form-control text-right" placeholder="999,999,999"
                        style="padding: 0!important;"></td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control">
                          <option value="">30　研究所</option>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control">
                          <option value="">小川</option>
                        </select>
                      </div>
                    </td>
                  </tr> -->
                  @endforeach 
                  @else
                    <tr id="LineBranch1" class="line-form">
                    <td>
                      <div class="data-box-content"
                        style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                          <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                            <span id="lineValue" class="lineValue">1</span>
                            <input type="hidden" class="line-input" name="line[]" value="1">
                            </div>
                            <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                              <button class="btn lineBtn" id="lineBtn"
                                style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i
                                  class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                              <button class="btn deleteBtn" id="deleteBtn" data-toggle="modal"
                                data-target="#confirm_line_delation_Modal_deposit"
                                style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                                  class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group position-relative">
                          <input type="text" class="form-control productNumber" id="productNumber" name="productNumber[]" value="" placeholder="01360"
                            style="width: 114px!important;padding: 0!important; background:white!important;">
                            <div class="input-group-append" id="modalarea">
                            <button class="input-group-text btn productNumberModalOpener"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="width: 175px !important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control productName" id="productName" name="productName[]" placeholder="" 
                            style="width: 127px!important;padding: 0!important; background:white!important;">
                        </div>
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control text-right productQuantity" maxlength="2" id="productQuantity" name="productQuantity[]" placeholder="" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"style="padding: 0!important;">
                    </td>
                    <td><input type="text" class="form-control text-right productUnitPrice" maxlength="8" id="productUnitPrice" name="productUnitPrice[]" placeholder=""
                      onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                      oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"style="padding: 0!important;"></td>
                    <td><input type="text" class="form-control text-right productAmount" id="productAmount" name="productAmount[]" placeholder="" readonly=""
                        style="padding: 0!important;"></td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control orderAmountClassification" id="orderAmountClassification" name="orderAmountClassification[]">
                        <option value="">-</option>
                          @foreach ($categorykanriesU1 as $categoryKanri)
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="custom-arrow">
                        <select class="form-control responsiblePerson" id="responsiblePerson" name="responsiblePersonCD[]">
                          <option value="">-</option>
                          @foreach ($name as $tanto)
                            <option value="{{ $tanto->bango}}" >
                                {{ $tanto->bango." ".$tanto->name }}
                            </option>
                          @endforeach
                        </select>
                        <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD">
                        {{--@if($isSelected)
                          <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD"  value="{{$isSelected}}">
                        @else
                          <input type="hidden" name="responsiblePerson[]" id="" class="form-control responsiblePersonCD">
                        @endif --}}
                      </div>
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="content-head-bottom">
        <div class="row mt-2">
          <div class="col-8">
            <table class="table custom-form"
              style="border: none!important;width: 100%;margin-bottom: 4px!important;">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style=" border: none!important;width: 54px!important;">社内備考</td>
                  <td style=" border: none!important;">
                    <input type="text" name="houseRemarks"  id="houseRemarks"class="form-control houseRemarks" maxlength="40" placeholder="社内備考（全角４０文字まで）">
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table custom-form"
            style="border: none!important;width: 100%;margin-bottom: 4px!important;">
            <tbody>
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-icon-box"></div>
                </td>
                <td style=" border: none!important;width: 54px!important;">伝票備考</td>
                <td style=" border: none!important;">
                  <input type="text" name="voucherRemarks"  id="voucherRemarks"class="form-control voucherRemarks" maxlength="40" placeholder="伝票備考（全角４０文字まで）">
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>

        <div class="row">
          <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
            <div class="form-button">
              <button href="#" class="btn btn-info uskc-button registrationButton" id="registrationButton"
                style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
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