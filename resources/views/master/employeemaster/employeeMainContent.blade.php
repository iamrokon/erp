
<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">

    @php
      $old = array();
      if(session()->has('oldInput'.$bango)){
        $old = session()->get('oldInput'.$bango);
      }
      $current_page=$users->currentPage();
      $per_page=$users->perPage();
      $first_data= ($current_page - 1)*$per_page+1;
      $last_data=($current_page - 1)*$per_page+ sizeof($users->items());
      $total=$users->total();
      $lastPage=$users->lastPage();
    @endphp

    <div class="container">

      <form id="mainForm" action="{{ route('employeeMaster') }}" method="post">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        @csrf
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField"
          value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
          <input type="hidden" id="ztanka_def" value="{{$ztanka}}">
          <input id='submit_confirmation' value='' type='hidden'/>

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
                      <button type="button" class="close" data-dismiss="alert">&times;
                      </button>
                      <strong>{{session()->get('success_msg')}}</strong>
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
                @include('master.employeemaster.pagination')
                {{-- Pagination Ends Here --}}


                <div class="row">
                  <div class="col-lg-12">
                    <div id="userTable" class="table-responsive largeTable" style="padding-bottom: 10px;">
                      <table class="table table-bordered table-fill table-striped">

                        <thead class="thead-dark header text-center" id="myHeader">
                          <tr>
                            <th scope="col"></th>
                            @foreach($headers as $header=>$field)

                            <th class="signbtn" scope="col"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;"
                                onclick="AscDsc('{{$field}}');">{{$header}}</span></th>

                            @endforeach
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td></td>
                            @foreach($headers as $header=>$field)

                            <td>
                              <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                            </td>

                            @endforeach
                          </tr>

                          @foreach($users as $key=>$val)
                          <tr>
                            <td style="width:50px;">
                              <a href="{{ $val->bango  }}" id="empButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#" onclick="viewDetail('{{route("masterDetail",[$bango])}}','{{$val->bango}}');">
                                <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                              </a>
                            </td>
                            @foreach($headers as $header=>$field)
                            @if($field == 'passwd')
                                <td>******</td>
                            @else
                            @if($field == 'htanka')
                            <td>{{$val->$field}}</td>
                            @elseif($field == 'ztanka')
                            <td>{{$val->$field}}</td>
                            @elseif(gettype($val->$field) == 'integer')
                            <td style="text-align: right;">{{$val->$field}}</td>
                            @else
                            <td>{{$val->$field}}</td>
                            @endif
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
      </form>
    </div>
  </div>
</div>
