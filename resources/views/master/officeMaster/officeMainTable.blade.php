<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">

    @php
      $old = array();
        if(session()->has('oldInputOfficeMaster'.$bango)){
      $old = session()->get('oldInputOfficeMaster'.$bango);
      }
      $current_page=$haisous->currentPage();
      $per_page=$haisous->perPage();
      $first_data= ($current_page - 1)*$per_page+1;
      $last_data=($current_page - 1)*$per_page+ sizeof($haisous->items());
      $total=$haisous->total();
      $lastPage=$haisous->lastPage() ;
    @endphp

    <form id="mainForm" action="{{ route('officeMaster') }}" method="post">
      <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
      <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
      <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
      <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
      @csrf
      <input type="hidden" id="userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="company_yobi12" name="yobi12" value="{{$com_yobi12}}">
      <input id='submit_confirmation' value='' type='hidden'/>
      <input id='innerlevel' value='{{$tantousya->innerlevel}}' type='hidden'/>

      <div class="container">
        <div class="row" style="margin-top: -22px;">
          <div class="col-lg-12">
            <div>
              <div class="wrap-100"
                style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">

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
                @include('master.officeMaster.pagination')
                {{-- Pagination Ends Here --}}

                <!-- Large table row starts here -->
                <div class="row">
                  <div class="col-lg-12">
                    <div id="userTable" style="overflow: hidden;">
                      <div class="table-responsive largeTable">
                        <table class="table table-bordered table-fill table-striped">
                          <thead class="thead-dark header text-center" id="myHeader">

                            <tr>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                                @if($field == 'formatted_otherfloat1')
                                <th class="signbtn" scope="col">
                                  <span class="th_design"
                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;color: #fff;"
                                    onclick="AscDsc('otherfloat1');">
                                    {{$header}}
                                  </span>
                                </th>
                                @else
                                <th class="signbtn" scope="col">
                                  <span class="th_design"
                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;color: #fff;"
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
                              <td></td>
                              @foreach($headers as $header=>$field)
                                @if($field=='formatted_otherfloat1')
                                <td>
                                  <input type="text" name="{{'otherfloat1'}}" class="form-control" value="{{isset($old['otherfloat1'])?$old['otherfloat1']:null}}">
                                </td>
                                @else
                                <td>
                                  <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                                </td>
                                @endif
                              @endforeach
                            </tr>
                            
                            @foreach($haisous as $key=>$val)
                            <tr>
                              <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center">
                                <a href="#" class="btn btn-warning btn-m-view" style="width: 100%; background-color: #87ceeb!important;border:1px solid #87ceeb!important;" onclick="goToPersonalMaster('{{$val->bango}}');">
                                  <i class="fas fa-plus-circle" style="margin-right:5px;"></i>
                                  展開
                                </a>
                              </td>
                              <td style="width:50px;">
                                <a href="#" id="productsubButton1" class="btn btn-info btn-m-view" style="width: 100%;" onclick="detailOfficeMaster('{{route("officeMasterDetail",[$bango])}}','{{$val->bango}}');">
                                  <i class="fa fa-folder-open" aria-hidden="" style="margin-right: 5px;"></i>
                                  詳細
                                </a>
                              </td>
                              @php
                                $text_align_field = ['formatted_otherfloat1'];
                              @endphp
                              @foreach($headers as $header=>$field)
                                @if(in_array($field,$text_align_field))
                                  <td class="text-right">{{$val->$field}}</td>
                                @elseif(gettype($val->$field) == 'integer')
                                  <td style="text-align: right;">{{$val->$field}}</td>
                                @elseif($field == "otherfloat2")
                                  <td style="text-align: right;">{{$val->$field}}</td>
                                @elseif($field == "otherfloat3")
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
            </div>
          </div>
        </div>
      </div>
    </form>

    <form id="personalTable" action="{{ route('personal') }}" method="post">
      @csrf
      <input type="hidden" name="userId" value="{{ $bango }}">
      <input type="hidden" name="torihikisakibango" id="torihikisakibango" value="">
    </form>
  </div>
</div>