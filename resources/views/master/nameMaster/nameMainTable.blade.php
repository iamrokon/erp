<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">

    @php
      $old = array();
      if(session()->has('oldInputName'.$bango)){
        $old = session()->get('oldInputName'.$bango);
      }
      $current_page=$categorykanris->currentPage();
      $per_page=$categorykanris->perPage();
      $first_data= ($current_page - 1)*$per_page+1;
      $last_data=($current_page - 1)*$per_page+ sizeof($categorykanris->items());
      $total=$categorykanris->total();
      $lastPage=$categorykanris->lastPage() ;
    @endphp

    <div class="container">

      <form id="mainForm" action="{{ route('nameMaster') }}" method="get">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField"
          value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input id='submit_confirmation' value='' type='hidden'/>
        @csrf

        <div class="row" style="margin-top: -22px;">
          <div class="col-lg-12">
            <div style="">
              <div class="wrap-100"
                style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">
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
                @include('master.nameMaster.pagination')
                {{-- Pagination Ends Here --}}

                <!-- Large table row starts here -->
                <div class="row">
                  <div class="col-lg-12">
                    <div style="overflow: hidden;">
                      <div id="userTable" class="table-responsive largeTable" style="">
                        <table class="table table-fill table-bordered table-striped" style="width: auto;">

                          <thead class="thead-dark header text-center" id="myHeader">
                            <tr>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                              <th scope="col">
                                <span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                  onclick="AscDsc('{{$field}}');">{{$header}}
                                </span>
                              </th>
                              @endforeach
                            </tr>
                          </thead>

                          <tbody>


                            <tr>
                              <td></td>
                              @foreach($headers as $header=>$field)
                              <td>
                                <input type="text" name="{{$field}}" class="form-control"
                                  value="{{isset($old[$field])?$old[$field]:null}}">
                              </td>
                              @endforeach
                            </tr>

                            @foreach($categorykanris as $key=>$val)
                            <tr>
                              <td style="width:50px;">
                                <a href="{{$val->category1.' '.$val->category2}}" id="empButton1" class="btn btn-info"
                                  style="width: 100%;" data-toggle="modal" data-target="#"
                                  onclick="viewDetail('{{route("nameDetail",[$bango])}}','{{$val->bango}}');">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                </a>
                              </td>
                              @foreach($headers as $header=>$field)
                                @if($field=='datatxt0003' || $field=='datatxt0004' || $field=='datatxt0005')
                                  <td>{{$val->$field. " "}} {{isset($categorykanri[$val->$field])?$categorykanri[$val->$field]:null}}</td>
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
      </form>
    </div>
  </div>
</div>
