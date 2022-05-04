<form id="registrationForm" action="{{ route('postEditProjectRegistration',[$bango])}}" method="post" data-regmethod="registerProject"
  onsubmit="registerProject('{{route("postEditProjectRegistration",[$bango])}}');event.preventDefault();">
    @csrf
    <input type="hidden" name="type" value="create">
    <div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="registrationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
       <div class="modal-dialog" style="max-width: 600px !important;" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px";>プロジェクト登録</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body custom-form" data-bind="nextFieldOnEnter:true" style="color: #fff;">
             <div class="development_page_top_table heading_mt" style="margin:0px;">
               <!--=======================Modal 2 button start ======================-->
               <div class="row titlebr" style="margin-bottom: 15px;">

                {{-- Error Message Starts Here --}}
                <div id="error_data"></div>
                {{-- Error Message Ends Here --}}

                 <div class="col-lg-12">
                   <div style="display: inline;">
                    <div style="float:left;">
                        <span>処理状況：新規登録</span>
                       </div>
                     <div style="float: right;">
                       <button name="insert" id="regButton" type="submit" class="btn btn-info-custom scroll" autofocus="" style="margin-right: 5px;">
                           <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存
                       </button>
                       <!--  <button type="button" id="btnPrintInsert" class="btn btn-info" data-dismiss="" style="background: #4D82C6 !important;"><i
                         class="fa fa-print" style="margin-right: 7px;">
                         </i>印刷 </button> -->
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <!--======================= modal 1 table start ======================-->
             <div class="row mt-1 mb-3">
               <div class="col-lg-12">
                 <div class="tbl_name">
                   <div class="w-100">
                     <div class="row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             プロジェクト番号<span style="color: red;">※</span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row">
                           <div class="col-sm-4">
                               <input readonly name="url" id="reg_url" type="text" class="form-control">
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class=" row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             プロジェクト名称<span style="color: red;">※</span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row">
                           <div class="col-12">
                             <input name="urlsm" id="reg_urlsm" type="text" class="form-control">
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             受注先<span style="color: red;">※</span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row custom-form">
                           <div class="col-lg-12 col-md-12 col-sm-12 ">
                             <div class="input-group input-group-sm" id="reg_catchsm_gp">
                               <input id="reg_show_catchsm" type="text" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                               <input name="catchsm" id="reg_catchsm" type="hidden" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                               <div class="input-group-append" id="searchBtn">
                                 <button onclick="supplierSelectionModalOpener_3('reg_show_catchsm','reg_catchsm','1','required','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             最終顧客<span style="color: red;"></span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row custom-form">
                           <div class="col-lg-12 col-md-12 col-sm-12 ">
                             <div class="input-group input-group-sm">
                               <input id="reg_show_caption" type="text" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                               <input name="caption" id="reg_caption" type="hidden" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                               <div class="input-group-append" id="searchBtn">
                                 <button onclick="supplierSelectionModalOpener_3('reg_show_caption','reg_caption','0','nullable','address',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class=" row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             営業<span style="color: red;">※</span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row">
                           <div class="col-7 ">
                             <div style="position: relative;">
                               <div class="custom-arrow">
                                 <select name="setumei" id="reg_setumei" class="form-control" readonly="">
                                    <option value="">-</option>
                                    @foreach($setumei as $setmi)
                                        <option value="{{$setmi->bango}}" @if($setmi->bango==$bango){{'selected'}}@endif>
                                          {{$setmi->name}}
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
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             SE<span style="color: red;"></span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row">
                           <div class="col-7 ">
                             <div style="position: relative;">
                               <div class="custom-arrow">
                                 <select name="catch" id="reg_catch" class="form-control" readonly="">
                                   <option value="">-</option>
                                   @foreach($se as $s)
                                        <option value="{{$s->bango}}">
                                          {{$s->name}}
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
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             開始年月～終了年月<span style="color: red;"></span>
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6 col-sm-8">
                         <div class="outer row">
                           <div class="col">
                             <input name="mbcatch" id="reg_mbcatch" type="text" class="form-control" placeholder="年/月" autocomplete="off"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="7" value="<?php echo date('Y/m'); ?>"
                              >
                              <input type="hidden" class="datePickerHidden">
                           </div>
                           <div style="width: 10px;text-align: center;margin-left: -5px;margin-top: 3px;">～</div>
                           <div class="col">
                             <input name="mbcatchsm" id="reg_mbcatchsm" type="text" class="form-control" placeholder="年/月" autocomplete="off"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="7" value="<?php echo date('Y/m'); ?>"
                              >
                              <input type="hidden" class="datePickerHidden">
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class=" row form-group">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                         <div class="mt-1">
                           <div class="line-icon-box"></div>
                             備考<span style="color: red;"></span>
                         </div>
                       </div>
                       <div class="col-lg-8 col-md-8 col-sm-8">
                         <div class="outer row">
                           <div class="col">
                             <textarea name="mbcaption" id="reg_mbcaption" class="form-control" rows="5" col="50" style="width: 100%; height: auto;padding-left: 0px !important;"></textarea>
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
