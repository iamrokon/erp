
<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">

    @php
      $old = array();
      if(session()->has('oldInput'.$bango)){
        $old = session()->get('oldInput'.$bango);
      }
      $current_page=$productInfo->currentPage();
      $per_page=$productInfo->perPage();
      $first_data= ($current_page - 1)*$per_page+1;
      $last_data=($current_page - 1)*$per_page+ sizeof($productInfo->items());
      $total = $productInfo->total();
      $lastPage = $productInfo->lastPage() ;
    @endphp

    <div class="container">

      <form id="mainForm" action="{{ route('productMaster') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input id='submit_confirmation' value='' type='hidden'/>
        <input id='modal_type' value='' type='hidden'/>
        <input id='innerlevel' value='{{$tantousya->innerlevel}}' type='hidden'/>
        @csrf
        
        <div class="row" style="margin-top: -22px;">
          <div class="col-lg-12">
              <div class="wrap-100" style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">

                <!-- show success message -->
                @if(Session::has('success_msg'))
                <div class="row">
                  <div class="col-12">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>{{session()->get('success_msg')}}</strong>
                    </div>
                  </div>
                </div>
                @endif
                
                <!-- show failure message -->
                @if(Session::has('failure_msg'))
                <div class="row">
                  <div class="col-12">
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>{{session()->get('failure_msg')}}</strong>
                    </div>
                  </div>
                </div>
                @endif
                
                @if(isset($exceedUser))
                <p style="color: red;">{{$exceedUser}}</p>
                @endif


                {{-- Common Button Starts Here --}}
                @include('layout.commonButton')
                {{-- Common Button Ends Here --}}
                
                {{-- Pagination Starts Here --}}
                @include('master.productMaster.pagination')
                {{-- Pagination Ends Here --}}

                <!-- Large table row starts here -->
                <div class="row ">
                  <div class="col-lg-12">
                    <div style="overflow: hidden;">
                      <div id="userTable" class="table_hover fixed_table_height largeTable" style="overflow-x: auto;margin-bottom: 30px!important">
                        <table class="table table-fill table-striped table-bordered" style="width: auto; padding-bottom: 30px!important;">
                          <thead class="thead-dark header text-center" id="myHeader">
                            <tr>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                              @if($field == 'formatted_kakaku')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('kakaku');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_hanbaisu')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('hanbaisu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_jyougensu')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('jyougensu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_kakaku_yoyaku')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('kakaku_yoyaku');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_yoyakusu')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('yoyakusu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_yoyakukanousu')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('yoyakukanousu');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_sortbango')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('sortbango');">
                                  {{$header}}
                                </span>
                              </th>
                              @elseif($field == 'formatted_dataint01')
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('dataint01');">
                                  {{$header}}
                                </span>
                              </th>
                              @else
                              <th scope="col">
                                <span class="th_design" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('{{$field}}');">
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
                                @elseif($field=='formatted_kakaku_yoyaku')
                                    <td>
                                      <input type="text" name="{{'kakaku_yoyaku'}}" class="form-control" value="{{isset($old['kakaku_yoyaku'])?$old['kakaku_yoyaku']:null}}">
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

                            @foreach($productInfo as $key=>$val)
                            <tr>
                              <td style="width:50px;">
                                <a href="{{$val->bango}}" id="empButton1" class="btn btn-info btn-m-view" style="width: 100%;"
                                  data-toggle="modal" data-target="#"
                                  onclick="viewProductDetail('{{route("productMasterDetail",[$bango])}}','{{$val->bango}}','{{$bango}}');">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                </a>
                              </td>
                              @php
                              $text_align_field = ['formatted_kakaku','formatted_hanbaisu','formatted_jyougensu','formatted_kakaku_yoyaku','formatted_yoyakusu','formatted_yoyakukanousu','formatted_sortbango','formatted_dataint01'];
                              @endphp
                              @foreach($headers as $header=>$field)
                                @if(in_array($field,$text_align_field))
                                    <td class="text-right">{{$val->$field}}</td>
                                @elseif(gettype($val->$field) == 'integer')
                                    <td style="text-align: right;">{{$val->$field}}</td>
                                @elseif($field == "data20")
                                    <td style="text-align: right;">{{$val->$field}}</td>
                                @else
                                    <td>{{$val->$field}}</td>
                                @endif
                              @endforeach
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- wrap-100 div end -->
            </div>
            <!-- product content col-12 ends here -->
        </div>
      </form>
    </div>
    <!-- product content row ends here -->
  </div>
</div>