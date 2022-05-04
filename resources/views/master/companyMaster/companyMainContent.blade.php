<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
  <div class="content-head-section">
    @php
      $old = array();
      if(session()->has('oldInput'.$bango)){
        $old = session()->get('oldInput'.$bango);
      }
      $current_page=$companyInfo->currentPage();
      $per_page=$companyInfo->perPage();
      $first_data= ($current_page - 1)*$per_page+1;
      $last_data=($current_page - 1)*$per_page+ sizeof($companyInfo->items());
      $total = $companyInfo->total();
      $lastPage = $companyInfo->lastPage() ;
    @endphp
    <div class="container">
      <form id="mainForm" action="{{ route('companyMaster') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input id='submit_confirmation' value='' type='hidden'/>
        <input id='innerlevel' value='{{$tantousya->innerlevel}}' type='hidden'/>
        @csrf
        <div class="row" style="margin-top: -22px;">
          <div class="col-lg-12">
            <div>
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
                @include('master.companyMaster.pagination')
                {{-- Pagination Ends Here --}}

                
                <!-- Large table row starts here -->
                <div class="row">
                  <div class="col-lg-12">
                    <div style="overflow:hidden;">
                      <div id="userTable" class="largeTable" style="overflow-x: auto;">
                        <table class="table table-fill table-bordered table-striped" style="width: fit-content;">
                          
                          <thead class="thead-dark text-center" id="myHeader">
                            <tr>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              @foreach($headers as $header=>$field)
                              @if($field=='yobi12')
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'yobi12'}}');">{{$header}}
                                </span>
                              </th>
                              @elseif($field=='syukeinen')
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'syukeinen'}}');">{{$header}}
                                </span>
                              </th>
                              @elseif($field=='mail_soushin')
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'mail_soushin'}}');">{{$header}}
                                </span>
                              </th>
                              @elseif($field=='mail_nouhin_mb')
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'mail_nouhin_mb'}}');">{{$header}}
                                </span>
                              </th>
                              @elseif($field=='mallsoukobango3')
                              <th class="signbtn" scope="col">
                                <span
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'mallsoukobango3'}}');">{{$header}}
                                </span>
                              </th>
                              @elseif($field=='formatted_denpyostart')
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{'denpyostart'}}');">{{$header}}
                                </span>
                              </th>
                              @else
                              <th class="signbtn" scope="col">
                                <span
                                  message="@if(array_key_exists($header, $headerMessage)){{$headerMessage[$header]}}@endif"
                                  class="message_content"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1; color: #fff;border-radius: 4px;"
                                  onclick="AscDsc('{{$field}}');">{{$header}}
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
                              @if($field=='yobi12')
                              <td>
                                <!--<input type="text" name="{{'yobi12'}}" class="form-control" value="{{isset($old['yobi12'])?$old['yobi12']:null}}">-->
                                <input type="text" name="{{'yobi12'}}" class="form-control" value="{{isset($old['yobi12'])?$old['yobi12']:null}}">
                              </td>
                              @elseif($field=='syukeinen')
                              <td>
                                <input type="text" name="{{'syukeinen'}}" class="form-control" value="{{isset($old['syukeinen'])?$old['syukeinen']:null}}">
                              </td>
                              @elseif($field=='mail_soushin')
                              <td>
                                <input type="text" name="{{'mail_soushin'}}" class="form-control" value="{{isset($old['mail_soushin'])?$old['mail_soushin']:null}}">
                              </td>
                              @elseif($field=='mail_nouhin_mb')
                              <td>
                                <input type="text" name="{{'mail_nouhin_mb'}}" class="form-control" value="{{isset($old['mail_nouhin_mb'])?$old['mail_nouhin_mb']:null}}">
                              </td>
                              @elseif($field=='mallsoukobango3')
                              <td>
                                <input type="text" name="{{'mallsoukobango3'}}" class="form-control" value="{{isset($old['mallsoukobango3'])?$old['mallsoukobango3']:null}}">
                              </td>
                              @elseif($field=='formatted_denpyostart')
                              <td>
                                <input type="text" name="{{'denpyostart'}}" class="form-control" value="{{isset($old['denpyostart'])?$old['denpyostart']:null}}">
                              </td>
                              @else
                              <td>
                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                              </td>
                              @endif
                              @endforeach
                            </tr>
                            @foreach($companyInfo as $key=>$val)
                            <tr>
                              <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center">
                                <a href="#" onclick="goToOfficeMaster('{{$val->bango}}','{{$val->yobi12}}');"
                                  class="btn btn-warning btn-m-view gotoOfficeMaster"
                                  style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;">
                                  <i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開
                                </a>
                              </td>
                              <td style="width:50px;">
                                <a href="{{$val->bango}}" id="empButton1" class="btn btn-info btn-m-view " style="width: 100%;"
                                  data-toggle="modal" data-target="#"
                                  onclick="viewCompanyDetail('{{route("companyMasterDetail",[$bango])}}','{{$val->bango}}');">
                                  <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                </a>
                              </td>
                              @php
                                $text_align_field = ['formatted_denpyostart'];
                              @endphp
                              @foreach($headers as $header=>$field)
                                @if(in_array($field,$text_align_field))
                                  <td class="text-right">
                                    {{$val->$field}}
                                  </td>
                                @elseif($field == "yobi13_short")
                                  <td><a href="{{url('/uploads/company_master/'.$val->yobi13)}}" target="_blank">{{$val->$field}}</a></td>
                                @elseif($field == "syukei2")
                                  <td style="text-align: right;">{{$val->$field}}</td>
                                @elseif($field == "syukei3")
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
      </form>
    </div>
  </div>
</div>

<form id="officeTable" action="{{ route('officeMaster') }}" method="post">
  @csrf
  <input type="hidden" name="userId" value="{{ $bango }}">
  <input type="hidden" name="kokyakubango" id="kokyakubango" value="">
  <input type="hidden" name="yobi12" id="yobi12" value="">
</form>