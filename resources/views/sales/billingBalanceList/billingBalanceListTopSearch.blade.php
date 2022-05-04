<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
  <form id="firstSearch" action="{{ route('billingBalanceList') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="source" value="billingBalanceList"/>
        @csrf

      {{-- Success Message Starts Here --}}
      @if(Session::has('success_msg'))
      <div class="row success-msg-box" id="session_msg" style="position: relative; z-index: 1;" >
        <div class="col-12">
          <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
            &times;</button>
            <strong>{{session()->pull('success_msg') }}</strong>
          </div>
        </div>
      </div>
      @endif
      {{-- Success Message Ends Here --}}

    <script>
      // Focus on Alert Closing
      $(".dismissMe").keydown(function(e) {
          if (e.shiftKey && e.which == 13) {
              $('.close').alert('close');
              event.preventDefault();
              document.getElementById("categorikanri").click();
              $('#categorikanri').focus();
          }
      });
  
      var lastday = function(y,m){
          return  new Date(y, m +1, 0).getDate();
      }

     $(document).ready(function(){
     $("#categorykanri").change(function(){
         const d = new Date();
         var fullYear = d.getFullYear();
         var month = d.getMonth()+1;
         if(month<10){
           month = '0'+month;
         }
         var lastDay = lastday(fullYear,month-1);
         var getValue =$("#categorykanri").val().substr(2,2);
         if(getValue == '31'){
          $("#print_date").val(fullYear+'/'+month+'/'+lastDay);
         }
         else{
          $("#print_date").val(fullYear+'/'+month+'/'+getValue);
         }
  });
});
    </script>
  
    {{-- Error Message Starts Here --}}
    <div class="row">
        <div class="col-12">
          <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
         @if(isset($exceedUser))
              <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
          @endif
        </div>
      </div>
    {{-- Error Message Ends Here --}}

    <div class="row billing_balance_list_top">
      <div class="col">
        <div class="content-head-top ">

          <div class="row" style="padding-top: 0px;">
            <div class="col-4">
              <table class="table custom-form"
                style="border: none!important;width: auto;margin-bottom: 2px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style="border: none!important;width: 88px!important;">締め日</td>
                    <td style="border: none!important;width: 178px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="categorykanri" id="categorykanri" autofocus>
                            <!-- <option value="">-</option>    
                             @foreach($categorykanri as $val)
                              <option value="{{$val->category1.$val->category2}}"
                              @if(isset($fsReqData['categorykanri']))@if($fsReqData['categorykanri']==$val->
                              category1.$val->category2) selected @endif
                              @endif >{{substr($val->category2,-2,2).' '.$val->category4}}
                            </option>
                            @endforeach  -->

                            @foreach($categorykanri as $val)
                                @if(isset($fsReqData['categorykanri']))
                                  <option value="{{$val->category1.$val->category2}}" @if(isset($fsReqData['categorykanri']) && $val->category1.$val->category2==$fsReqData['categorykanri']){{'selected'}}@endif >
                                    {{substr($val->category2,-2,2)." ".$val->category4}}
                                  </option>
                                @else
                                    @if(isset($fsReqData)  && count($fsReqData)>0))
                                        <option value="{{$val->category1.$val->category2}}">
                                          {{substr($val->category2,-2,2)." ".$val->category4}}
                                        </option>
                                    @else
                                        <option value="{{$val->category1.$val->category2}}" >
                                          {{substr($val->category2,-2,2)." ".$val->category4}}
                                        </option>
                                    @endif
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

          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td
                      style="padding-left: 0px !important;border: none!important;text-align: left;color: black;width: 112px !important;">
                      <div class="line-icon-box float-left" style="margin-right: 14px;"></div>
                      請求日
                    </td>
                    <td style="border: none!important;width: 178px;">
                      <div class="input-group">
                        @php
                          $selectedDate10 = date("Y/m/10");   
                        @endphp
                          
                            <input type="text" name="print_date" id="print_date" class="form-control datePicker datePicker1_1" autocomplete="off"
                              @if(isset($fsReqData['print_date'])) value="{{$fsReqData['print_date']}}" @else
                              value="{{$selectedDate10}}" @endif placeholder="年/月/日"
                              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                              maxlength="10" autofocus>
                            <input type="hidden" class="datePickerHidden">

                            </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table custom-form"
                style="margin-bottom:4px !important; width: auto; min-width: 1222px;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;border:0!important;padding-left: 0px !important;">
                      <div class="line-icon-box" style="background: #353A81;"></div>
                    </td>
                    <td style="width: 86px!important;border: none!important;text-align: left;color: black;">
                      売上請求先
                    </td>
                    <!-- <td style="border: none!important;">
                      <div style="width: 100%;">
                        <div class="input-group input-group-sm">
                          <input type="text" tabindex="0" name="sales_Billing_From"  id="sales_Billing_From" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding: 0!important;" value="売上請求先">
                          <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                            <a class="input-group-text btn" tabindex="0" style="cursor: pointer;"><i
                                class="fas fa-arrow-left" style="color: #fff"></i></a>
                          </div>
                        </div>
                      </div>
                    </td> -->
                    <td style="border: none!important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="sales_Billing_From" name="sales_Billing_From" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding-left: 0px !important;"
                            value="{{isset($fsReqData['sales_Billing_From'])&& count($fsReqData)>0? $fsReqData['sales_Billing_From'] : null}}">
                          <input type="hidden" id="sales_Billing_From_db" name="sales_Billing_From_db"
                            value="{{isset($fsReqData['sales_Billing_From_db'])&& count($fsReqData)>0? $fsReqData['sales_Billing_From_db'] : null}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn"
                              onclick="supplierSelectionModalOpener_2('sales_Billing_From','sales_Billing_From_db','1','nullable','r16cd',event.preventDefault())"
                              style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></button>
                          </div>
                        </div>
                      </td>
                    <td
                      style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <!-- <td style=" border: none!important;">
                      <div style="width: 100%;">
                        <div class="input-group input-group-sm">
                          <input type="text" tabindex="0" name="sales_Billing_To"  id="sales_Billing_To" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding: 0!important;" value="売上請求先">
                          <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                            <a class="input-group-text btn" tabindex="0" style="cursor: pointer;"><i
                                class="fas fa-arrow-left" style="color: #fff"></i></a>
                          </div>
                        </div>
                      </div>
                    </td> -->
                    <td style="border: none!important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="sales_Billing_To" name="sales_Billing_To" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding-left: 0px !important;"
                            value="{{isset($fsReqData['sales_Billing_To'])&& count($fsReqData)>0? $fsReqData['sales_Billing_To'] : null}}">
                          <input type="hidden" id="sales_Billing_To_db" name="sales_Billing_To_db"
                            value="{{isset($fsReqData['sales_Billing_To_db'])&& count($fsReqData)>0? $fsReqData['sales_Billing_To_db'] : null}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn"
                              onclick="supplierSelectionModalOpener_2('sales_Billing_To','sales_Billing_To_db','1','nullable','r16cd',event.preventDefault())"
                              style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></button>
                          </div>
                        </div>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="content-head-top" style="margin-bottom: 7px;">
          <div class="row mb-4 mt-4">
            <div class="col-8">
             
            </div>
            <div class="col-4">
              <!-- <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
                <tbody>
                  <tr>
                    <td style=" border: none!important;padding: 0px!important;">
                      <a type="button" id="customprogress" onclick="firstSearch('{{route('billingBalanceList')}}',event.preventDefault())" href="#" class="btn btn-info uskc-button">表示</a>
                    </td>
                    <td style="border: none !important;">
                      <div class="progress"
                        style="width: 348px; float: right;position: absolute;right: 15px;bottom: -21px; display: none;">
                        <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary"
                          role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table> -->
              <div class="d-inline-block float-right">
                    <button onclick="firstSearch('{{route('billingBalanceList')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
    </form>
</div>