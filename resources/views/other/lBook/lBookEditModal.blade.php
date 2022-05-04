<form id="editForm" action="{{ route('postEditLBookRegistration',[$bango])}}" method="post" data-editmethod="editLBook"
  onsubmit="editLBook('{{route("postEditLBookRegistration",[$bango])}}');event.preventDefault();">
    <input type="hidden" id="csrf" value="{{csrf_token()}}"/>
    @csrf
    <input type="hidden" name="type" value="edit">
    <input type="hidden" id="edit_hiddenBango" name="bango" value="">
<!--    <input id="userId" value="{{$bango}}">-->

    <div class="modal" data-keyboard="false" data-backdrop="static" id="lBookEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" style="max-width: 700px !important;" role="document">
        <div class="modal-content" style="border: 3px solid white;">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px";>書類保管</h5>
            <button type="button" class="close remove-cls" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body custom-form  bg-blue text-white" data-bind="nextFieldOnEnter:true">
            <div class="development_page_top_table heading_mt" style="margin:0px;">
              <!--=======================Modal 2 button start ======================-->
              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="top-text" id="edit_success_msg"></div>
                </div>
              </div>
              <div class="row titlebr">
                <div class="col-lg-12">
                  <div style="display: inline;">
                    <div class="float-left">
                        <div>処理状況　：　修正登録</div>
                        <!-- <div>※は入力必須項目です</div> -->

                        <!-- Error Message Starts Here -->
                        <div id="edit_error_data"></div>
                        <!-- Error Message Ends Here -->

                    </div>
                    <div style="float: right;">
                      @if($tantousya->innerlevel <= 10)
                      <button id="deleteThis" onclick="deleteLBook('{{route('deleteOrReturnLBook',[$bango])}}')" autofocus="" class="btn btn-info scroll" autofocus="" style="margin-right: 5px;background: #4D82C6 !important;" type="button"><i class="fa fa-trash" aria-hidden="true" style="margin-right: 5px;"></i>削除</button>
                      @endif
                      <button id="editButton" type="submit" class="btn btn-info scroll" style="margin-right: 5px;background: #4D82C6 !important;" ><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>修正登録</button>
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
                              <input name="datachar01" id="edit_datachar01" type="text" readonly="" class="form-control" style="width: 200px;">
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
                            <div class="input-group input-group-sm" id="err_edit_datachar02">
                              <input name="datachar02" id="edit_datachar02" type="hidden" class="form-control">
                              <input id="show_edit_datachar02" type="text" class="form-control" placeholder="受注先" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_edit_datachar02','edit_datachar02','1','required','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
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
                              <input name="datachar03" id="edit_datachar03" type="hidden" class="form-control" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                              <input id="show_edit_datachar03" type="text" class="form-control" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_edit_datachar03','edit_datachar03','1','nullable','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
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
                              <input name="datachar04" id="edit_datachar04" type="hidden" class="form-control" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                              <input id="show_edit_datachar04" type="text" class="form-control" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                              <div class="input-group-append" id="searchBtn">
                                <button onclick="supplierSelectionModalOpener('show_edit_datachar04','edit_datachar04','0','nullable','r17_3cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
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
                              <input name="datachar05" id="edit_datachar05" type="text" class="form-control" placeholder="受注番号" readonly="" style="padding: 0!important;">
                              <div class="input-group-append">
                                <button class="input-group-text btn " onclick="handleNumberSearchModalOpener('edit_datachar05',event.preventDefault())" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
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
                                <select name="datachar06" id="edit_datachar06" class="form-control">
                                  <option value="">-</option>
                                    @foreach($datachar06 as $Dt6)
                                        <option value="{{$Dt6->bango}}">
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
                                <select name="datachar07" id="edit_datachar07" class="form-control">
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
                            <textarea name="datachar08" id="edit_datachar08" class="form-control" rows="5" col="50" id="" style="width: 100%; height: auto;padding-left: 0px !important;"></textarea>
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
                        <div class="input-group input-group-sm" id="err_edit_datachar09">
                          <input name="old_datachar09" id="edit_old_datachar09" type="hidden" >
                          <input name="modified_old_datachar09" id="edit_modified_old_datachar09" type="hidden" >
                          <input name="datachar09" id="edit_datachar09" readonly="" type="text" class="input_field form-control" style="border:1px solid #E1E1E1 !important;border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;padding-left: 0px !important;">
                          <div class="input-group-append">
                            <div class="custom-file" style="height: auto;">
                              <input type="file" accept=".pdf,.zip" class="custom-file-input2" id="customFileEditOrder" name="filename">
                              <a style="height: 28px;border-radius: 0px;border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;" class="btn btn-info" href="#"> <label for="customFileEditOrder"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照</label></a>
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
                                <select name="datachar10" id="edit_datachar10" class="form-control" >
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
