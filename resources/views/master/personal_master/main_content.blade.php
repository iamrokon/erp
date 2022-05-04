<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">
    @php
    $old = array();
    if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
    }
    $current_page = $etsuransyas->currentPage();
    $per_page=$etsuransyas->perPage();
    $first_data= ($current_page - 1) * $per_page+1;
    $last_data=($current_page - 1)* $per_page+ sizeof($etsuransyas->items());
    $total=$etsuransyas->total();
    $lastPage=$etsuransyas->lastPage() ;
    @endphp
    <div class="container">
      <form id="mainForm" action="{{ route('personal') }}" method="post">
        @csrf
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField"
          value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" name="officeId" value="{{ $officeId }}">
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
                <!-- end success message -->

                <!-- show warning message -->
                @if(isset($exceedEtsuransyas))
                <p style="color: red;">{{$exceedEtsuransyas}}</p>
                @endif
                <!-- end warning message -->

                {{-- Common Button Starts Here --}}
                @include('layout.commonButton')
                {{-- Common Button Ends Here --}}

                {{-- Pagination Starts Here --}}
                @include('master.personal_master.pagination')
                {{-- Pagination Ends Here --}}

                <!-- Large table row starts here -->
                <div class="row">
                  <div class="col-lg-12">
                    <div style="overflow: hidden;">
                      <div id="userTable" class="table-responsive largeTable" style="padding-bottom: 10px;">
                        <table class="table table-fill table-bordered table-striped">
                          <thead class="thead-dark header text-center" id="myHeader">

                            <tr>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                              
                              <th class="signbtn" scope="col">
                                <span class="th_design"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;"
                                  onclick="AscDsc('{{$field}}');">
                                  {{$header}}
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

                            <!-- start dynamic row -->
                            @foreach($etsuransyas as $key => $val)
                            <tr>
                              <td style="width: 50px;">
                                <a class="btn btn-info btn-m-view open_view" style="width: 100%;"
                                  data-id="{{ $val->bango }}" data-url="{{route("personalDetail",$bango)}}">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>
                                  詳細
                                </a>
                              </td>
                              @foreach($headers as $header=>$field)
                              <td>{{$val->$field}}</td>
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
        </div>
      </form>
    </div>
  </div>
</div>