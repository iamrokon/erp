    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      @php
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $projectInfo->currentPage();
        $per_page = $projectInfo->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($projectInfo->items());
        $total = $projectInfo->total();
        $lastPage = $projectInfo->lastPage() ;
      @endphp

      <form id="mainForm" action="{{ route('projectRegistration') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input id='submit_confirmation' value='' type='hidden'/>
        @csrf



        <div class="content-head-section " style="">
          <div class="container position-relative">

            <!-- show success message -->
            @if(Session::has('success_msg'))
            <div class="row success-msg-box" style="position: relative;width: 100%;max-width: 1452px;z-index: 1;">
              <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#content_setumei').focus();" >&times;</button>
                  <strong>{{session()->get('success_msg')}}</strong>
                </div>
              </div>
            </div>
            @endif

            <!-- show failure message -->
            @if(Session::has('failure_msg'))
            <div class="row alert-msg-box" style="position: relative; width: 100%;max-width: 1452px;z-index: 1;">
              <div class="col-12">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{session()->get('failure_msg')}}</strong>
                </div>
              </div>
            </div>
            @endif

            {{-- Error Message Starts Here --}}
            @if(isset($exceedUser))
            <p class="err_text common_error">{{$exceedUser}}</p>
            @endif
            {{-- Error Message Ends Here --}}

            <div class="row">
              <div class="col">
                <div class="content-head-top project-content ">
                  <div class="row outer">
                    <div class="col-3">
                      <table class="table custom-form" style="width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;border:0!important;padding:0px !important">
                              <div class="line-icon-box" style="background: #353A81;"></div>
                            </td>
                            <td style="width: 44px!important;border: none!important;text-align: left;color: black;">
                              営業
                            </td>
                            <!-- <td style="border: none !important;">
                              <div class="custom-arrow">
                                <select class="form-control" name="" id="" autofocus="">
                                  <option value="">0275 小川卓也</option>
                                </select>
                              </div>
                            </td> -->
                            <td style="border: none !important;">
                              <div class="custom-arrow">
                                <select name="content_setumei" id="content_setumei" class="form-control" autofocus="">
                                  <option value="all">-</option>
                                  @foreach($setumei as $setmi)
                                      @if(isset($old['content_setumei']))
                                          <option value="{{$setmi->bango}}" @if(isset($old['content_setumei']) && $setmi->bango==$old['content_setumei']){{'selected'}}@endif>
                                            {{$setmi->bango." ".$setmi->name}}
                                          </option>
                                      @else
                                          <option value="{{$setmi->bango}}" @if($setmi->bango==$bango){{'selected'}}@endif>
                                            {{$setmi->bango." ".$setmi->name}}
                                          </option>
                                      @endif
                                  @endforeach
                                </select>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row" style="margin-bottom: 17px!important;">
                    <div class="col-8">
                      <div class="d-inline float-left">
                      <table class="table custom-form" style="width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;border:0!important;padding:0px !important;">
                              <div class="line-icon-box" style="background: #353A81;"></div>
                            </td>
                            <td style="width: 43px!important;border: none!important;text-align: left;color: black;">
                              受注先
                            </td>
                            <!-- <td style=" border: none!important;">
                              <div style="width: 100%;">
                                <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" placeholder="受注先（コード入力/絞込入力）" readonly="" style="padding: 0!important;">
                                  <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                                    <button class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </div>
                            </td> -->
                            <td style=" border: none!important;">
                              <div style="width: 100%;">
                                <div class="input-group input-group-sm custom_modal_input">
                                  <input name="content_show_catchsm" id="content_show_catchsm" value="{{isset($old['content_show_catchsm'])?$old['content_show_catchsm']:null}}" type="text" class="form-control" placeholder="受注先（コード入力/絞込入力）" readonly="" style="padding: 0!important;max-width:507px!important;">
                                  <input name="content_catchsm" id="content_catchsm" value="{{isset($old['content_catchsm'])?$old['content_catchsm']:null}}" type="hidden" class="form-control" readonly="" style="padding: 0!important;">
                                  <div class="input-group-append">
                                    <button onclick="supplierSelectionModalOpener_3('content_show_catchsm','content_catchsm','1','nullable','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                      @if($tantousya->innerlevel <= 10)  
                      <div class="d-inline mt-2 float-left ml-4">
                        <label class="checkbox_container header-checkbox mt-2" style="display: inline;">削除データ表示
                        <input class="checkAllCheckbox" type="checkbox" id="lblchk1" name="chkboxinp" value="1" onclick="refresh()"
                        @if(isset($deleted_item)?($deleted_item==1):false) checked="checked" @endif >
                        <span class="checkmark" style="top: 1px;"></span>
                        </label>
                      </div>
                      @endif 
                    </div>
                  </div>
                </div>
                <div class="content-head-top">
                  <div class="row" style="margin-top:25px;margin-bottom:25px;">
                    <div class="col-12">
                      <div class="text-right">
                        <button type="button" onclick="Thesearch();" class="btn btn-info uskc-button">表示</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="content-head-bottom">
                  <div class="row mb-2 mt-2">
                    <div class="col">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-bottom-section" style="padding-bottom:46px!important;">
          <div class="content-bottom-top">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    プロジェクト登録
                  </div>
                </div>
              </div>
            </div>
            <div class="content-bottom-pagination" >
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                      {{-- Pagination Starts Here --}}
                      @include('order.projectRegistration.pagination')
                      {{-- Pagination Ends Here --}}
                        
                      <div class="row" style="margin-bottom: 30px;">
                        <div class="col-7 ml-auto">
                          <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                            <tbody>
                              <tr style="height: 28px;">
                                <td style=" border: none!important;">
                                  <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" class="btn bg-teal uskc-button text-white">検　索
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                  <button type="button" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button" data-dismiss="modal"> 一　覧
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                  <button type="button" id="" class="btn text-white uskc-button" onclick="openRegistration()" style="background: #e6e600;" @if(isset($deleted_item) & $deleted_item == 1){{'disabled'}}@endif> 新規作成
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                  <button type="button" id="excelDwld" onclick="excelDownload()" message="データをEXCELファイルとしてダウンロードします。" class="btn text-white uskc-button" data-dismiss="modal" style="background: #009640;"> Excelエクスポート
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
                <div class="col-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding:10px;">
                    <div class="table-responsive largeTable" id="userTable">
                      <table class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                          <tr>
                            <th scope="col"></th>
                            <!-- <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">プロジェクト番号</span>
                            </th> -->
                            @foreach($headers as $header=>$field)
                              <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 60px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                              </th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center"></td>
                            <!-- <td><input type="text" class="form-control"></td> -->
                            @foreach($headers as $header=>$field)
                            <td>
                              <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                            </td>
                            @endforeach
                          </tr>

                          @foreach($projectInfo as $key=>$val)
                          <tr>
                            <td style="width:50px;">
                              <a href="#" class="btn btn-info" style="width: 100%;background: #4D82C6 !important;border: 1px solid #4D82C6 !important;" onclick="viewProjectDetail('{{route("projectRegistrationDetail",[$bango])}}','{{$val->url}}','{{$bango}}');"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>
                              詳細</a>
                            </td>
                            @foreach($headers as $header=>$field)
                            <td>{{$val->$field}}</td>
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
