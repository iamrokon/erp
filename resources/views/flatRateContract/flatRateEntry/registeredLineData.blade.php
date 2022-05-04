@foreach($flatRateEntryInfo as $key=>$value)
<div class="row mt-2">
    <div class="col-12">
       <div class="data-wrapper-content" style="width: 100%;">
        <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
          <div style="padding: 27px;">
          <input name="syouhinbango[]" type="hidden" value="{{$value->syouhinbango}}" >
          <input name="yoteisu[]" type="hidden" value="{{$value->yoteisu}}" >
          {{$value->syouhinbango}}-{{$value->yoteisu}}
          </div>
        </div>
        <div class="data-box-content2 custom-form text-center orderentry-databox" style="width: 90%;float: left;">
          <div style="width: 100%;float: left; background: white;">
            <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <input name="datachar29[]" type="text" readonly="" class="form-control" value="{{$value->datachar29}}">
            </div>
            <div class="data-box float-left custom-vline" style="padding:10px 3px 10px 0px; width:10%;text-align: right;">
                <input name="syouhizeiritu[]" type="hidden" value="{{$value->syouhizeiritu}}" >
                {{number_format($value->syouhizeiritu)}}
            </div>
            <div class="data-box float-left" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">
                <input name="syukkomotobango[]" type="hidden" value="{{$value->syukkomotobango}}" >
                {{number_format($value->syukkomotobango)}}
            </div>
            <div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 15%;text-align: right;">
                <input name="syukkameter[]" type="hidden" value="{{$value->syukkameter}}" >
                {{number_format($value->syukkameter)}}
            </div>
            <div class="data-box float-left custom-vline" style="padding:10px 3px 10px 0px; width: 10%;text-align: right;">
                <input name="zaikometer[]" type="hidden" value="{{$value->zaikometer}}" >
                {{number_format($value->zaikometer)}}
            </div>
            <div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">
                <input name="seikyubango[]" type="hidden" value="{{$value->seikyubango}}" >
                {{number_format($value->seikyubango)}}
            </div>
            <div class="data-box float-left" style="padding: 10px 10px 10px 0px; width: 30%; text-align: right;">
                <input name="denpyobango[]" type="hidden" value="{{$value->denpyobango}}" >
                {{number_format($value->denpyobango)}}
            </div>
              
           <!-- <div class="data-box float-left " style="padding: 10px;width: 289px;text-align: right;color:#fff;">
            4444
            </div> -->

          </div>
        </div>
        <div class="data-box-content2 text-center custom-form orderentry-databox" style="width: 90%;float: left;">
          <div style="width: 100%;float: left;">
            <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                    <input name="kanryoubi[]" readonly type="text" value="{{$value->kanryoubi}}" class="form-control sales_date" id="datepicker4_oen_{{$value->syouhinbango}}_{{$value->yoteisu}}" oninput="this.value = this.value.replace(/[^\d^\/]/g, \'\').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, \'$1$2$3\').replace(/([\d]{8})([\d]{1,2})?/g, \'$1\');"
                                     onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                         maxlength="10"
                                         autocomplete="off" placeholder="年/月/日"
                                        style="width: 96px!important;" value="">
                                  <input type="hidden" class="datePickerHidden">
                              </div>
            </div>
            <div class="data-box float-left custom-vline" style="padding: 12px 3px 10px 0px; width: 10%;text-align: right">
                <input name="soukobango[]" type="hidden" value="{{$value->soukobango}}" >
                {{number_format($value->soukobango)}}
            </div>
            <div class="data-box float-left" style="padding: 5px;width: 12%;">

              <input name="syouhinid[]" readonly="" type="text" class="form-control" value="{{$value->syouhinid}}"> 
            </div>
            <div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">
              <input name="juchusyukko_datachar24[]" value="{{$value->juchusyukko_datachar24}}" type="hidden"/>
              <input readonly="" value="{{$value->juchusyukko_dtchar24_detail}}" type="text" class="form-control" placeholder="" style="text-align:center;background-color:@if($value->juchusyukko_datachar24 == 1){{'#888888 !important'}}@else{{'#efefef'}}@endif;color: @if($value->juchusyukko_datachar24 == 1){{'#fff'}}@else{{'#000'}}@endif;">
            </div>
            <div class="data-box float-left" style="padding: 5px 3px;width: 8%;">
              <input name="juchusyukko_datachar25[]" value="{{$value->juchusyukko_datachar25}}" type="hidden"/>
              <input readonly="" value="{{$value->juchusyukko_dtchar25_detail}}" type="text" class="form-control" placeholder="" style="background-color:@if($value->juchusyukko_datachar25 == 1){{'#888888 !important'}}@else{{'#efefef'}}@endif;color: @if($value->juchusyukko_datachar25 == 1){{'#fff'}}@else{{'#000'}}@endif;text-align: center;">
            </div>
            <div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">
              <input name="juchusyukko_datachar26[]" value="{{$value->juchusyukko_datachar26}}" type="hidden"/>
              <input readonly="" value="{{$value->juchusyukko_dtchar26_detail}}" type="text" class="form-control" placeholder="" style="text-align:center;background-color:@if($value->juchusyukko_datachar26 == 1){{'#888888 !important'}}@else{{'#efefef'}}@endif;color: @if($value->juchusyukko_datachar26 == 1){{'#fff'}}@else{{'#000'}}@endif;">
            </div>
            <div class="data-box float-left" style="padding: 5px;width: 41%;border-right: 0 !important;border-left: 0 !important;">
              <input name="datachar08[]" type="text" class="form-control remarks" value="{{$value->datachar08}}" style="width:99%!important;">
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endforeach