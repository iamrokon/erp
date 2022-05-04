{{--first item must be without mt-2--}}
<!-- <div class="row mt-2"> -->
<?php $i = 0;?>
@if(isset($depositApplicationInfo))
    @foreach($depositApplicationInfo as $key=>$val)
    <?php $i++;?>
    <input type="hidden" name="payment_number[]" value="{{ $val->payment_number }}">
    <input type="hidden" name="serial[]" value="{{ $val->serial }}">
    <input type="hidden" name="kingaku[]" value="{{ $val->kingaku }}">
    <input type="hidden" name="hanbaibukacd[]" value="{{ $val->hanbaibukacd }}">
    <input type="hidden" name="dataint18[]" value="{{ $val->dataint18 }}">
    <input type="hidden" name="dataint19[]" value="{{ $val->dataint19 }}">
    <input type="hidden" name="dataint20[]" value="{{ $val->dataint20 }}">
    <input type="hidden" name="dataint01[]" value="{{ $val->dataint01 }}">
    <div class="col-12">
        <div class="data-wrapper-content mt-2" style="width: 100%;">
            <div class="data-box-content"
                 style="width: 4%; float: left;background-color:#666666;text-align: center;color:#fff;height: 74px;vertical-align: middle;border-radius: 5px 0px 5px;">
                <div style="padding: 23px 0px;" id="lineNumber" class="lineNumber">
                    {{ $i }}
                </div>
            </div>
            <div class="data-box-content2 text-center orderentry-databox" style="width: 96%;float: left;">
                <div style="width: 100%;float: left;">
                    <div class="data-box text-left float-left border border-bottom-0 border-right-0 border-left-0"
                         style=" width: 12%;padding:5px;height:37px;" id="orderNumber" class="orderNumber">
                        {{ $val->juchubango }}
                    </div>
                    <div class="data-box text-left float-left border border-bottom-0 border-right-0 scroll-box-x"
                         style="width: 8%;padding:5px;height:37px;overflow: hidden;" id="inCharge" class="inCharge">
                        {{ $val->tantousya_name }}
                    </div>
                    <div class="data-box text-left float-left border border-bottom-0 border-right-0"
                         style=" width: 8%;padding:5px;height:37px;" id="salesDate" class="salesDate">
                        {{ $val->intorder03_val }}
                        <input type="hidden" name="intorder03[]" value="{{ $val->intorder03 }}">
                        <input type="hidden" name="numeric3_val[]" value="{{ $val->numeric3_val }}">
                    </div>
                    <div class="data-box text-left float-left border border-right-0 border-bottom-0" style="padding:5px 5px; width: 42%; height: 37px; display: flex; align-items: center;" id="orderSubject" class="orderSubject">
                        {{ $val->juchukubun1 }}
                    </div>
                    <div class="data-box text-right float-left border border-bottom-0 border-right-0"
                        style="width: 10%;padding:5px;height:37px;" id="appliedAmount_<?php echo $i;?>" class="appliedAmount">
                        {{ number_format($val->applied_amount) }}
                        <input type="hidden" name="applied_amount[]" value="{{ $val->applied_amount }}">
                    </div>
                    <div class="data-box text-right custom-form float-left border border-bottom-0"
                        style="width: 10%;padding:2px;height:37px;">
                        <input type="hidden" name="datachar10[]" value="{{ $val->datachar10 }}">
                        <input name="depositAmount[]" type="text" maxlength="9" class="form-control text-right depositAmount" id="depositAmount_<?php echo $i;?>" value="0" onfocusout="getDepositBalanceVal_2(<?php echo $i;?>)" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, ''),getDepositBalanceVal(<?php echo $i;?>)"  onfocus="callToRemoveComma(this),getDepositBalanceVal(<?php echo $i;?>)" style="text-align:right !important;">
                    </div>


                </div>
               
                <div class="data-box text-left float-left border  border-right-0"
                         style=" width:12%;padding:5px;height:37px;" id="salesNumber" class="salesNumber">
                        {{ $val->juchukubun2 }}
                        <input type="hidden" name="juchukubun2[]" value="{{ $val->juchukubun2 }}">
                    </div>
                    <div class="data-box text-left float-left border  border-right-0" id="immediateClassification" class="immediateClassification"
                         style=" width: 8%;padding:5px;height:37px;">
                        {{ $val->housoukubun }}
                    </div>
                    <div class="data-box text-left float-left border  border-right-0" id="paymentDay" class="paymentDay"
                         style=" width: 8%;padding:5px;height:37px;">
                        {{ $val->intorder05_val }}
                        <input type="hidden" name="torikomidate[]" value="{{ $val->torikomidate }}">
                        <input type="hidden" name="orderbango[]" value="{{ $val->orderbango }}">
                    </div>
                <div class="data-box text-left float-left border scroll-box-x border-right-0" style="width: 42%;padding:5px;overflow:auto;height:37px;" id="contractor" class="contractor">
                    {{ $val->information1_detail_show }}
                </div>

                <div class="data-box text-right float-left border border-right-0" style=" width: 10%;padding:5px;height:37px;" class="notPayment" id="notPayment">
                    {{ number_format($val->applied_amount - $val->not_payment_amount) }}
                    <input type="hidden" name="not_payment[]" id="not_payment_<?php echo $i;?>" value="{{ (int)($val->applied_amount - $val->not_payment_amount) }}">
                </div>
                <div class="data-box text-right float-left border  border-right-0" style=" width: 10%;padding:5px 0px;overflow:hidden;height:37px;" class="depositBalance" id="depositBalance_<?php echo $i;?>">
                    {{ number_format($val->applied_amount - $val->not_payment_amount) }}
                </div>
                <div class="data-box text-left float-left border border-right-0" style=" width: 5%;padding:5px;height:37px;" id="advanceClassification" class="advanceClassification">
                    {{ $val->unsoutesuryou_val }}
                    <input type="hidden" name="unsoutesuryou[]" value="{{ $val->unsoutesuryou }}">
                </div>
                <div class="data-box text-left float-left border" style=" width: 5%;padding:5px;height:37px;" id="soldCategory" class="soldCategory">
                    {{ $val->unsoudaibikitesuryou_val }}
                    <input type="hidden" name="unsoudaibikitesuryou[]" value="{{ $val->unsoudaibikitesuryou }}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
<input type="hidden" name="sales_number" id="sales_number" value="{{ $i }}">
<!-- </div> -->
<script type="text/javascript">

  function getDepositBalanceVal(row_number){
    console.log(no_check)
    if(no_check==0){
    var not_payment =  parseInt($("#not_payment_"+row_number).val().replaceAll(',',''));
    var depositAmount_val =  parseInt($("#depositAmount_"+row_number).val().replaceAll(',',''));
 
      if (!depositAmount_val) {
        depositAmount_val=0;
       
      }

       $("#depositBalance_"+row_number).html(numberFormat(not_payment - depositAmount_val));
    console.log(not_payment - depositAmount_val,not_payment , depositAmount_val)
    var loopCount = <?php echo $i;?>;
    var deposit_amount_total = 0;
    var deposit_amount;
    for(var i=1; i<=loopCount; i++){
      deposit_amount = parseInt($("#depositAmount_"+i).val().replaceAll(',',''));
      if(deposit_amount){

        deposit_amount_total += deposit_amount;
      }
    }
    $("#deposit_amount_total").html(numberCommaFormat(deposit_amount_total));
    //callforComma(row_number) 
   }else{
    var test = numberCommaFormat($("#depositAmount_"+row_number).val());
    //$("#depositAmount_"+row_number).val(test)
   }
  }
  function getDepositBalanceVal_2(row_number){
    console.log(no_check)
    if(no_check==0){
    var not_payment =  parseInt($("#not_payment_"+row_number).val().replaceAll(',',''));
    var depositAmount_val =  parseInt($("#depositAmount_"+row_number).val().replaceAll(',',''));
 
      if (!depositAmount_val) {
        depositAmount_val=0;
       
      }

       $("#depositBalance_"+row_number).html(numberFormat(not_payment - depositAmount_val));
    console.log(not_payment - depositAmount_val,not_payment , depositAmount_val)
    var loopCount = <?php echo $i;?>;
    var deposit_amount_total = 0;
    var deposit_amount;
    for(var i=1; i<=loopCount; i++){
      deposit_amount = parseInt($("#depositAmount_"+i).val().replaceAll(',',''));
      if(deposit_amount){

        deposit_amount_total += deposit_amount;
      }
    }
    $("#deposit_amount_total").html(numberCommaFormat(deposit_amount_total));
    callforComma(row_number) 
   }else{
    var test = numberCommaFormat($("#depositAmount_"+row_number).val());
    $("#depositAmount_"+row_number).val(test)
   }
  }
  var not_payment_total = 0;
  var not_payment;
  var loopCount = <?php echo $i;?>;
  for(var i=1; i<=loopCount; i++){
    not_payment = parseInt($("#not_payment_"+i).val());
    if(not_payment){
      not_payment_total += not_payment;
    }
  }

  $("#unpaid_amount_total").html(numberCommaFormat(not_payment_total));


  // Call for/Remove comma starts here
  function numberCommaFormat(num) {
    if (num) {
     
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

    return null;
  }



  function callforComma(no) 
  {
    //var number=(self.id).split('_');
    var error_occur=0; 
    if( parseInt($("#not_payment_"+no).val().replaceAll(',','')) < parseInt($("#depositAmount_"+no).val().replaceAll(',',''))){      
      $("#depositAmount_"+no).addClass( 'error' )
    }else{
        console.log(-parseInt($("#appliedAmount_"+no).text().replaceAll(',',''))>parseInt($("#depositAmount_"+no).val().replaceAll(',','')));
      if (-parseInt($("#appliedAmount_"+no).text().replaceAll(',','')) > parseInt($("#depositAmount_"+no).val().replaceAll(',',''))) {
         $("#depositAmount_"+no).addClass( 'error' )
      }else{
         $("#depositAmount_"+no).removeClass( 'error' )
      } 
      
      
    }
    var test = numberCommaFormat($("#depositAmount_"+no).val());
    $("#depositAmount_"+no).val(test)
    

     /////
     var loopCount = <?php echo $i;?>;
     for(var i=1; i<=loopCount; i++){
       if($("#depositAmount_"+i).hasClass('error')){
           error_occur++
       }
     }
     if (error_occur > 0) {
       ////
          var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">消込対象額を上回る入金は登録できません</p>';
          $(document).find("#confirmation_message").html(confirmationMsg);
       ////  
     }else{
         $(document).find("#confirmation_message").html('');
     }
     /////
  }

  function callToRemoveComma(self) {
    var test = self.value.replaceAll(/,+/g, '')
    self.value = test;

  }

  function numberFormat(num) {
    if (num) {
        // console.log({'numberFormat': num})
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    // console.log({'numberFormat' : ''})
    return 0;

}
  // Call for/Remove comma ends here
</script>
