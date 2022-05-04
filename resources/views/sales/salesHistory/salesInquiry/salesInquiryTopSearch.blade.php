<form id="mainForm" action="{{ route('updateSelectedSalesInquiry') }}" method="post">
  <input type="hidden" id="userId" name="userId" value="{{$bango}}">
  <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
  <input type="hidden" id="orderbango" name="orderbango" value="{{ $salesInquiryFirstPart[0]->bango }}">
  <input type="hidden" id="kokyakuorderbango" name="kokyakuorderbango" value="{{ $salesInquiryFirstPart[0]->kokyakuorderbango }}">
  <input type="hidden" id="dataint06" name="dataint06" value="{{ $salesInquiryFirstPart[0]->dataint06 }}">
  <input type="hidden" id="changeStatus" value="0">
  @csrf
        <!-- Content head section start -->
        <div class="content-head-section">
          <div class="container" style="position: relative;">
            <!-- Show Success Message -->
            @if(Session::has('status_msg'))
            @php
            $status_msgs = session()->get('status_msg');
            @endphp
            <div class="row success-msg-box"  style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
              <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>{{$status_msgs}}</strong><br>
                </div>
              </div>
            </div>
           
            @endif
   
            <!-- Error Message Starts Here -->
            <div id="error_data" class="common_error">
            </div>
            <!-- Error Message Ends Here -->
            <div class="row order_entry_topcontent inner-top-content">
              <div class="col">

                <!-- Content head top section start -->
                <div class="content-head-top">
                  <div class="row">
                    <div class="ml-3 mr-3" style="width: 307px;">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">売上区分</td>
                            <td style=" border: none!important;width:144px;">
                              <input autofocus="" type="text" name="" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->text1 }}" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 53px!important;">作成区分</td>
                            <td style=" border: none!important;width: 178px">
                              <input type="text" name="" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->datachar01_val }}" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3" style="width: 308px;">
                      <table class="table custom-form" style="border: none!important;width: 100% !important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 75px!important;">売上番号</td>
                            <td style=" border: none!important; min-width: 179px!important;">
                              <div style="width: 100% !important;">
                                <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->juchukubun2 }}" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 67px!important;">受注番号</td>
                            <td style=" border: none!important;width: 178px;">
                              <!-- <div style="width: 269px !important"> -->
                              <div style="border: 1px solid #E1E1E1 !important;background-color: #e9ecef;padding: 5px;border-radius: 4px;padding-left: 0px;"><a style="color:#0056b3;text-decoration:underline;" href="#" onclick="gotoOrderInquiry_I('{{$salesInquiryFirstPart[0]->kokyakuorderbango}}',{{$salesInquiryFirstPart[0]->order_inquiry_ordertypebango2}})">{{ $salesInquiryFirstPart[0]->kokyakuorderbango }}</a></div>
                              <!-- </div> -->
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="ml-3 mr-3">
                      <table class="table custom-form" style="border: none!important;width:auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">受注先</td>
                            <td style=" border: none!important;width: 480px;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->information1_detail }}" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">売上請求先</td>
                            <td style=" border: none!important;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->information2_detail }}" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">最終顧客</td>
                            <td style=" border: none!important;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->information3_detail }}" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table custom-form " style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">受注日</td>
                            <td style=" border: none!important;width: 147px;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->intorder01 }}" readonly="">
                            </td>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;padding-left: 53px!important;">
                              <div class="line-icon-box ml-4"></div>
                            </td>
                            <td style=" border: none!important;width: 55px!important;">売上日</td>
                            <td style=" border: none!important;width: 177px;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->intorder03 }}" readonly="">
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 89px!important;">入金方法</td>
                            <td style=" border: none!important;width: 147px;">
                             @if($privileged_user)
                             <div class="custom-arrow">
                              <input type="hidden" class="dropdown_change_status_1" name="dropdown_change_status_1">
                              <select class="form-control dropdown_i" name="update_kessaihouhou" id="">
                                @foreach($category_dropdown as $value=>$option)
                                <option value="{{ $value }}" @if($salesInquiryFirstPart[0]->kessaihouhou==$value) {{ " selected" }}@endif>{{ $option }}</option>
                                @endforeach
                              </select>
                             </div>
                             @else
                             <?php $kessaihouhou=""; ?>
                             @foreach($category_dropdown as $value=>$option)
                                @if($salesInquiryFirstPart[0]->kessaihouhou==$value)
                                <?php $kessaihouhou = $option; ?>
                                @endif
                             @endforeach
                             <input type="text" class="form-control" placeholder="" value="{{ $kessaihouhou }}" readonly="">
                             @endif
                            </td>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;padding-left: 53px!important;">
                              <div class="line-icon-box ml-4"></div>
                            </td>
                            <td style=" border: none!important;width: 55px!important;">入金日</td>
                            <td style=" border: none!important;width: 177px;">
                              <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->intorder05 }}" readonly="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3 w-50">
                      <div class="row">
                        <div class="ml-3 mr-3" style="width:306px;"></div>
                        <div class="ml-3 mr-3">
                          <table class="table custom-form" style="border: none!important;width: 270px;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 67px!important;">請求書番号</td>
                                <td style=" border: none!important;width: 178px;">
                                  <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->text3 }}" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="ml-3 mr-3">
                          <table class="table custom-form" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求書送付先</td>
                                <td style=" border: none!important;width: 506px;">
                                  <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->information6_detail }}" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="ml-3 mr-3" style="border-right: 1px solid #D0D0D0;">
                          <table class="table custom-form vertical" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">担当</td>
                                <td style=" border: none!important;width: ">
                                  <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->name_with_id }}" readonly style="width: 50%;">
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求日</td>
                                <td style=" border: none!important;">
                                  <div class="d-flex">
                                    <div style="width: 50%">
                                    <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->chumondate }}" readonly style=" border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;">
                                  </div>

                                    @if($privileged_user)
                                    <div class="custom-arrow" style="width: 50%;">
                                      <input type="hidden" class="dropdown_change_status_2" name="dropdown_change_status_2">
                                      <select class="form-control dropdown_i" name="update_housoukubun" id="">
                                        @foreach($housoukubun_dropdown as $value=>$option)
                                        <option value="{{ $value }}" @if($salesInquiryFirstPart[0]->housoukubun==$value) {{ " selected" }}@endif>{{ $option }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    @else
                                    <?php $housoukubun=""; ?>
                                    @foreach($housoukubun_dropdown as $value=>$option)
                                       @if($salesInquiryFirstPart[0]->housoukubun==$value)
                                       <?php $housoukubun = $option; ?>
                                       @endif
                                    @endforeach
                                    <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->name2 }}" readonly="">
                                    @endif


                                   <div style="width: 50%">
                                    <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->name2 }}" readonly style="border-top-left-radius: 0px !important; border-bottom-left-radius: 0px !important;">
                                  </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求課税区分</td>
                                <td style=" border: none!important;">
                                  <input type="text" class="form-control" placeholder="" value="{{ $salesInquiryFirstPart[0]->category_new }}" readonly style="width: 50%;">
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="mr-3">
                          <table class="table custom-form" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style=" border: none!important;width: 60px!important;">売上→会計</td>
                                <td style=" border: none!important;width: 79px;">
                                  <?php $dataint_val = "";?>
                                  @foreach($dataint_dropdown['dataint03'] as $value=>$option)
                                  <?php if($salesInquiryFirstPart[0]->dataint03==$value){$dataint_val = $option;} ?>
                                  @endforeach
                                  <input type="text" class="form-control" value="{{$dataint_val}}" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 60px!important;">指定納品書</td>
                                <td style=" border: none!important;width: 79px;">
                                  <?php $dataint_val2 = "";?>
                                  @foreach($dataint_dropdown['dataint07'] as $value=>$option)
                                  <?php if($salesInquiryFirstPart[0]->dataint07==$value){$dataint_val2 = $option;} ?>
                                  @endforeach
                                  <input type="text" class="form-control" value="{{$dataint_val2}}" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 60px!important;">請求書メール</td>
                                <td style=" border: none!important;width: 79px;">
                                  <?php $dataint_val3 = "";?>
                                  @foreach($dataint_dropdown['dataint08'] as $value=>$option)
                                  <?php if($salesInquiryFirstPart[0]->dataint08==$value){$dataint_val3 = $option;} ?>
                                  @endforeach
                                  <input type="text" class="form-control" value="{{$dataint_val3}}" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 60px!important;">入金</td>
                                <td style=" border: none!important;width: 79px;">
                                  <?php $dataint_val4 = "";?>
                                  @foreach($dataint_dropdown['dataint01'] as $value=>$option)
                                  <?php if($salesInquiryFirstPart[0]->dataint01==$value){$dataint_val4 = $option;} ?>
                                  @endforeach
                                  <input type="text" class="form-control" value="{{$dataint_val4}}" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="ml-3 mr-3">
                      <table class="table mt-2 custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 89px!important;">伝票備考</td>
                              <td style=" border: none!important;width: 480px;">
                                <input type="text" class="form-control" value="{{ $salesInquiryFirstPart[0]->information8 }}" readonly style="font-size: 11.1px !important;">
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3">
                      <table class="table mt-2 custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;padding-left: 2px!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 77px!important;">社内備考</td>
                              <td style=" border: none!important;width: 506px">
                                <input type="text" class="form-control" value="{{ $salesInquiryFirstPart[0]->information7 }}" readonly style="font-size: 10.8px !important;">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
                      <table class="table custom-form" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">販売金額計</td>
                            <td style=" border: none!important;width: 15px!important;"></td>
                            <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
                              @if(isset($salesInquiryFirstPart[0]->money10))
                            {{"¥ ".number_format($salesInquiryFirstPart[0]->money10)}}
                            @endif
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Content head bottm section end -->
              </div>
            </div>
          </div>
        </div>
        <!-- Content head section end -->
</form>

<script>
// function updateStatus(){
//   document.getElementById("changeStatus").value = 1;
// }
</script>
