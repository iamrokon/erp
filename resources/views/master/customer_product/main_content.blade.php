<div class="fullpage_width1">
  <div class="content-head-section">

    @php
    $old = array();
    if(session()->has('oldInput'.$bango)){
    $old = session()->get('oldInput'.$bango);
    }
    $current_page=$kokyakus->currentPage();
    $per_page=$kokyakus->perPage();
    $first_data= ($current_page - 1)*$per_page+1;
    $last_data=($current_page - 1)*$per_page+ sizeof($kokyakus->items());
    $total=$kokyakus->total();
    $lastPage=$kokyakus->lastPage() ;
    @endphp

    <div class="container" data-bind="nextFieldOnEnter:true">

      <form id="mainForm" action="{{ route('customerProductManagement') }}" method="post">
        @csrf
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input id='innerlevel' value='{{$tantousya->innerlevel}}' type='hidden'/>
          <div class="row" style="margin-top: -29px;">
          <div class="col-lg-12">
            <div style="">
              <div class="wrap-100"
                style="background-color: #fff;box-sizing: border-box; overflow: hidden;">

                <!-- show success message -->
                @if(Session::has('success_msg'))
                <div class="row">
                  <div class="col-12">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;
                      </button>
                      <strong>{{session()->get('success_msg')}}</strong>
                    </div>
                  </div>
                </div>
                @endif
                <!-- end success message -->

                <!-- show warning message -->
                @if(isset($exceedKokyakus))
                  <p style="color: red;margin-top:11px;bottom:0px;">{{$exceedKokyakus}}</p>
                @endif
                <!-- end warning message -->

                {{-- Common Button Starts Here --}}
                @include('layout.commonButton')
                {{-- Common Button Ends Here --}}


                {{-- Pagination Starts Here --}}
                @include('master.customer_product.pagination')
                {{-- Pagination Ends Here --}}

                <!-- Large table row starts here -->
                <div class="row">
                  <div class="col-lg-12">
                    <div style="overflow: hidden;">
                      <div id="userTable" class="largeTable" class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-fill table-bordered">
                        {{-- <table class="table table-fill table-bordered" style="margin-bottom:40px!important; "> --}}
                          <thead class="thead-dark header text-center" id="myHeader">
                            <tr>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                              @if($field == 'company_name')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('company_search_sort');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'product_name')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('product_search_sort');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_kakaku')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('kakaku');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_hanbaisu')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('hanbaisu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_jyougensu')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('jyougensu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_yoyaku')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('yoyaku');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_yoyakusu')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('yoyakusu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_yoyakukanousu')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('yoyakukanousu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_sortbango')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('sortbango');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_dataint01')
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('dataint01');">
                                  {{$header}}
                                </span>
                              </th>
                              @else
                              <th class="signbtn" scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;" onclick="AscDsc('{{$field}}');">
                                  {{$header}}
                                </span>
                              </th>
                              @endif
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              @foreach($headers as $header=>$field)
                                @if($field=='formatted_kakaku')
                                <td>
                                  <input type="text" name="{{'kakaku'}}" class="form-control" value="{{isset($old['kakaku'])?$old['kakaku']:null}}">
                                </td>
                                @elseif($field=='formatted_hanbaisu')
                                <td>
                                  <input type="text" name="{{'hanbaisu'}}" class="form-control" value="{{isset($old['hanbaisu'])?$old['hanbaisu']:null}}">
                                </td>
                                @elseif($field=='formatted_jyougensu')
                                <td>
                                  <input type="text" name="{{'jyougensu'}}" class="form-control" value="{{isset($old['jyougensu'])?$old['jyougensu']:null}}">
                                </td>
                                @elseif($field=='formatted_yoyaku')
                                <td>
                                  <input type="text" name="{{'yoyaku'}}" class="form-control" value="{{isset($old['yoyaku'])?$old['yoyaku']:null}}">
                                </td>
                                @elseif($field=='formatted_yoyakusu')
                                <td>
                                  <input type="text" name="{{'yoyakusu'}}" class="form-control" value="{{isset($old['yoyakusu'])?$old['yoyakusu']:null}}">
                                </td>
                                @elseif($field=='formatted_yoyakukanousu')
                                <td>
                                  <input type="text" name="{{'yoyakukanousu'}}" class="form-control" value="{{isset($old['yoyakukanousu'])?$old['yoyakukanousu']:null}}">
                                </td>
                                @elseif($field=='formatted_sortbango')
                                <td>
                                  <input type="text" name="{{'sortbango'}}" class="form-control" value="{{isset($old['sortbango'])?$old['sortbango']:null}}">
                                </td>
                                @elseif($field=='formatted_dataint01')
                                <td>
                                  <input type="text" name="{{'dataint01'}}" class="form-control" value="{{isset($old['dataint01'])?$old['dataint01']:null}}">
                                </td>
                                @else
                                <td>
                                  <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                                </td>
                                @endif
                              @endforeach
                            </tr>
                            <!-- start dynamic row -->
                            @foreach($kokyakus as $key => $val)
                            <tr>
                              <td style="width:50px;">
                                <a href="#" class="btn btn-info btn-m-view open_view" style="width: 100%;"
                                  data-url="{{route("customerProductManagementDetail",$bango)}}" data-id="{{ $val->uuid}}">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                </a>
                              </td>
                              @php
                              $text_align_field =
                              ['formatted_kakaku','formatted_hanbaisu','formatted_jyougensu','formatted_yoyaku','formatted_yoyakusu','formatted_yoyakukanousu','formatted_sortbango','formatted_dataint01'];
                              @endphp
                              @foreach($headers as $header=>$field)
                              @if(in_array($field,$text_align_field))
                              <td class="text-right">{{$val->$field}}</td>
                              @else
                              <td> {{$val->$field}} </td>
                              @endif
                              @endforeach
                            </tr>
                            @endforeach
                            <!--end dynamic row -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row div end -->
      </form>
    </div>
  </div>
</div>
