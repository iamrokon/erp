<form id="registrationForm" action="{{ route('postEditLBookRegistration',[$bango])}}" method="post" data-regmethod="registerLBook"
  onsubmit="registerLBook('{{route("postEditLBookRegistration",[$bango])}}');event.preventDefault();">
    <input type="hidden" id="csrf" value="{{csrf_token()}}"/>
    @csrf
    <input type="hidden" name="type" value="create">
    <input type="hidden" id="userId" value="{{$bango}}">

    <div class="modal" data-keyboard="false" data-backdrop="static" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" style="max-width: 700px !important;" role="document">
        <div class="modal-content" style="border: 3px solid white;">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px";>書類保管</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body custom-form  bg-blue text-white" data-bind="nextFieldOnEnter:true">
            <div class="development_page_top_table heading_mt" style="margin:0px;">
              <!--=======================Modal 2 button start ======================-->
              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="top-text" id="reg_success_msg"></div>
                </div>
              </div>
              <div class="row titlebr">
                <div class="col-lg-12">
                  <div style="display: inline;">
                    <div class="float-left">
                        <div>処理状況　：　新規登録</div>
                        <!-- <div>※は入力必須項目です</div> -->

                        <!-- Error Message Starts Here -->
                        <div id="error_data"></div>
                        <!-- Error Message Ends Here -->

                    </div>
                    <div style="float: right;">
                       <button name="insert" autofocus="" class="btn btn-info scroll" autofocus="" style="margin-right: 5px;background: #4D82C6 !important;" id="regEditButton" type="button"><i class="fa fa-trash" aria-hidden="true" style="margin-right: 5px;"></i>削除</button>
                      <button id="regButton" type="submit" class="btn btn-info scroll" style="margin-right: 5px;background: #4D82C6 !important;" ><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>新規登録</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--======================= modal 1 table start ======================-->
            <div class="row mt-1 mb-3">
              <div class="col-lg-12">
                <div class="tbl_name square-title">
                  <div class="w-100">
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          書類保管番号 <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row">
                          <div class="col-12">
                              <input name="datachar01" id="reg_datachar01" value="@if($datachar01!=''){{$datachar01}}@else{{''}}@endif" type="text" readonly="" class="form-control" style="width: 200px;">
                              <input type="hidden" name="hidden_orderbango" id="hiddenOrderbango" value="@if($orderbango!=''){{$orderbango}}@else{{''}}@endif" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          受注先 <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row custom-form">
                          <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="input-group input-group-sm" id="err_datachar02">
                              <input name="datachar02" id="reg_datachar02" type="hidden" class="form-control">
                              <input id="show_datachar02" type="text" class="form-control" placeholder="受注先" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_datachar02','reg_datachar02','1','required','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          売上請求先
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row custom-form">
                          <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="input-group input-group-sm">
                              <input name="datachar03" id="reg_datachar03" type="hidden" class="form-control" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                              <input id="show_datachar03" type="text" class="form-control" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_datachar03','reg_datachar03','1','nullable','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          最終顧客
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row custom-form">
                          <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="input-group input-group-sm">
                              <input name="datachar04" id="reg_datachar04" type="hidden" class="form-control" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                              <input id="show_datachar04" type="text" class="form-control" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_datachar04','reg_datachar04','0','nullable','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          受注番号
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row custom-form">
                          <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="input-group input-group-sm" style="width: 218px;">
                              <input name="datachar05" id="reg_datachar05" type="text" class="form-control" placeholder="受注番号" readonly="" style="padding: 0!important;">
                              <div class="input-group-append">
                                <button class="input-group-text btn" onclick="handleNumberSearchModalOpener('reg_datachar05',event.preventDefault())" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          担当 <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row">
                          <div class="col-7 ">
                            <div style="position: relative;width: 218px;">
                              <div class="custom-arrow">
                                <select name="datachar06" id="reg_datachar06" class="form-control">
                                  <option value="">-</option>
                                    @foreach($datachar06 as $Dt6)
                                        <option value="{{$Dt6->bango}}" @if($Dt6->bango == $bango){{'selected'}}@endif>
                                          {{$Dt6->bango." ".$Dt6->name}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          文書種類 <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row">
                          <div class="col-7 ">
                            <div style="position: relative;">
                              <div class="custom-arrow">
                                <select name="datachar07" id="reg_datachar07" class="form-control">
                                    <option value="">-</option>
                                    @foreach($h1Data as $h1Dt)
                                        <option value="{{$h1Dt->category1.$h1Dt->category2}}">
                                          {{$h1Dt->category2." ".$h1Dt->category4}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          文書名 <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row">
                          <div class="col">
                            <textarea name="datachar08" id="reg_datachar08" class="form-control" rows="5" col="50" id="" style="width: 100%; height: auto;padding-left: 0px !important;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          保管ファイル <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="input-group input-group-sm" id="err_datachar09">
                          <input name="datachar09" id="reg_datachar09" readonly="" type="text" class="input_field form-control" style="border:1px solid #E1E1E1 !important;border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;padding-left: 0px !important;">
                          <div class="input-group-append">
                            <div class="custom-file" style="height: auto;">
                                <input type="file" accept=".pdf,.zip" class="custom-file-input" id="customFileOrder" name="filename">
                              <a style="height: 28px;border-radius: 0px;border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;" class="btn btn-info" href="#"> <label for="customFileOrder"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照</label></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row form-group">
                      <div class="col-lg-3 col-md-3 col-sm-3 pr-0">
                        <div class="mt-1">
                          <div class="line-icon-box"></div>
                          共有レベル <span style="color:red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="outer row">
                          <div class="col-7 ">
                            <div style="position: relative;">
                              <div class="custom-arrow">
                                <select name="datachar10" id="reg_datachar10" class="form-control" >
                                    <option value="">-</option>
                                    @foreach($h9Data as $h9Dt)
                                        <option value="{{$h9Dt->category1.$h9Dt->category2}}">
                                          {{$h9Dt->category2." ".$h9Dt->category4}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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
