@section('title', '内作調整入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', 'サポート >')
@section('menu-test5', '内作調整入力')
@section('tag-test', 'ここは、ガイドの文章が入ります。')


<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Starts Here --}}
@include('layouts.header')
{{-- Including Common Header Ends Here--}}
</head>

@include('support.inhouseEntry.styles')

<body class="common-nav" style="overflow-x:visible;">
  <section>
    @include('layout.nav_fixed')
    
    <form id="mainForm" action="{{ route('inhouseEntry') }}" method="post">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
    <input id='submit_confirmation' value='' type='hidden'/>
    <input id='max_minyuko_syouhinsyu' type='hidden'/>
    <input id='total_parent' type='hidden'/>
    <input id='count_deleted_parent' value="0" type='hidden'/>
    <input name="minyuko_bango" id='minyuko_bango' type='hidden'/>
    <input id='review_orderbango' value="{{$review_orderbango}}" type='hidden'/>
         
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section">
        <div class="container position-relative">
        {{-- Success Message Starts Here --}}
        <!-- Show Success Message -->
                @if(Session::has('success_msg'))
                @php
                $success_msg = session()->get('success_msg');
                @endphp
                <div id="update-success-msg" class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
                  <div class="col-12">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" autofocus
                      onclick="$('#number_search').focus();">&times;</button>
                      
                      <strong>{{$success_msg}}</strong><br>
                  
                    </div>
                  </div>
                </div>
                @endif
      {{-- Success Message Ends Here --}}
      
      {{-- Error Message Starts Here --}}
      <div id="error_data" class="common_error"></div>
      {{-- Error Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error d-none"> error Message</div>
      {{-- Error Message Ends Here --}}
      
          <div class="row order_entry_topcontent inhouse_entry">
            <div class="col">
              <div class="content-head-top">

                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form"
                      style="border: none!important;width: auto;margin-bottom:4px !important">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 80px!important;">番号検索</td>
                          <td style=" border: none!important;width: 178px">
                            <div style="width: 100%;">
                              <div class="input-group input-group-sm position-relative">
                                <input name="number_search" id="number_search" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                  type="text" class="form-control" placeholder="番号検索" 
                                  style="padding: 0!important;">
                                <div class="input-group-append" id="modalarea"
                                  style="margin-left: 0px!important;">
                                  <button type="button" onclick="numberSearchModalOpener('number_search',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row" style="padding-top: 0px;">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="margin-bottom: 2px!important; width: auto;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important; text-align: left; color: black;width: 103px !important; padding-left: 0px !important;">
                            <div class="line-icon-box float-left mr-3"></div>受注先
                          </td>
                          <td style="border: none!important; width: 320px;">
						    <input type="hidden" name="information1" id="information1" />
                            <input type="text" id="information1_detail" class="form-control" readonly placeholder="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="margin-bottom: 2px!important; width: auto;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>最終顧客
                          </td>
                          <td style="border: none!important; width: 320px;">
						    <input type="hidden" name="information3" id="information3" />
                            <input type="text" id="information3_detail" class="form-control" readonly placeholder="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row" style="padding-top: 2px;">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 103px !important; padding-left: 0px !important;">
                            <div class="line-icon-box float-left mr-3"></div>受注番号
                          </td>
                          <td style="border: none!important; width: 200px;">
                            <input type="text" name="orderuserbango" id="orderuserbango" class="form-control" readonly placeholder="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>受注日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input name="intorder01" id="intorder01" type="text" class="form-control" readonly
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 103px !important;">
                            <div class="line-icon-box float-left mr-3"></div>受注担当
                          </td>
                          <td style="border: none!important;width: 155px !important; ">
                            <input type="text" name="datachar09" id="datachar09" class="form-control" readonly placeholder="受注担当">
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
        <div class="container">
              <div class="row">
                  <div class=" ml-3 mr-3 d-flex  w-100 justify-content-end" style="background-color: #fff;">
                    <div>
                      <table class="table custom-form" style="border: none!important;width:auto;">
                        <tbody>
                          <tr style="height: 28px;">
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td
                              style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                              SE金額計</td>
                            <td style=" border: none!important;width: 15px!important;"></td>
                            <td
                              style=" border: none!important;min-width: 100px;color: #000;font-weight: bold;font-size: 0.9em;">
			     <input type="hidden" name="sum_of_minyuko_syouhizeiritu_se" id="hidden_sum_of_minyuko_syouhizeiritu_se"/>
			     <input type="hidden" name="patternsub2" id="patternsub2" value="{{$patternsub2}}"/>
			     <input type="hidden" name="minyuko_syouhizeiritu_limit" id="minyuko_syouhizeiritu_limit"/>
			     <input type="hidden" name="se_checking_amount" id="se_checking_amount"/>
			     <input type="hidden" name="sum_of_205" id="sum_of_205"/>
                              <span id="sum_of_minyuko_syouhizeiritu_se"></span></td>
                              
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
               </div>
          </div>
        <div class="content-bottom-section" style="padding-bottom:46px;">
          <div class="content-bottom-top">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    内作調整明細
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content-bottom-bottom">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
                    <div class="table-responsive largeTable">
                      <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                        style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                          <tr>
                            <th scope="col" class="signbtn"> <span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">数量</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">発注金額分類</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">担当</span>
                            </th>
                            <th scope="col" class="signbtn"><span
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">仕入先</span>
                            </th>
                           
                          </tr>
                        </thead>
			<tbody id="order_details">
                        @include('support.inhouseEntry.adjustmentDetails')
			</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="content-head-bottom">
                <div class="row d-flex justify-content-end" style="margin-right: 0px;">
                  <div class="ml-3 mt-2 ">
                    <div class="form-button" style="height: 50px;">
                  <div style="background-color: #fff;" >
                    <table class="table custom-form" style="border: none!important;width:auto;">
                      <tbody>
                        <tr style="height: 28px;">
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td
                            style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                            金額計</td>
                          <td style=" border: none!important;width: 15px!important;"></td>
                          <td
                            style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
							<input type="hidden" name="sum_of_minyuko_syouhizeiritu" id="hidden_sum_of_minyuko_syouhizeiritu"/>
                            <span id="sum_of_minyuko_syouhizeiritu"></span></td>
                            
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    </div>
                  </div>
                  <div class="ml-3  mt-2 ">
                    <div class="form-button" style="height: 50px;">
                      <button onclick="registerInhouseEntry();event.preventDefault();" id="regButton" disabled href="#" class="btn btn-info uskc-button"
                        style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
    
 {{-- Footer Starts Here --}}
 @include('layout.footer_new')
 {{-- Footer end Here --}}


    <!-- Supplier Modal start here -->
    @include('common.supplierModal')
    <!-- Supplier Modal end here -->

  <!-- Search Modal ends here -->
  @include('support.inhouseEntry.number_search.main')
  
  <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;width:700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header border-bottom-0" style="background: #fff;height:69px;padding:24px 28px;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>商品</strong></h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body square-title pt-0" style="border: 2px solid #fff;padding:0px 30px;"
          data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box">
            <table class="table text-white" id="table-basic" style="margin-bottom:0px !important;">
              <tbody class="">
                <tr style="height: 90px;">
                  <td
                    style="width:128px !important;border-left: 0px !important;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>品目群
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select class="form-control" autofocus>
                        <option value="0">99　NNNNNNNNNNNNNNNNNNNN</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr style="height: 85px;">
                  <td style="border-left: 0px !important;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>製品区分
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select class="form-control">
                        <option value="0">製品区分を選択</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr style="height: 85px;">
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px !important;padding-top: 17px;">
                    <div class="line-icon-box"></div>品目区分
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select class="form-control">
                        <option value="0">品目区分を選択</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr style="height: 85px;">
                  <td style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px;">
                    <div class="line-icon-box"></div>販売形態
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select class="form-control">
                        <option value="0">販売形態を選択</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr style="height: 85px;">
                  <td style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px;">
                    <div class="line-icon-box"></div>バージョン区分
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select class="form-control">
                        <option value="0">バージョン区分を選択</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div>
            <div style="height:81px;padding:32px 0px;">
              <h6 class="text-white">
                <div class="line-icon-box"></div>商品選択（商品CD/商品名）
              </h6>
            </div>
            <div class="scrollbararea" style="height: 184px; overflow-y: scroll; cursor: pointer;">
              <table class="table modal-inner modal-table-white text-dark bg-white"
                style="margin-bottom: 0px !important;">
                <thead class="header text-center" id="myHeader">
                </thead>
                <tbody>
                  <tr class="show_personal_master_info" style="height: 41px;">
                    <td>99999</td>
                    <td>NNNNNNNNNNNNNNNNNNNN</td>
                  </tr>
                  <tr class="show_personal_master_info add_border" style="height: 41px;">
                    <td style="width:50px;">99999</td>
                    <td>NNNNNNNNNNNNNNNNNNNN</td>
                  </tr>

                  <tr class="show_personal_master_info" style="height: 41px;">
                    <td style="width:50px;">99999</td>
                    <td>NNNNNNNNNNNNNNNNNNNN</td>
                  </tr>
                  <tr class="show_personal_master_info" style="height: 41px;">
                    <td style="width:50px;">99999</td>
                    <td>NNNNNNNNNNNNNNNNNNNN</td>
                  </tr>
                  <tr class="show_personal_master_info" style="height: 41px;">
                    <td style="width:50px;">99999</td>
                    <td>NNNNNNNNNNNNNNNNNNNN</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer border-top-0" style="height: 87px;padding:0px !important;">
            <button type="button" id="" class="btn text-white uskc-button bg-default" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="choice_button2" class="btn uskc-button bg-teal text-white ml-2"
              data-dismiss="modal">
              <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->入力する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- Alert message modal start here --}}

<div class="modal custom-data-modal" data-backdrop="static" id="alert_pop_up_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 300px;">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
          <h5 class="modal-title" id="exampleModalLabel"><strong></strong></h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box pl-4 pr-4">
            <table class="table text-white" id="table-basic">
              <tbody class="pl-4 pr-4">
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">

                    <div id="modal_content"> アラートメッセージ </div>
                  </td>
                </tr>
               
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                    <div class="text-center">
                      <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
                       Ok
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            
          </div>
        </div>
      </div>
    </div>
  </div>

{{--  Alert message modal end end here --}}

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  <script type="text/javascript">
    $(document).ready(function(){
      $("#closetopcontent").click(function(){
        $(".order_entry_topcontent").toggle();
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
  
  <script type="text/javascript">
    $("#modalarea").on('click', function(){
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
      });

  $("#modalarea").on("click", function(){
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

  <script type="text/javascript">
    // Date Picker Initialization
  $('.datePicker').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 6,
      trigger: '.datePicker'
    });

    $('.datePicker').on('change focus', function () {
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

    $('.datePicker').on('keyup', function (e) {
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
    $('.datePicker').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
    // Enter hide
    $(".datePicker").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker").datepicker('hide');
      }
    });
  </script>

   <script type="text/javascript">
        var fileorderentry = document.createElement("script");
        fileorderentry.type = "text/javascript";
        fileorderentry.src = "{{ asset('js/support/inhouse_entry/inhouseEntry.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileorderentry);

    </script>

  <!-- script for take only 60 characters in textarea field -->
  <script>
    //file upload show name....
    $(".custom-file-input").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  <script>
    // Knockout
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                    // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }

                // Shift+Enter to select table row
                if (e.keyCode == 13 && e.shiftKey) {
                  var rowSelect2 = $('.rowSelect');
                  $(this).trigger('click');
                }
            });
        }
    };
    ko.applyBindings({});

  </script>
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
    $(".datePicker").datepicker('hide');
  });
  </script>
</body>

</html>