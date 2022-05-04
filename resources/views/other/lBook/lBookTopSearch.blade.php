<div class="content-head-section">
    <div class="container position-relative">
        
        <form id="firstSearch" action="{{ route('lBook') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="fs_sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        @csrf

          <div class="row order_entry_topcontent " style="margin-top: 35px;">
            <div class="col">
                @php
                $exceed_msg_status = 'yes';
                @endphp

                <!-- Error Message Starts Here -->
                <div class="common_error" id="search_error_data"></div>               
                <!-- Error Message Ends Here -->
				
		            <!-- Success Message -->
                @if(Session::has('success_msg'))
                @php
                $success_msg = session()->get('success_msg');
				        $exceed_msg_status = 'no';
                @endphp
                <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                  <div class="col-12 pl-0 pr-0 ml-3">
                        <div class="alert alert-primary alert-dismissible">
                          <button type="button" class="close" autofocus  data-dismiss="alert" >&times;</button>
                          <strong>{{$success_msg}}</strong>
                        </div>
                  </div>
                </div>
                @endif
               
                <!-- Delete Message -->
                @if(Session::has('delete_msg'))
                @php
                $delete_msg = session()->get('delete_msg');
				        $exceed_msg_status = 'no';
                @endphp
                <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                  <div class="col-12 pl-0 pr-0 ml-3">
                        <div class="alert alert-primary alert-dismissible">
                          <button type="button" class="close" autofocus  data-dismiss="alert" >&times;</button>
                          <strong>{{$delete_msg}}</strong>
                        </div>
                  </div>
                </div>
                @endif

		            @if(isset($exceedUser) && $exceed_msg_status == 'yes')
                <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
                @endif
              
  
              <!-- content head form section start -->
              <div class="content-head-top mb-4 inner-top-content">
                <div class="row mb-2">
                  <div class="ml-3 mr-3" style="padding-top: 10px;">
                    <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                      <tbody>
                        <tr>
                          <td class="text-render" style="border: none!important;color: black;width: 95px !important;padding-left:0px!important;">
                            <div style="width: 91px;">
                              <div class="line-icon-box float-left mr-3"></div>
                              受注先
                            </div>
                          </td>
                          <td style="border: none!important;">
                            <div>
                              <div class="input-group input-group-sm" id="error_datachar02_2">
                                <input name="datachar02" type="hidden" id="tsearch_datachar02_1" value="{{isset($fsReqData['datachar02'])?$fsReqData['datachar02']:null}}"/>
                                <input name="datachar02_detail" id="tsearch_datachar02_2" value="{{isset($fsReqData['datachar02_detail'])?$fsReqData['datachar02_detail']:null}}" type="text" class="form-control custom_modal_input" autofocus="" placeholder="受注先" readonly="" style="padding: 0!important;">
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_3('tsearch_datachar02_2','tsearch_datachar02_1','1','nullable','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-render" style="border: none!important;color: black;width: 95px !important;padding-left:0px!important;">
                            <div style="width: 91px;">
                              <div class="line-icon-box float-left mr-3"></div>
                              売上請求先
                            </div>
                          </td>
                          <td style="border: none!important;">
                            <div>
                              <div class="input-group input-group-sm" id="error_datachar03_3">
                                <input name="datachar03" type="hidden" id="tsearch_datachar03_1" value="{{isset($fsReqData['datachar03'])?$fsReqData['datachar03']:null}}"/>
                                <input name="datachar03_detail" id="tsearch_datachar03_2" value="{{isset($fsReqData['datachar03_detail'])?$fsReqData['datachar03_detail']:null}}" type="text" class="form-control custom_modal_input" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_3('tsearch_datachar03_2','tsearch_datachar03_1','1','nullable','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-render" style="border: none!important;color: black;width: 95px !important;padding-left:0px!important;">
                            <div style="width: 91px;">
                              <div class="line-icon-box float-left mr-3"></div>
                              最終顧客
                            </div>
                          </td>
                          <td style="border: none!important;">
                            <div>
                              <div class="input-group input-group-sm">
                                <input name="datachar04" type="hidden" id="tsearch_datachar04_1" value="{{isset($fsReqData['datachar04'])?$fsReqData['datachar04']:null}}"/>
                                <input name="datachar04_detail" id="tsearch_datachar04_2" value="{{isset($fsReqData['datachar04_detail'])?$fsReqData['datachar04_detail']:null}}" type="text" class="form-control custom_modal_input" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_3('tsearch_datachar04_2','tsearch_datachar04_1','0','nullable','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                          @php
                          $start_date = date("Y/m",strtotime(date('Y-m')." -1 month")).'/01';
                          $end_date = date('Y/m/d');
                          @endphp
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            登録日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input name="created_date_start" id="datepicker2_oen" value="{{isset($fsReqData['created_date_start'])?$fsReqData['created_date_start']:$start_date}}" autocomplete="off" type="text" class="form-control input_field" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" style="width: 96px!important;"
                              >
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input name="created_date_end" id="datepicker1_oen" value="{{isset($fsReqData['created_date_end'])?$fsReqData['created_date_end']:$end_date}}" autocomplete="off" type="text" class="form-control input_field" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" style="width: 96px!important;"
                              >
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width:94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            受注番号
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input name="datachar05_start" id="tsearch_datachar05_start" value="{{isset($fsReqData['datachar05_start'])?$fsReqData['datachar05_start']:null}}" type="text" 
                              oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" class="form-control" maxlength="10"  
                              style="width: 94px!important;padding-left: 0px !important;">
                            </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input name="datachar05_end" id="tsearch_datachar05_end" value="{{isset($fsReqData['datachar05_end'])?$fsReqData['datachar05_end']:null}}" type="text" 
                              oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" class="form-control" maxlength="10" 
                              style="padding-left: 0px !important;width: 80px;">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            文書種類
                          </td>
                          <td style="width: 332px !important;text-align: center;border: none!important;">
                            <div class="custom-arrow">
                              <select name="datachar07" id="tsearch_datachar07" class="form-control">
                                <option value="">-</option>
                                @foreach($h1Data as $h1Dt)
                                    <option value="{{$h1Dt->category1.$h1Dt->category2}}" @if(isset($fsReqData['datachar07']) && $h1Dt->category1.$h1Dt->category2==$fsReqData['datachar07']){{'selected'}}@endif>
                                      {{$h1Dt->category2." ".$h1Dt->category4}}
                                    </option>
                                @endforeach
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px!important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            担当
                          </td>
                          <td style="width: 332px !important;text-align: center;border: none!important;">
                            <div class="custom-arrow">
                              <select name="datachar06" id="tsearch_datachar06" class="form-control">
                                <option value="">-</option>
                                @foreach($datachar06 as $Dt6)
                                    @if(isset($fsReqData['datachar06']))
                                        <option value="{{$Dt6->bango}}" @if($Dt6->bango==$fsReqData['datachar06']){{'selected'}}@endif>
                                        {{$Dt6->bango." ".$Dt6->name}}
                                    @else
                                        @if(isset($fsReqData) && count($fsReqData)>0)
                                            <option value="{{$Dt6->bango}}" >
                                            {{$Dt6->bango." ".$Dt6->name}}
                                          </option>
                                        @else
                                            <option value="{{$Dt6->bango}}" @if($Dt6->bango==$bango){{'selected'}}@endif>
                                              {{$Dt6->bango." ".$Dt6->name}}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                              </select>
                            </div>
                          </td>
                          {{-- <td style="text-align: center;border: none!important;">

                              <div class="d-inline-block float-right" style="margin-right: 10px;">
                                  <button onclick="firstSearch('{{route('lBook')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">表示</button>
                              </div>
                          </td> --}}
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- content head form section end -->
              <div class="content-head-top">
                <div style="margin-top:20px;margin-bottom:27px; padding-top:25px;padding-bottom:25px; border-bottom: 1px solid #E1E1E1; border-top: 1px solid #E1E1E1;">
                  <div class="col-12 pr-0">
                    <div class="text-right">
                      <button type="submit" onclick="firstSearch('{{route('lBook')}}',event.preventDefault())" class="btn btn-info uskc-button">表示</button>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </form>
    </div>
</div>