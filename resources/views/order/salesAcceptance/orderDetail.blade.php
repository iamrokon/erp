@if(isset($result))

@php
$i=isset($serial)?$serial:1;
@endphp
@foreach($result as $value)
 
<div class="row mt-2">
  <div class="col-12">
    <div class="data-wrapper-content gray-box parentClass" style="width: 100%;">
      <div class="data-box-content"
        style="width: 5%; float: left;background-color:#666666;text-align: center;color:#fff;height: 100px;vertical-align: middle;border-radius: 5px 0px 5px;">
        <div class="serial_perpage" style="padding: 39px 0px;">{{$i}}</div>
      </div>
      <div class="data-box-content2 text-center orderentry-databox" style="width: 95%;float: left;">
        <div style="width: 100%;float: left;">
          <div class="data-box float-left text-left border border-bottom-0 border-right-0 border-left-0 orderbango"
            style="padding: 5px; width: 22%;">
            {{$value->kokyakuorderbango}}
            <input type="hidden" name="date_check[{{$value->kokyakuorderbango}}]" value="{{$value->idoutanabango}}">
            <input type="hidden" name="oderid[{{$value->kokyakuorderbango}}]" value="{{$value->kokyakuorderbango}}">
            <input type="hidden" class="created_user" name="created_user[{{$value->kokyakuorderbango}}]" value="{{$value->created_user}}">
            <input type="hidden" class="serial" name="serial[{{$value->kokyakuorderbango}}]" value="{{$i}}">
          </div>
          <div class="data-box text-left float-left border border-bottom-0 border-right-0 information1"
            style="padding: 5px; width: 26%;">
            {{$value->information1_detail}}
            <input type="hidden" name="information1[{{$value->kokyakuorderbango}}]" value="{{$value->information1}}">
            <input type="hidden" name="primary_bango[{{$value->kokyakuorderbango}}]" value="{{$value->primary_bango}}">
          </div>
          <div class="data-box text-left float-left border border-bottom-0 border-right-0 information2"
            style="padding: 5px; width: 26%;">
            {{$value->information2_detail}}
            <input type="hidden" name="information2[{{$value->kokyakuorderbango}}]" value="{{$value->information2}}">
          </div>
          <div class="data-box text-left float-left border border-bottom-0 border-right-0"
            style="padding: 5px; width: 26%;">
            {{$value->information3_detail}}
            <input type="hidden" name="information3[{{$value->kokyakuorderbango}}]" value="{{$value->information3}}">
          </div>
        </div>
      </div>
      <div class="data-box-content2 text-center orderentry-databox" style="width: 95%;float: left;">
        <div style="width: 100%;float: left;">
          <div class="data-box text-left float-left border text-left border-bottom-0 border-right-0 border-left-0"
            style="padding: 5px; width: 40%;">
            {{$value->juchukubun1}}
            <input type="hidden" name="acceptedname[{{$value->kokyakuorderbango}}]" value="{{$value->juchukubun1}}">
          </div>
          <div class="data-box float-left text-right border border-bottom-0 border-right-0"
            style="padding: 5px; width: 13%;text-align: right;">
            {{$value->money10}}
          </div>
          <div class="data-box float-left text-right border border-bottom-0 border-right-0"
            style="padding: 5px; width: 13%;text-align: right;">
            {{$value->moneymax}}
          </div>
          <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 10%;">
            <!-- <a class="btn btn-info" href="{{url('/pdf_doc/●0207検収書PDFv6.pdf')}}" target=”_blank”
                      style="color: #222;" onclick="openModalDetailProjectReg()">検収書作成</a> -->
                     
            @if($value->color_flag == 1)
            <a class="btn" href="#" style="background: #2c66b1; color: #ffffff;" oncontextmenu="return false;"
              onclick="makePdftoZip('{{$value->kokyakuorderbango}}','{{$value->information1}}','{{$value->information2}}','{{$value->intorder01}}','{{$value->information3}}')">検収書作成</a>   
            @elseif($value->color_flag == 2)
            <a class="btn" href="#" style="background: #d9e1f2; color: #000000;" oncontextmenu="return false;"
              onclick="makePdftoZip('{{$value->kokyakuorderbango}}','{{$value->information1}}','{{$value->information2}}','{{$value->intorder01}}','{{$value->information3}}')">検収書作成</a>  
            @else          

            <a class="btn" href="#" style="background: #2c66b1; color: #000000;" oncontextmenu="return false;"

              onclick="makePdftoZip('{{$value->kokyakuorderbango}}','{{$value->information1}}','{{$value->information2}}','{{$value->intorder01}}','{{$value->information3}}')">検収書作成</a>
            @endif  
            <a id="{{$value->kokyakuorderbango}}" href="" type="hidden" target=”_blank”></a>
            <!-- <a class="btn" href="#" style="background: #2c66b1; color: #ffffff;">検収書作成</a>
            <a class="btn" href="#" style="background: #d9e1f2; color: #000000;">検収書作成</a> -->
          </div>

          <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 1px; width: 24%; background-color:white;">
            <div class="custom-file-area custom-form">
              <div class="input-group input-group-sm">
                <input type="file" onchange="checkFileExist($(this),'{{$value->color_flag}}','{{$value->check_editable}}')" accept="application/pdf,application/zip" class="custom-file-input2" id="{{$value->kokyakuorderbango.$i}}file" name="filename[{{$value->kokyakuorderbango}}]" value="{{$value->pdf}}">
                <input type="hidden" name="filedelete[{{$value->kokyakuorderbango}}]" value="" id="filedelete{{$value->kokyakuorderbango.$i}}">
                <label class="custom-file-label2 c_hover" style="cursor: pointer; height: 28px !important; width: 78%;margin-right: -2px;background: #2B66B1;color: #fff!important; border: 1px solid #2B66B0;overflow: hidden;margin-left: 4px;border-radius: 4px;padding: 3px; margin-top: 4px; margin-bottom: 4px !important;" for="{{$value->kokyakuorderbango.$i}}file">
                    @if($value->pdf != ""){{$value->pdf}}@else{{"検収確認書PDFアップロード"}}@endif
                </label>
                <div class="input-group-append">
                  <button type="button" onclick="checkFileExist($(this),'{{$value->color_flag}}','{{$value->check_editable}}',1)" class="input-group-text btn customFileClear" style="height: 28px !important; margin-top: 4px;border-radius: 0 4px 4px 0;padding: 0px 10px !important;cursor: pointer!important; color: white;" value="{{$value->kokyakuorderbango.$i}}">
                    <i class="fa fa-times" aria-hidden="true"></i>
                  </button>
                </div>
                <div class="input-group-append">
                  <a href="/uploads/lbook/{{$value->pdf_full_name}}" target="_blank" style="cursor:pointer;position: absolute;right: 2px;top:4px;border: none;background: transparent;padding: 0px; @if($value->pdf_full_name == null || $value->pdf_full_name="") pointer-events: none;color: #ccc; @endif "><img src="img/PDFアイコン.png" alt="" width="30" height="28"></a>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="data-box-content2 custom-form text-center orderentry-databox lastRow" style="width: 95%;float: left;">
        <div style="width: 100%;float: left;">
          <div class="data-box text-left float-left border text-left"
            style="padding: 5px; width: 24%;border-right: 0 !important; border-left: 0 !important;">
            {{$value->intorder01}}
          </div>
          <div class="data-box text-left float-left border text-left"
            style="padding: 2px; width: 14%;border-right: 0 !important;background: white;">
            <input type="text" class="form-control input_field datePicker " name="intorder04[{{$value->kokyakuorderbango}}]" autocomplete="off" value="{{$value->intorder04}}" placeholder="年/月/日"
              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
              maxlength="10"
            >
            <input type="hidden" class="datePickerHidden">

          </div>
          <div class="data-box text-left float-left border text-left"
            style="padding: 2px; width: 15%;border-right: 0 !important;background: white;">
            <input type="text" name="intorder03[{{$value->kokyakuorderbango}}]" class="form-control input_field datePicker from_date" autocomplete="off" value="{{$value->intorder03}}" placeholder="年/月/日"
              oninput="checkTheDate($(this)),this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
              maxlength="10"
            >
            <input type="hidden" class="datePickerHidden">
          </div>
          <div class="data-box text-left float-left border text-left"
            style="padding: 2px; width: 11%;border-right: 0 !important;background: white;">
            <input type="text" name="intorder05[{{$value->kokyakuorderbango}}]" class="form-control input_field datePicker to_date" autocomplete="off" value="{{$value->intorder05}}" onkeyup="checkTheDate($(this))" placeholder="年/月/日"
              oninput="checkTheDate($(this)),this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
              maxlength="10"
            >
            <input type="hidden" class="datePickerHidden">
          </div>
          <div class="data-box switch-area float-left border"
            style="padding: 2px; width: 12%;border-right: 0 !important;background: white;">
            <label class="switch" style="">
              <input type="checkbox"  name="housoukubun[{{$value->kokyakuorderbango}}]" @if($value->housoukubun == '1') checked @endif>

              <div class="slider">
                <span class="on" >即</span>
                <span class="off">締</span>
              </div>

              <script type="text/javascript">
                function callme(self) {
                  $('#{{$value->kokyakuorderbango}}hidden1').remove();

                  if ( $(self).is(":checked")) {

                       self.value=2

                  }else{


                       var input = jQuery('<input id="{{$value->kokyakuorderbango}}hidden1" type="hidden" name="housoukubun[{{$value->kokyakuorderbango}}]" value="1">');
                      $(self).insertAfter(input);
                  }
                }
              </script>

            </label>
          </div>
          <div class="data-box float-left border"
            style="padding: 2px; width: 12%;border-right: 0 !important;background: white;">
            <div class="custom-arrow">
              <select class="form-control left_select only_order" data-check="{{$value->check_editable}}" data-color_flag="{{$value->color_flag}}" data-datachar09="{{$value->datachar09}}"
                style="border-radius: 4px !important;" name="datachar01[{{$value->kokyakuorderbango}}]" onchange="checkTheUser($(this),'{{$value->check_editable}}','{{$value->datachar09}}','{{$value->color_flag}}')">
                <option value="1" @if($value->datachar01 == '1')  selected="selected" @endif>未</option>
                <option value="2" @if($value->datachar01 == '2') selected="selected" @endif>指示</option>
                <option value="3" @if($value->datachar01 == '3') selected="selected" @endif>検印</option>
              </select>
            </div>
          </div>

          <div class="data-box border switch-area  border-right-0"
            style="padding: 2px;float: left; width: 12%;background: white;">
            <label class="switch" style="margin-left: 67px;">
              <input type="checkbox" @if($tantousya->innerlevel > 14) readonly @endif name="datachar06[{{$value->kokyakuorderbango,$value->datachar06}}]" @if($value->datachar06 == '2') checked  @endif>
              
              <div class="slider">
                <span class="on"></span>
                <span class="off">済</span>
              </div>
            </label>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@php
$i++;
@endphp
@endforeach

<script type="text/javascript">
  $(".datePicker").removeData('datepicker').unbind().datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 1,
    offset: 4,
  })

  $('.datePicker').on('change', function () {
    if ($(this).val().length == 10) {
      $(this).css("color", "#3333ff");
      $(this).focus(); //focusing current input on select
    }
  });

  $('.datePicker').on('focus', function () {
    if ($(this).val().length == 10) {
      $(this).datepicker('update');
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      // $(this).focus(); //focusing current input on select
      $(this).datepicker('hide');
    }
  });

  $('.datePicker').on('click', function () {
    $(this).datepicker('show');
  });

  $('.datePicker').on('keyup', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      $(this).css("color", "#3333ff");
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
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

  //Enter press hide dropdown
  $(".datePicker").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker").datepicker('hide');
    }
  });
</script>

{{-- Custom File JS --}}
<script>
    $(function() {
      $(".custom-file-input2").on("change", function (e) {
          let oldFileName = $(this).val();
          // let fileName = $(this).val().split("\\").pop();
          let fileName = e.target.files[0].name;
          let fileExtension = $(this).val().split(".").pop().toLowerCase();
          if(fileExtension == "pdf" || fileExtension == "zip"){
            if(fileName.length >= 15){
              let slicedFileName = fileName.slice(0, 10);
              let updatedFileName = slicedFileName + "..." + fileExtension;
              $(this).siblings(".custom-file-label2").addClass("selected").html(updatedFileName);
            }
            else if(fileName.length <= 14){
              $(this).siblings(".custom-file-label2").addClass("selected").html(fileName);
            }
          }
          else{
            $("#fileExtensionConfirmationModal").modal('show');
          }

      });

      $(".customFileClear").on("click", function () {
        console.log('filedelete'+$(this).val())
        $("#filedelete"+$(this).val()).val('1')
        $(this).parent('.input-group-append').siblings(".custom-file-label2").html('検収確認書PDFアップロード'); // changing to the default label
        $(this).parent('.input-group-append').siblings(".custom-file-input2").val(''); // set to default value
      });
    });
  </script>
    <script>
        function checkFileExist(own,color_flag,check_editable,is_close=null) {

            var target = own.parents('.parentClass').find('.only_order');
            var target_val = own.parents('.parentClass').find('.only_order').val();
            var serial = own.parents('.parentClass').find('.serial').val()
            var is_file_exist = own.parents('.parentClass').find('.custom-file-input2').prop('files').length;
            var msg = serial.trim() + '検収確認書PDFは必須です。'
            var value=target.val()
            var id_serial = 'err_p-'+serial.trim();

            if (target_val =='3') {
              if (check_editable=='ng') {
                 $('#err_p-' + serial.trim()).remove()
              }else{
                 $('#err_p-' + serial.trim()).remove()
                 $('#err-' + serial.trim()).remove()
                 target.removeClass('errorForSelect');
              }
            }else{
                 $('#err_p-' + serial.trim()).remove()
                 $('#err-' + serial.trim()).remove()
                 target.removeClass('errorForSelect');
            }
            /*if(is_close != null){
              console.log(target_val,color_flag)
                if(color_flag == 1 && target_val != 1){
                    target.addClass('errorForSelect');
                    if (($('#'+id_serial).length==0)) {
                        $("#err_msg").append("<p class='khalahobe' id='err_p-" + serial.trim() + "'>" + msg + "</p>")
                    }
                }else{
                  console.log($('#err_p-' + serial.trim()))
                  if (!$('#err_p-' + serial.trim())) {
                    target.removeClass('errorForSelect');
                  }
                    
                    $('#err_p-' + serial.trim()).remove()

                }
            }else{
              console.log('vd')
                if (!$('#err_p-' + serial.trim())) {
                    $('#err_p-' + serial.trim()).remove()
                  }
                
                target.removeClass('errorForSelect');

            }*/
            
            //submit button enable/disable
            var i = 1;
            $('#err_msg').children('p').each(function () {
                i++
            });
            if (i <= 1) {
                $("#ordersubmit").removeClass("disable");
            }else{
                $("#ordersubmit").addClass("disable");
            }
        }
    </script>
  <script type="text/javascript">
    //switch on off in Left and Right arrow key....
    $('input[type=checkbox]').on('keydown', function(e) {
      if (e.which == 39) {
        $(this).prop('checked', true);
      }else if (e.which == 37) {
        $(this).prop('checked', false);
      }
    });
  </script>

@endif
