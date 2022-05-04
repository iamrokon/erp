
      <div class="content-head-section">

        @php
          $old = array();
          if(session()->has('oldInput'.$bango)){
            $old = session()->get('oldInput'.$bango);
          }
          $current_page=$dashboardCommentInfo->currentPage();
          $per_page=$dashboardCommentInfo->perPage();
          $first_data= ($current_page - 1)*$per_page+1;
          $last_data=($current_page - 1)*$per_page+ sizeof($dashboardCommentInfo->items());
          $total = $dashboardCommentInfo->total();
          $lastPage = $dashboardCommentInfo->lastPage() ;
        @endphp

        <div class="container position-relative">

        <form id="mainForm" action="{{ route('dashboardComment') }}" method="post">
          <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
          @csrf
          <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
          <input type="hidden" id="sortField" name="sortField"
            value="{{isset($old['sortField'])?$old['sortField']:null}}">
          <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
          <input type="hidden" id="userId" name="userId" value="{{$bango}}">
          <input id='submit_confirmation' value='' type='hidden'/>

           @if(Session::has('success_msg'))
            <div class="row success-msg-box position-relative" id="session_msg" style="width: 100%;max-width: 1452px;z-index: 1;" >
                <div class="col-12" style="white-space: normal; word-break: break-all;">
                    <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close dismissMe" data-dismiss="alert" autofocus>
                            &times;
                        </button>
                        <strong>{{session()->pull('success_msg') }}</strong>
                    </div>
                </div>
            </div>
            @elseif(isset($exceedUser) && $exceedUser!=null)
              <p class="common_error">{{$exceedUser}}</p>
           @endif

          <div class="row">
            <div class="col">
              <div class="content-head-top inner-top-content">
                {{-- Common Button Starts Here --}}
                @include('layout.commonButton')
                {{-- Common Button Ends Here --}}

                {{-- Pagination Starts Here --}}
                @include('other.dashboardcomment.pagination')
                {{-- Pagination Ends Here --}}

                <!-- pagination row end here -->
                <!-- Table row starts here -->
                <div class="row">
                  <div class="col-lg-12 mt-2">
                    <div style="overflow: hidden;">
                      <div class="table-responsive largeTable" style="">
                        <table id="dashboardCommentTable" class="table table-fill table-bordered table-striped">
                          <thead class="thead-dark header text-center" id="myHeader">
                            <tr>
                              <th class="signbtn" scope="col"></th>
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
                            @foreach($dashboardCommentInfo as $key=>$val)
                            <tr>

                              <td style="width:50px;">
<!--                                <a href="{{ $val->sitehinban }}" id="empButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#" onclick="viewDetail('{{route("dashboardCommentDetail",[$bango])}}','{{$val->syouhinbango}}');">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>編集
                                </a>-->
                                <a id="empButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#" onclick="viewDetail('{{route("dashboardCommentDetail",[$bango])}}','{{$val->syouhinbango}}');">
                                    <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>編集
                                </a>
                              </td>
                              @foreach($headers as $header=>$field)
                              @if($field == 'yukouflag')
                              <td><?php if($val->$field == 1){echo "1：LAMU";}elseif($val->$field == 2){echo "2：その他の";}?></td>
                              @elseif($field == 'status')
                              <td>{!! $val->status_without_tag !!}</td>
                              <!--<td><?php echo mb_substr(strip_tags(html_entity_decode($val->$field)),0,11); ?><?php if(mb_substr(strip_tags(html_entity_decode($val->$field)),12)){echo "...";}?></td>-->
                              @elseif($field == 'submit_date')
                              <td><?php echo date('Y/m/d',strtotime($val->$field));?></td>
                              @else
                              <td>{!! $val->$field !!}</td>
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
                <!-- Table row end here -->
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>
