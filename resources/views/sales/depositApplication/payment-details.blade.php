@if(isset($payment_details))
<?php $i=0;?>
    @foreach($payment_details as $payment_detail)
    <?php $i++;?>

        <table class="table" style="margin-bottom: 0px !important;">
            <tbody>
            <tr>
                <td style="border: none !important;width: 10% !important;text-align: left;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="deposit_number-{{$loop->index}}" class="deposit_number">
                        {{$payment_detail->deposit_number}}
                    </div>
                    <input type="hidden" name="shinkurokokyakuname[]" value="{{ $payment_detail->deposit_number }}">
                    <input type="hidden" name="torikomidate_val[]" value="{{ $payment_detail->torikomidate_val }}">
                </td>
                <td style="border: none !important;width: 6% !important;text-align: right;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="line-{{$loop->index}}"
                         class="line">
                        {{$payment_detail->line}}
                    </div>
                    <input type="hidden" name="shinkurokokyakugroup[]" value="{{ $payment_detail->line }}">
                </td>
                <td style="border: none !important;width: 10% !important;text-align: left;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="payment_day-{{$loop->index}}" class="payment_day">
                        {{$payment_detail->payment_day}}
                    </div>
                </td>
                <td style="border: none !important;width: 10%  !important;text-align: left;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="payment_method-{{$loop->index}}" class="payment_method">
                        {{$payment_detail->payment_method}}
                    </div>
                </td>
                <td style="border: none !important;width: 10% !important;text-align: right;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="deposit_amount-{{$loop->index}}" class="deposit_amount">
                        {{ number_format($payment_detail->deposit_amount) }}
                        <input type="hidden" name="deposit_amount[]" value="{{ $payment_detail->deposit_amount }}">
                    </div>
                </td>
                <td style="border: none !important;width: 6%!important;text-align: right;">
                    <div style="border:1px solid #ddd !important;background: #efefef;border-radius: 4px;padding:4px;"
                         id="applicable_amount-{{$loop->index}}" class="applicable_amount">
                        {{ number_format($payment_detail->applicable_amount) }}
                    </div>
                    <input type="hidden" id="applicable_amount_<?php echo $i;?>" name="applicable_amount[]" value="{{$payment_detail->applicable_amount}}">
                </td>
                <td style="border: none !important;width:27% !important;text-align: left;">
                    <div style="border:none !important;background: #efefef;border-radius: 4px;">
                        <input readonly="" type="text" class="form-control remarks" id="remarks-{{$loop->index}}"
                               value="<?php echo mb_substr($payment_detail->remarks,0,40);?>"
                               style="border: 1px solid #dee2e6 !important;border-radius: 4px !important;">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    @endforeach
      <input type="hidden" name="count" id="deposit_number" value="{{$i}}">
@endif
