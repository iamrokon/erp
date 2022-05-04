@php
if(isset($lBookInfo)){
    $old = array();
    if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
    }
    $current_page = $lBookInfo->currentPage();
    $per_page = $lBookInfo->perPage();
    $first_data = ($current_page - 1)*$per_page+1;
    $last_data = ($current_page - 1)*$per_page+ sizeof($lBookInfo->items());
    $total = $lBookInfo->total();
    $lastPage = $lBookInfo->lastPage() ;    
}else{
    $current_page = 1;
    $per_page = 20;
    $first_data = 1;
    $last_data = 0;
    $total = 0;
    $lastPage = 1;
}
@endphp

<div id="reg_load_data">
    <form id="mainForm" action="{{ route('lBook') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="source" value="lBook"/>
        <input id='submit_confirmation' value='' type='hidden'/>
        @csrf

        <!-- first search req data //fsReqData=first search request data -->
        @if(isset($fsReqData))
        @foreach($fsReqData as $k=>$v)
          <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
        @endforeach
        @endif

        <div class="content-bottom-section" style="padding-bottom:46px!important;">
            <div class="content-bottom-top">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="bottom-top-title" style="letter-spacing: 0px;">
                      書 類 保 管 L-BOOK
                    </div>
                  </div>
                </div>
              </div>
               <div class="content-bottom-pagination" >
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="wrapper-pagination" style="background-color:#fff;padding: 10px;">

                      {{-- Pagination Starts Here --}}
                      @include('other.lBook.pagination')
                      {{-- Pagination Ends Here --}} 

                      <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                          <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                            <tbody>
                              <tr style="height: 30px;">
                                <td style="border: none!important;">
                                  <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" class="btn bg-teal uskc-button text-white" data-dismiss="modal">検　索
                                  </button>
                                </td>
                                <td style="border: none!important;">
                                  <button type="button" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button" data-dismiss="modal">一　覧
                                  </button>
                                </td>
                                <td style="border: none!important;">
                                  <button type="button" message="新規登録画面を表示します。" onclick="openRegistration()" class="btn btn-warning uskc-button">新規作成</button>
                                </td>
                                <td style="border: none!important;">
                                  <button type="button" id="excelDwld" onclick="excelDownload()" message="データをEXCELファイルとしてダウンロードします。" class="btn text-white uskc-button" data-dismiss="modal" style="background: #009640;">Excelエクスポート
                                  </button>
                                </td>
                              </tr>
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

          <div class="content-bottom-bottom">
            <div class="container">
              <div class="row mt-3" style="">
                <div class="col-lg-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                    <div class="table-responsive largeTable">
                      <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                          <tr>
                              @foreach($headers as $header=>$field)
                                <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');"
                                    style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                                </th>
                              @endforeach
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              @foreach($headers as $header=>$field)
                                @if($field == "datachar06_detail")
                                <td>
                                  <input type="text" name="datachar06_search" class="form-control"
                                    value="{{isset($default_req_data['datachar06_search'])?$default_req_data['datachar06_search']:null}}">
                                </td>
                                @else
                                <td>
                                  <input type="text" name="{{$field}}" class="form-control"
                                    value="{{isset($default_req_data[$field])?$default_req_data[$field]:null}}">
                                </td>
                                @endif
                              @endforeach
                          </tr>
                          @if(isset($lBookInfo))
                            @foreach($lBookInfo as $key=>$val)
                            <tr>
                              @foreach($headers as $header=>$field)
                              @if($field == "datachar01")
                                <td style="width:50px;">
                                  <a onclick="viewLBookDetail('{{route("lBookDetail",[$bango])}}','{{$val->datachar01}}','{{$bango}}');"
                                     href="#" style="color:#0056b3;text-decoration:underline;">{{$val->$field}}</a>
                                </td>
                              @elseif($field == "datachar09")
                              @php
                              $extention = explode(".",$val->datachar09)[1];
                              $filename = explode("¶",$val->datachar09)[0].".".$extention;
                              @endphp
                              <td><a style="color:#0056b3;text-decoration:underline;" target="_blank" @if(explode(".",$val->datachar09)[1] == 'zip'){{"download=".$filename}}@endif href="@if(explode(".",$val->datachar09)[1] == 'pdf') {{route('lBookFileDownload')}}?file={{$val->datachar09}} @else {{url('uploads/lbook'.'/'.$val->datachar09)}} @endif">{{$val->datachar09_short}}</a></td>
                              @elseif($field == "datachar09")
                              <td>{{$val->datachar09_short}}</td>
                              @elseif($field == "datachar08")
                              <td>{{$val->datachar08_short}}</td>
                              @elseif($field == "datachar06_detail")
                              <td>{{$val->datachar06_short}}</td>
                              @elseif($field == "juchukubun1")
                              <td>{{$val->juchukubun1_short}}</td>
                              @else
                              <td>{{$val->$field}}</td>
                              @endif
                              @endforeach
                            </tr>
                            @endforeach
                          @endif
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
