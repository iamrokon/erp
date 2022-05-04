<form id="mainForm2" method="post"> 
<div class="row mb-3">
    <div class="col-lg-12">
      <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 10px 0 10px;">
        <div style="overflow: hidden;">
          <div class="table-responsive largeTable">
            <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
              style="margin-bottom: 20px!important;">
              <thead class="thead-dark header text-center" id="myHeader">
                <tr>
                  <th class="signbtn" scope="col"><span class="table_header_span">品名</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">数量</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">単価</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">金額</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">課税</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">会計科目</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">会計科目内訳</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">対象</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">発注行番号</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">受注先</span></th>
                  <th class="signbtn" scope="col"><span class="table_header_span">受注番号</span></th>
                  <th class="signbtn" scope="col" style="display:none;"><span class="table_header_span">仕入行番号</span></th>
                  <th class="signbtn" scope="col" style="display:none;"><span class="table_header_span">発注番号</span></th>
                  <th class="signbtn" scope="col" style="display:none;"><span class="table_header_span">発注行番号2</span></th>
                </tr>
              </thead>
              <tbody>
                {{-- <tr>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                </tr> --}}
                @if(isset($purchaseData))
					@php
					$i = 1;
                                        $index = 0;
					@endphp
                @foreach($purchaseData as $key=>$val)
                <tr>
                  <td>{{$val->datachar08}}</td>
                  <td class="text-right">{{$val->nyukosu}}</td>
                  <td class="text-right">{{$val->formatted_kingaku}}</td>
                  <td class="text-right">{{$val->formatted_syouhizeiritu}}</td>
                  <td>{{$val->datachar18_detail}}</td>
                  <td>   
                     <div class="custom-arrow">
                      <select class="form-control" onchange="getPurchaseCategoryData($(this))" name="barcode[]" id="" style="width: auto;">
					   <option value="">-</option>
					    @foreach($barcode as $barcd)
                        <option value="{{$barcd->category1.$barcd->category2}}" @if($barcd->category1.$barcd->category2 == $val->barcode){{'selected'}}@endif>{{$barcd->category2." ".$barcd->category4}}</option>
						@endforeach                        
                      </select>
                    </div>
                </td>
                  <td> 
                    <div class="custom-arrow">
                     <select class="form-control" name="codename[]" id="" style="width: auto;">                       
                        <option value="">-</option>
						@foreach($codename as $cdname)
                        <option value="{{$cdname->category1.$cdname->category2}}" @if($cdname->category1.$cdname->category2 == $val->codename){{'selected'}}@endif>{{$cdname->category2." ".$cdname->category4}}</option>
						@endforeach   
                      </select>
                  </div> 
                </td>
                  <td>
                     <div class="radio-rounded">
                      <div class="custom-control custom-radio custom-control-inline" style="padding-left: 49px!important;padding-top: 3px!important;">
                        <input type="radio" class="custom-control-input custom-radio-btn" id="customRadiotd1_{{$i}}" name="td-rd1[]" value="{{$index}}" onclick="displayCurrentNumber({{$i}})">
                        <label class="custom-control-label" for="customRadiotd1_{{$i}}" style="font-size: 12px!important;cursor:pointer;"></label>
                      </div>
                    </div>
                </td>
                    @php
                    if($val->yoteimeter != null){
                        $yoteimeter = str_pad($val->yoteimeter, 3, '0', STR_PAD_LEFT);
                    }else{
                        $yoteimeter = "";
                    }
                    @endphp
                  <td><input type="text" name="order_ln_number[]" value="{{$val->idoutanabango.$yoteimeter}}" id="customRadiotd1_{{$i}}_val" class="form-control order-number" placeholder=""></td>
                  <td>{{$val->datachar10_detail}}</td>
                  <td>
                      <input type="hidden" name="order_number[]" value="{{$val->orderuserbango}}" />
                      {{$val->orderuserbango}}
                  </td>
                  <td style="text-align:right;display:none;">{{$val->syouhinsyu}}</td>
                  <td style="display:none;"><input type="hidden" name="idoutanabango[]" value="{{$val->idoutanabango}}" id="customRadiotd1_{{$i}}_order_number" class="customRadiotd1_order_number"><span id="customRadiotd1_{{$i}}_order_number_dis" class="customRadiotd1__order_number_dis">{{$val->idoutanabango}}</span></td>
                  <td style="text-align:right;display:none;"><input type="hidden" name="yoteimeter[]" value="{{$val->yoteimeter}}" id="customRadiotd1_{{$i}}_order_ln_number" class="customRadiotd1_order_ln_number"><span id="customRadiotd1_{{$i}}_order_ln_number_dis" class="customRadiotd1_order_ln_number_dis">{{str_pad($val->yoteimeter, 3, '0', STR_PAD_LEFT)}}</span></td>
                </tr>
					@php
					$i++;
                                        $index++;
					@endphp
				@endforeach
               @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>