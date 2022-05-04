@php
    $current_page=$data->currentPage();
    $per_page=$data->perPage();
    $first_data= ($current_page - 1)*$per_page+1;
    $last_data=($current_page - 1)*$per_page+ sizeof($data->items());
    $total=$data->total();
    $lastPage=$data->lastPage();
@endphp


<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('backOrder') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        @if(isset($orderId))
            @if(count($orderId)>0)
                @foreach($orderId as $k=>$v)
                    <input type="hidden" value="{{$v}}" name="orderId[{{$k}}]">
                @endforeach
            @endif
        @endif
        @if(isset($orderBango))
            @if(count($orderBango)>0)
                @foreach($orderBango as $k=>$v)
                    <input type="hidden" value="{{$v}}" name="orderBango[{{$k}}]">
                @endforeach
            @endif
        @endif
        @csrf

        <!-- first search req data //fsReqData=first search request data -->
            @if(isset($fsReqData))

                <input type="hidden" id="division_datachar05_startReqVal" name="division_datachar05_start" @if(isset($fsReqData['division_datachar05_start'])) value="{{$fsReqData['division_datachar05_start']}}" @else value="" @endif>
                <input type="hidden" id="department_datachar05_startReqVal" name="department_datachar05_start" @if(isset($fsReqData['department_datachar05_start'])) value="{{$fsReqData['department_datachar05_start']}}" @else value="" @endif >
                <input type="hidden" id="group_datachar05_startReqVal" name="group_datachar05_start" @if(isset($fsReqData['group_datachar05_start'])) value="{{$fsReqData['group_datachar05_start']}}" @else value="" @endif>
                <input type="hidden" id="division_datachar05_endReqVal" name="division_datachar05_end" @if(isset($fsReqData['division_datachar05_end'])) value="{{$fsReqData['division_datachar05_end']}}" @else value="" @endif>
                <input type="hidden" id="department_datachar05_endReqVal" name="department_datachar05_end" @if(isset($fsReqData['department_datachar05_end'])) value="{{$fsReqData['department_datachar05_end']}}" @else value="" @endif>
                <input type="hidden" id="group_datachar05_endReqVal" name="group_datachar05_end" @if(isset($fsReqData['group_datachar05_end'])) value="{{$fsReqData['group_datachar05_end']}}" @else value="" @endif>
                <input type="hidden" id="datachar05ReqVal" name="datachar05" @if(isset($fsReqData['datachar05'])) value="{{$fsReqData['datachar05']}}"  @else value="" @endif>
                <input type="hidden" id="salesDate_startReqVal" name="salesDate_start" @if(isset($fsReqData['salesDate_start'])) value="{{$fsReqData['salesDate_start']}}" @else value="" @endif>
                <input type="hidden" id="salesDate_endReqVal" name="salesDate_end" @if(isset($fsReqData['salesDate_end'])) value="{{$fsReqData['salesDate_end']}}" @else value="" @endif>
                <input type="hidden" id="backOrderSupplierReqVal" name="backOrderSupplier" @if(isset($fsReqData['backOrderSupplier'])) value="{{$fsReqData['backOrderSupplier']}}" @else value="" @endif>
                <input type="hidden" id="backOrderSupplier_dbReqVal" name="backOrderSupplier_db" @if(isset($fsReqData['backOrderSupplier_db'])) value="{{$fsReqData['backOrderSupplier_db']}}" @else value="" @endif>
                <input type="hidden" id="rd1ReqVal" name="rd1" @if(isset($fsReqData['rd1'])) value="{{$fsReqData['rd1']}}" @else value="" @endif>
            <input type="hidden" id="rd2ReqVal" name="rd2" @if(isset($fsReqData['rd2'])) value="{{$fsReqData['rd2']}}" @else value="" @endif>
            @endif
        <div class="content-bottom-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            月別受注残一覧
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-pagination">
                <div class="container">
                    <div class="row">
                        <div class="col">
                        <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                                {{-- Pagination Starts Here --}}
                                @include('order.backOrder.pagination')
                                {{-- Pagination Ends Here --}}
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-6">

                                    </div>

                                    <div class="col-6">
                                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                          <tbody>
                                            <tr style="height: 28px;">
                                              <td style=" border: none!important;">
                                                <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                                  class="btn bg-teal text-white uskc-button" data-dismiss="modal"> 検　索
                                                </button>
                                              </td>
                                              <td style=" border: none!important;">
                                                <button type="button" onclick="refresh()" message="データを一覧表示します。"
                                                  class="btn text-white bg-default uskc-button" data-dismiss="modal">
                                                  <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                                                </button>
                                              </td>
                                              <td style=" border: none!important;">
                                                <button type="button" id="excelDwld" onclick="excelDownload()" class="btn uskc-button text-white"
                                                  data-dismiss="modal" style="background: #009640;" @if(count($data)<1) disabled @endif>
                                                  <!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> Excel エクスポート
                                                </button>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <br>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-bottom-bottom">
            <div class="container">
                <div class="row mt-3" style="">
                    <div class="col-lg-12">
                        <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                            <div style="overflow: hidden;">
                                <div class="table-responsive largeTable">
                                    <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                                        <thead class="thead-dark header text-center" id="myHeader">

                                        @foreach($headers as $header=>$field)
                                           @if($field=='id')
                                           <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                           @else
                                            <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                            </th>
                                            @endif
                                        @endforeach
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($headers as $header=>$field)
                                                @if($field=='money10')
                                                <td>
                                                    <input type="text" name="before_modified_money10" class="form-control" value="{{isset($old['before_modified_money10'])?$old['before_modified_money10']:null}}" >
                                                </td>
                                                @elseif($field=='moneymax')
                                                    <td>
                                                        <input type="text" name="before_modified_moneymax" class="form-control" value="{{isset($old['before_modified_moneymax'])?$old['before_modified_moneymax']:null}}" >
                                                    </td>
                                                @elseif($field=='s1')
                                                    <td>
                                                        <input type="text" name="before_modified_s1" class="form-control" value="{{isset($old['before_modified_s1'])?$old['before_modified_s1']:null}}" >
                                                    </td>
                                                @elseif($field=='s2')
                                                    <td>
                                                        <input type="text" name="before_modified_s2" class="form-control" value="{{isset($old['before_modified_s2'])?$old['before_modified_s2']:null}}" >
                                                    </td>
                                                @elseif($field=='s3')
                                                    <td>
                                                        <input type="text" name="before_modified_s3" class="form-control" value="{{isset($old['before_modified_s3'])?$old['before_modified_s3']:null}}" >
                                                    </td>
                                                @else
                                                <td>
                                                    <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}"  @if($field=='id') disabled="disabled" @endif>
                                                </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        <!--      2nd row -->
                                        @php
                                        $i=$first_data;
                                        @endphp
                                        @if(isset($data))
                                            @foreach($data as $key=>$val)
                                                <tr id="dp{{$i}}">
                                                    @foreach($headers as $header=>$field)

                                                        @if($field == 'intorder03' || $field == 'intorder04' || $field == 'intorder05' || $field == 'date')
                                                            <td>
                                                                <input type="text" onchange="click_check($(this))" name="valcha[{{$field.'_'.$val->order_id.'%'.$val->primary_bango}}]"
                                                                       class="form-control input_field @if($val->orderhenkan_datachar02!='U123'){{'datePicker'}}@endif" autocomplete="off" value="{{isset($variables[$field.'_'.$val->order_id.'%'.$val->primary_bango])?$variables[$field.'_'.$val->order_id.'%'.$val->primary_bango]: $val->$field}}"
                                                                       id="@if($field == 'intorder04'){{'intorder04_'.$val->primary_bango }}@elseif($field == 'intorder03'){{'intorder03_'.$val->primary_bango}}@else{{'intorder05_'.$val->primary_bango}}@endif"
                                                                       placeholder="年/月/日" @if($val->orderhenkan_datachar02=='U123'){{'readonly'}}@endif
                                                                       oninput="checkForNull(this,'{{$i}}','{{$field}}'),this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                       maxlength="10" style="height: 23px !important; width: 80px;"
                                                                       onkeyup="checkForNull(this,'{{$i}}','{{$field}}') " >
{{--                                                                       <input style="display:none" type="checkbox" name="check[{{$field.'_'.$val->primary_bango/*.'_'.$val->order_id*/}}]" id="{{$field.'_'.$val->primary_bango.'_c'}}" @if(isset($check[$field.'_'.$val->primary_bango])) checked @endif>--}}
                                                                       <input style="display:none" type="checkbox" name="check[{{$field.'_'.$val->primary_bango.'_'.$val->order_id}}]" id="{{$field.'_'.$val->primary_bango.'_c'}}" @if(isset($check[$field.'_'.$val->primary_bango.'_'.$val->order_id])) checked @endif>
                                                                       <script type="text/javascript">
                                                                           //var id='{{$field.'_'.$val->primary_bango}}'

                                                                           function click_check(own){
                                                                             var id=own.attr('id');
                                                                             $("#"+id+'_c').attr('checked', 'checked');
                                                                             console.log($("#"+id+'_c'))
                                                                           }
                                                                       </script>
                                                                <input type="hidden" name="valdate[{{$field.'_'.$val->order_id.'%'.$val->primary_bango}}]" value="{{$val->date}}">
                                                                <input type="hidden" id="@if($field == 'intorder04'){{'intOr04_h'.$i }}@elseif($field == 'intorder03'){{'intOr03_h'.$i}}@else{{'intOr05_h'.$i}}@endif" class="datePickerHidden" >
                                                                <input type="hidden" class="dPickerHidden" autocomplete="off" value="{{$val->$field}}">
                                                                <input type="hidden" class="headerName" value="{{$field}}">
                                                                <input type="hidden" class="rowNo" value="{{$i}}">
                                                            </td>

                                                            {{--@elseif($field == 'juchukubun1')
                                                                <td>{{Illuminate\Support\Str::limit($val->$field, 22)}}</td>--}}
                                                        @elseif($field == 'money10' || $field == 'moneymax' || $field == 's1' || $field == 's3' || $field == 's2')
                                                            <td style="text-align: right">{{$val->$field}}</td>
                                                        {{--@elseif($field == 'information1_detail_show' || $field == 'information2_detail_show' || $field == 'information3_detail_show')
                                                            <td>{{mb_convert_kana($val->$field, "rk")}}</td>--}}
                                                        @elseif($field=='id')    <td>{{$i++}}</td>
                                                        @elseif($field=='intorder01') <td><input type="text" name="valcha[{{$field.'_'.$val->order_id.'%'.$val->primary_bango}}]" class="form-control input_field" style="height: 23px !important; width: 80px;" id="intOr01{{$i++}}" value="{{$val->$field}}" readonly></td>
                                                        @else
                                                            <td>{{$val->$field}}</td>
                                                        @endif

                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                        <!--      3rd row -->

                                        <!--      4th row -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-button d-inline-block float-right">
                            <a class="btn btn-info uskc-button" id="updateButton">登  録</a>
                            <input type="hidden" id="validateORupdate" name="validateORupdate" @if(isset($arr_err) && $arr_err=='update') value="update" @else value="" @endif>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{--@php
    dd($filed_id)
@endphp--}}
@if(isset($filed_id) && !empty($filed_id))
  @foreach($filed_id as $id_val)
  <script type="text/javascript">

    $('#{{$id_val}}').addClass("error");
    console.log('{{$id_val}}')
  </script>
  @endforeach
@endif

