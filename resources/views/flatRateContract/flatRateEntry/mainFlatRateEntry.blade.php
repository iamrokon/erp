@section('title', '定期定額契約入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '定期定額契約 >')
@section('menu-test5', '定期定額契約入力')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>
  @include('layouts.header')
</head>

@include('flatRateContract.flatRateEntry.styles')

<body class="common-nav" style="overflow-x:visible;">

<!-- preloader start here -->
<div class="preloader">
  <div class="loading" style="display: none"></div>
</div>
<!-- preloader end here -->
  <section class="">
    @include('layout.nav_fixed')
    <form id="insertData" enctype="multipart/form-data">
        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
          <div class="content-head-section">
            <div class="container position-relative">
                
                {{-- Success Message Starts Here --}}
                @if(Session::has('success_msg'))
                <div class="row success-msg-box">
                  <div class="col-12 pl-0 pr-0 ml-3">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus onclick="$('#reg_datatxt0112').focus();">&times;</button>
                      <strong>{{session()->get('success_msg')}}</strong>
                    </div>
                  </div>
                </div>
                @endif
                {{-- Success Message Ends Here --}}

                {{-- Error Message Starts Here --}}
                <div id="error_data" class="common_error"></div>
                {{-- Error Message Ends Here --}}

                <div id="error_data2" class="common_error"></div>
                
                <script>
                  // Focus on Alert Closing
                  $(".dismissMe").keydown(function(e) {
                    if (e.shiftKey && e.which == 13) {
                      $('.close').alert('close');
                      event.preventDefault();
                      document.getElementById("reg_datatxt0112").click();
                      $('#reg_datatxt0112').focus();
                    }
                  });
                </script>

              <!-- hidden fields -->
              <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
              <input type="hidden" name="bango" id="userId" value="{{$bango}}">
              <input type="hidden" name="bango" id="flatRateNumber" value="{{$flat_rate_number}}">
              <input id='submit_confirmation' value='' type='hidden'/>
              <input id='first_validation' value='' type='hidden'/>
              <input id='page_name' value='flatRateEntry' type='hidden'/>
              <input id='compare_contact_period' value='{{$compare_contact_period}}' type='hidden'/>

              <!-- request table data, used in line.js -->
              <script>
                var datachar24 = '{{$juchusyukko_datachar24[0]->jouhou}}';
                var datachar25 = '{{$juchusyukko_datachar25[0]->jouhou}}';
                var datachar26 = '{{$juchusyukko_datachar26[0]->jouhou}}';
              </script>              

              <div class="row order_entry_topcontent flat-rate-content">
                <div class="col">
            
                  <div class="content-head-top" style="margin-bottom:0px;border-bottom:0px;">
                    <div class="row">
                      <div class="ml-3 mr-3" style="width: 305px;">
                        <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 110px!important;padding:1px !important;">定期サブスク区分</td>
                              <td style=" border: none!important;width: 185px;">
                                <div class="custom-arrow">
                                  <select name='datatxt0112' id='reg_datatxt0112' class="form-control" autofocus>
                                    @foreach($datatxt0112Data as $datatxt0112Dt)
                                        <option value="{{$datatxt0112Dt->category2}}" @if($datatxt0112Dt->category2 == 10) selected @endif>
                                          {{$datatxt0112Dt->category2." ".$datatxt0112Dt->category4}}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="ml-3 mr-3">
                        <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 53px!important;">作成区分</td>
                              <td style=" border: none!important;width: 178px">
                                <div class="custom-arrow">
                                    <select name="datatxt0111" id='reg_datatxt0111' class="form-control" autofocus>
                                        @foreach($datatxt0111 as $dttxt0111)
                                            <option value="{{$dttxt0111->syouhinbango}}">
                                              {{$dttxt0111->syouhinbango.' '}}{{$dttxt0111->jouhou}}
                                            </option>
                                        @endforeach
                                  </select>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="ml-3 mr-3">
                        <table class="table custom-form custom-table"
                          style="border: none!important;width: 100% !important;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 77px!important;">番号検索</td>
                              <td style=" border: none!important; min-width: 179px!important;">
                                <div style="width: 100% !important;">
                                  <div class="input-group input-group-sm position-relative" id="contract_number_grp">
                                    <input id="temp_datatxt0110" type="text" class="form-control" maxlength="10" placeholder="" style="width: 126px!important;background: white;" autocomplete="off">
                                    <div class="input-group-append" data-toggle=""
                                      data-target="">
                                      <button disabled class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                                  </div>
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
                              <td style=" border: none!important;width: 53px!important;">定期定額契約番号</td>
                              <td style=" border: none!important;width: 178px;">
                                <!-- <div style="width: 269px !important"> -->
                                <input name="orderhenkan_bango" id="orderhenkan_bango" type="hidden"/>
                                <input type="text" name="datatxt0110" id="reg_datatxt0110" class="form-control" placeholder="" readonly>
                                <!-- </div> -->
                              </td>
                              <td style=" border: none!important;width: 50px;">
                                  <input type="text" name="numeric5" id="reg_numeric5" value="1" class="form-control" placeholder="" readonly>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                    <div class="ml-3 mr-3">
                    <div class="row">
                      <div class="ml-3 mr-3">
                            <table class="table custom-form" style="width: auto;">
                                <tbody>
                                    <tr>
                                       <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                          <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 79px!important;">元受注番号
                                        </td>
                                        <td style=" border: none!important;width: 202px!important;">
                                            <input name="datatxt0113" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" id="reg_datatxt0113" type="text" class="form-control" placeholder="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3" style="width: 138px;">
                          <table class="table custom-form">
                                  <tbody>
                                      <tr>
                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 15px!important;">行
                                        </td>
                                        <td style=" border: none!important;width: 65px;">
                                              <input name="numeric6" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" id='reg_numeric6' type="text" class="form-control" placeholder="">
                                        </td>
                                      </tr>
                                  </tbody>
                              </table>
                        </div>
                        <div class="ml-3 mr-3" style="width: 139px;">
                          <table class="table custom-form custom-table">
                                  <tbody>
                                      <tr>
                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 15px!important;">枝
                                        </td>
                                        <td style=" border: none!important;width: 65px;">
                                              <input name="numeric7" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" id='reg_numeric7' type="text" class="form-control" placeholder="">
                                        </td>
                                      </tr>
                                  </tbody>
                              </table>
                        </div>
                         </div>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form">
                                <tbody>
                                    <tr>
                                       <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                          <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 76px!important;">契約状態
                                        </td>
                                        <td style=" border: none!important;width: 178px;">
                                            <input name="datatxt0122" id='reg_datatxt0122' value="{{$datatxt0122->category2.' '.$datatxt0122->category4}}" type="text" class="form-control" placeholder="" readonly="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">

                        </div>
                    </div>
                    <div class="row">
                      <div class="ml-3 mr-3">
                        <table class="table custom-form custom-table-1" style="border: none!important;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 79px!important;">売上請求先</td>
                              <td style=" border: none!important;width: 541px!important;">
                                <div class="input-group input-group-sm custom_modal_input" id="information2_input_group">
                                  <input name='db_information2' id='reg_db_information2' type="hidden" class="form-control" readonly >
                                  <input name='information2' id='reg_information2' type="text" class="form-control" placeholder="売上請求先" readonly style="max-width:507px!important;">
                                  <div class="input-group-append">
                                      <button onclick="supplierSelectionModalOpener('reg_information2','reg_db_information2','1','required','r17_3cd',1,event.preventDefault())" id="supplierButton1" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width:79px!important;">受注先</td>
                              <td style=" border: none!important;width: 541px!important;">
                                <div class="input-group input-group-sm custom_modal_input" id="information1_input_group">
                                  <input name='db_information1' id='reg_db_information1' type="hidden" class="form-control" readonly>
                                  <input name='information1' id='reg_information1' type="text" class="form-control" placeholder="受注先" readonly style="max-width:507px!important;" >
                                  <div class="input-group-append" >
                                    <button onclick="supplierSelectionModalOpener('reg_information1','reg_db_information1','1','required','r17_3cd',1,event.preventDefault())" id="supplierButton2" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 79px!important;">最終顧客</td>
                              <td style=" border: none!important;width: 541px!important;">
                                <div class="input-group input-group-sm custom_modal_input" id="information3_input_group">
                                  <input name='db_information3' id='reg_db_information3' type="hidden" class="form-control" readonly>
                                  <input name='information3' id='reg_information3' type="text" class="form-control" placeholder="最終顧客" readonly style="max-width:507px!important;" >
                                  <div class="input-group-append" >
                                    <button onclick="supplierSelectionModalOpener('reg_information3','reg_db_information3','0','required','r17_3cd',event.preventDefault())" id="supplierButton3" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                  </div>
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
                              <td style=" border: none!important;width: 78px!important;">請求書送付先</td>
                              <td style=" border: none!important;width: 82%;">
                                <div class="input-group input-group-sm custom_modal_input" id="information6_input_group">
                                  <input name='db_information6' id='reg_db_information6' type="hidden" class="form-control" readonly>
                                  <input name='information6' id='reg_information6' type="text" class="form-control" placeholder="請求書送付先" readonly style="max-width:507px!important;">
                                  <div class="input-group-append">
                                    <button onclick="supplierSelectionModalOpener('reg_information6','reg_db_information6','0','required','r17_3cd',event.preventDefault())" id="supplierButton4" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 78px!important;">PJ</td>
                              <td style=" border: none!important;width: 82%;">
                                <div class="custom-arrow" style="width: 100%">
                                  <select name="datatxt0129" id="reg_datatxt0129" class="form-control" autofocus="">
                                      <option value="">プロジェクトを選択してください</option>
                                  </select>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 78px!important;">文書種類</td>
                              <td style=" border: none!important;width: 82%;">
                                <div class="custom-arrow  " style="width: 100%">
                                    <select name="datatxt0114" id="reg_datatxt0114" class="form-control" autofocus="">
                                        <option value="">選択なし</option>
                                    @foreach($datatxt0114Data as $datatxt0114Dt)
                                        <option value="{{$datatxt0114Dt->category1.$datatxt0114Dt->category2}}">
                                          {{$datatxt0114Dt->category2." ".$datatxt0114Dt->category4}}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="ml-3 mr-3">
                          <table class="table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 79px!important;">担当</td>
                              <td style="border: none!important;width: 202px;">
                                  <div class="custom-arrow">
                                    <select name="datachar05" id="reg_datachar05" class="form-control" autofocus="">
                                        <option value="">選択なし</option>
                                        @foreach($datachar05Info as $dtchar05Info)
                                            <option value="{{$dtchar05Info->bango}}" @if($dtchar05Info->bango == $bango){{'selected'}}@endif>
                                              {{$dtchar05Info->bango." ".$dtchar05Info->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                       
                      <div class="ml-3 mr-3" style="width: 310px;">
                        <table class="table custom-form custom-table custom-inpur-field">
                          <tbody>
                            <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 65px!important;"> 取引条件</td>
                              <td style=" border: none!important;">
                                <div class="input-group input-group-sm" style="cursor: pointer;">
                                  <button id="igroup1" disabled onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:116px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                    取引条件
                                  </button>
                                  <div class="input-group-append">
                                      <button onclick="transactionTermsModalOpener();event.preventDefault();" id="transactionButton" type="button" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                  </div>
                                </div>
                              </td>


                            </tr>
                          </tbody>
                        </table>

                      </div>
                      <div class="mr-3" style="margin-left: 14px !important;">
                      <table class="table custom-form custom-table" style="border: none!important;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 77px!important;">契約書</td>
                              <td style=" border: none!important;">
                                <div class="input-group input-group-sm" style="cursor: pointer;">
                                  <button id="igroup1" disabled onkeydown="stepup(event);" class="btn c_hover" style="color: #fff!important;border:1px solid #4D82C6;width:151px; border-radius: 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                    契約書Excel
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="ml-3 mr-3" style="width: 300px;">
                      <table class="table custom-form" style="border: none!important;">
                          <tbody>
                            <tr>
                            <td style=" border: none!important;min-width: 187px;">
                                <div class="custom-select-file-upload input-group input-group-sm">
                                  <div class="custom-file-area">
                                    <div class="input-group input-group-sm">
                                      <input type="file" accept=".zip,.pdf" class="custom-file-input" id="customFile" name="filename">
                                      <input name="hidden_lbook_bango" id="hidden_lbook_bango" type="hidden"/>
                                      <input name="hidden_filename" id="hidden_filename" type="hidden"/>
                                      <input name="temp_filename" id="temp_filename" type="hidden"/>
                                      <label class="custom-file-label c_hover" for="customFile" id="custom_file_label" style="cursor: pointer;width:189px;margin-right: -2px;background: #4D82C6;color: #fff!important; border: 1px solid #4D82C6;overflow: hidden;">契約書PDFアップロード
                                      </label>
                                      <div class="input-group-append">
                                          <button id="fileUploadClose" type="button" class="input-group-text btn customFileClear" style="padding: 0px 10px !important;cursor: pointer!important;"><i class="fa fa-times" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                  <style type="text/css">
                                    .custom-select-file-upload .custom-file-input:lang(ja)~.custom-file-label::after {
                                      content: "";
                                      background: transparent;
                                    }

                                    .custom-select-file-upload .custom-file-label::after {
                                      border-left: 0px;
                                    }

                                    .custom-select-file-upload .custom-file-label {

                                      color: #fff;
                                      position: relative;
                                      margin-bottom: 0px;
                                      height: 30px;
                                      border: 1px solid #2C66B0;
                                      background: #2C66B0;
                                    }

                                    .custom-select-file-upload .custom-file-label:hover {
                                      background: #398BF7;
                                      border: 1px solid #398BF7;
                                      cursor: pointer !important;
                                    }
                                  </style>
                                </div>
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

          <!-- Flat Rate Contract Details -->
          @include('flatRateContract.flatRateEntry.contractDetails')

          <!-- product modal -->
          @include('flatRateContract.flatRateEntry.product.main')

          <!-- Split Display -->
          @include('flatRateContract.flatRateEntry.line')

          <!-- product_description_detail_page -->
          @include('flatRateContract.flatRateEntry.product_description_detail_page')

          <!-- alert_modal -->
          @include('flatRateContract.flatRateEntry.alert_modal')

          <!-- supplier modal -->
          @include('common.supplierModal')

          <!-- transaction terms modal -->
          @include('flatRateContract.flatRateEntry.transactionTermsModal')

          <!-- maintenance conditions modal -->
          @include('flatRateContract.flatRateEntry.maintenanceConditionsModal')

          <!-- order shipping modal -->
          @include('flatRateContract.flatRateEntry.orderShippingModal')

          {{--File Extension Confirmation Modal Starts Here --}}
          @include('flatRateContract.flatRateEntry.fileExtensionConfirmationModal')
          {{--File Extension Confirmation Modal Ends Here --}}


        </div>
    </form>

  </section>
  @include('layout.footer_new')

  <script src="{{asset('js/moment.min.js')}}"></script>

  <!-- Hard reload js link starts here -->

   {{-- common.js link include starts here --}}
   @include('layouts.common_js')
   {{-- common.js link include ends here --}}
  
  <script type="text/javascript">
    var commonFlatRateEntryLink = document.createElement("script");
      commonFlatRateEntryLink.type = "text/javascript";
      commonFlatRateEntryLink.src = "{{ asset('js/flatRateContract/flatRateEntry/common_flat_rate_entry.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(commonFlatRateEntryLink);
  </script>
  <script type="text/javascript">
    var flatRateEntryLink = document.createElement("script");
      flatRateEntryLink.type = "text/javascript";
      flatRateEntryLink.src = "{{ asset('js/flatRateContract/flatRateEntry/flat_rate_entry.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(flatRateEntryLink);
  </script>
  <script type="text/javascript">
    var supplierLink = document.createElement("script");
      supplierLink.type = "text/javascript";
      supplierLink.src = "{{ asset('js/flatRateContract/flatRateEntry/supplier.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(supplierLink);
  </script>
  <script type="text/javascript">
    var productLink = document.createElement("script");
      productLink.type = "text/javascript";
      productLink.src = "{{ asset('js/flatRateContract/flatRateEntry/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(productLink);
  </script>
  <script type="text/javascript">
    var lineLink = document.createElement("script");
      lineLink.type = "text/javascript";
      lineLink.src = "{{ asset('js/flatRateContract/flatRateEntry/line.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(lineLink);
  </script>
  <script type="text/javascript">
    var productDescriptionDetailLink = document.createElement("script");
      productDescriptionDetailLink.type = "text/javascript";
      productDescriptionDetailLink.src = "{{ asset('js/flatRateContract/flatRateEntry/product_description_detail.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(productDescriptionDetailLink);
  </script>
  <!-- Hard reload js link ends here -->

    <script>
    // for table header settings lat input to first input focusing
    function stepup(event) {
      if (event.keyCode == 13) {
        $("#ignoreButton").focus();
        event.preventDefault();

      }
    }


    function focusNextInput(event) {
      if (event.keyCode == 13) {
        $("#reg_numeric9").focus();
        event.preventDefault();
      }
    }
  </script>
  <script type="text/javascript">
    $(function () {
      $('.show_personal_master_info').click(function () {
        // e.preventDefault();
        $(".tabledataModal6").addClass('intro');
        //$(this).css('border', "solid 2px red");
        $("#product_sub_content2").show();
        // $(this).closest('td').find("#office_master_content_div").toggle();
      });
    });

  </script>
  <script type="text/javascript">
    $("#pr_sub_choice_button").click(function () {


      $("#initial_content_product_sub").hide();
      $("#product_sub_content2").hide();
      $("#personal_master_content_div").hide();
      $("#office_content_div_last").hide();
      if ($(".show_office_master_info").hasClass("add_border")) {
        $(".show_office_master_info").removeClass('add_border');
      }

      if ($(".show_personal_master_info").hasClass("add_border")) {
        $(".show_personal_master_info").removeClass('add_border');
      }
      if ($(".show_content_last").hasClass("add_border")) {
        $(".show_content_last").removeClass('add_border');
      }


    });

  </script>

  @include('layout.bottom_link')


  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  <script>
    // Enter key press auto focus next input......
    ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
          var self = $(this),
            form = $(element),
            focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            focusable = form.find('input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
            // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
            var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
            next = focusable.eq(nextIndex);
            next.focus();
            return false;
          }
          if (e.keyCode == 9) {
            e.preventDefault();
          }
        });
      }
    };
    ko.applyBindings({});
  </script>

<script>
  ko.bindingHandlers.nextFieldOnEnter = {
       init: function(element, valueAccessor, allBindingsAccessor) {
           $(element).on('keydown', '.trfocus', function(e) {
               var self = $(this),
                   form = $(element),
                   focusable, next;

               if (e.keyCode == 13 && !e.shiftKey) {
                   focusable = form.find('.trfocus').filter(':visible');
                   var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                   next = focusable.eq(nextIndex);
                   next.find('.trfocus').addClass('rowSelect').focus();
                   // $(this).click();
                   return false;
               }
               if (e.keyCode == 13 && e.shiftKey) {
                   // alert('hello');
                   var rowSelect2 = $('.rowSelect');
                   $(this).trigger('click');

               }
           });
       }
   };
   ko.applyBindings({});
</script>          
  {{-- Knockout - Enter to New Input Ends Here --}}


  <script>
    // $(document).on("shown.bs.modal", function (e) {


    // Date Picker Initialization
    $('#datepicker1_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
          $('#datepicker2_oen').val(datevalue);
          $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
          $('#datepicker2_oen').datepicker('update');
          $('#datepicker2_oen').val('');
        }
        else{
          $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
          $('#datepicker2_oen').datepicker('update');
        }
      }
    });

    $('#datepicker1_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
        $('#datepicker2_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker1_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#datepicker1_oen').on('click', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $('#datepicker2_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker2_oen',
      startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker2_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker2_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#datepicker2_oen').on('click', function () {
      $(this).datepicker('hide');
    });



    //Enter press hide dropdown...
    $("#datepicker1_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker1_oen").datepicker('hide');
      }
    });
    $("#datepicker2_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker2_oen").datepicker('hide');
      }
    });



    $('#datepicker3_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker3_oen'
    });

    $('#datepicker3_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
          $('#datepicker4_oen').val(datevalue);
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
          $('#datepicker4_oen').val('');
        }
        else{
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
        }
      }
    });

    $('#datepicker3_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        $('#datepicker4_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker3_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#datepicker3_oen').on('click', function () {
      $(this).datepicker('hide');
    });

    $('#datepicker4_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker4_oen',
      startDate: $('#datepicker3_oen').datepicker('getDate')
    });

    $('#datepicker4_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker4_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker4_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#datepicker3_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker3_oen").datepicker('hide');
      }
    });
    $("#datepicker4_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker4_oen").datepicker('hide');
      }
    });
    // datepicker 5,6

    $('#datepicker5_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker5_oen'
    });

    $('#datepicker5_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker6_oen').val().replaceAll('/', '')){
          $('#datepicker6_oen').val(datevalue);
          $('#datepicker6_oen').datepicker('setStartDate', $('#datepicker5_oen').datepicker('getDate'));
          $('#datepicker6_oen').datepicker('update');
          $('#datepicker6_oen').val('');
        }
        else{
          $('#datepicker6_oen').datepicker('setStartDate', $('#datepicker5_oen').datepicker('getDate'));
          $('#datepicker6_oen').datepicker('update');
        }
      }
    });

    $('#datepicker5_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        $('#datepicker4_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker5_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#datepicker6_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker6_oen',
      startDate: $('#datepicker5_oen').datepicker('getDate')
    });

    $('#datepicker6_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker6_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker6_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#datepicker5_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker5_oen").datepicker('hide');
      }
    });
    $("#datepicker6_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker6_oen").datepicker('hide');
      }
    });

    // datepicker 7,8
    $('#datepicker7_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker7_oen'
    });

    $('#datepicker7_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker8_oen').val().replaceAll('/', '')){
          $('#datepicker8_oen').val(datevalue);
          $('#datepicker8_oen').datepicker('setStartDate', $('#datepicker7_oen').datepicker('getDate'));
          $('#datepicker8_oen').datepicker('update');
          $('#datepicker8_oen').val('');
        }
        else{
          $('#datepicker8_oen').datepicker('setStartDate', $('#datepicker7_oen').datepicker('getDate'));
          $('#datepicker8_oen').datepicker('update');
        }
      }
    });

    $('#datepicker7_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        // $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        // $('#datepicker4_oen').datepicker('update');
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker7_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#datepicker8_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker8_oen',
      startDate: $('#datepicker7_oen').datepicker('getDate')
    });

    $('#datepicker8_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker8_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker8_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#datepicker7_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker7_oen").datepicker('hide');
      }
    });
    $("#datepicker8_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker8_oen").datepicker('hide');
      }
    });

    // datepicker reg_date0003
    $('#reg_date0003').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#reg_date0003'
    });

    $('#reg_date0003').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#reg_date0003').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        // $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        // $('#datepicker4_oen').datepicker('update');
        $(this).datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#reg_date0003').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#reg_date0003").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#reg_date0003").datepicker('hide');
      }
    });


  // });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#closetopcontent").click(function () {
        $(".order_entry_topcontent").toggle();
        $('.content-bottom-section').css('margin-top', 38);
      });
    });
    function contentHideShow() {
      var hideShow = document.getElementById("closetopcontent");
      if (hideShow.innerHTML === "閉じる") {
        hideShow.innerHTML = "開く";
      } else {
        hideShow.innerHTML = "閉じる";
      }
    }
  </script>
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $("#datepicker1_oen").datepicker('hide');
      $("#datepicker2_oen").datepicker('hide');
      $("#datepicker3_oen").datepicker('hide');
      $("#reg_date0003").datepicker('hide');
    });
  </script>
  <script type="text/javascript">
    $("#modalarea").on('click', function () {
      $(".modal-backdrop").addClass("overflow_cls");
      // $('.modal-backdrop').remove();
    });

    $("#modalarea").on("click", function () {
      $('.modal-backdrop').remove();
      $('#modalarea').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
      })
      $('#modalarea').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
      $("#modalarea").modal("hide");
    });
  </script>

  {{-- Custom File JS --}}
  <script>
    $(function() {
      $(".custom-file-input").on("change", function (e) {
          let oldFileName = $(this).val();
          // let fileName = $(this).val().split("\\").pop();
          let fileName = e.target.files[0].name;
          let fileExtension = $(this).val().split(".").pop().toLowerCase();
          // if(fileExtension == "pdf" || fileExtension == "zip"){
          if(fileExtension == "pdf" || fileExtension == "zip"){
            if(fileName.length >= 15){
              // alert('More than 11');
              let slicedFileName = fileName.slice(0, 10);
              let updatedFileName = slicedFileName + "..." + fileExtension;
              $(this).siblings(".custom-file-label").addClass("selected").html(updatedFileName);
              // console.log("Sliced File Name" + updatedFileName);
            }
            else if(fileName.length <= 14){
              // alert('More than 11');
              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              // console.log("Sliced File Name" + updatedFileName);
            }
          }
          else {
          // alert('Only .pdf and .zip format allowed.');
            $("#fileExtensionConfirmationModal").modal('show');
          }
        // alert('File Name: ' + fileName);

      });

      $(".customFileClear").on("click", function () {
        $(this).parent('.input-group-append').siblings(".custom-file-label").html('検収確認書PDFアップロード');
      });
    });
  </script>
     <script>
      //Modal first field focus....
      $(document).on('shown.bs.modal', function(e) {
         $('[autofocus]', e.target).focus();
       });
   </script>
</body>

</html>
