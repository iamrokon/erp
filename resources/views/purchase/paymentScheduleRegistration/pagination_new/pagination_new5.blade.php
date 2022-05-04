@php
    if(isset($old['pagination'])){
        $numberOfData=$old['pagination'];
    }
    elseif(isset($pagi)){
        $numberOfData=$pagi;
    }
@endphp

<td class="" style="margin-left : 0px">
    <a message="@if(array_key_exists('pagination', $buttonMessage)){{$buttonMessage['pagination']}}@endif" class="b1 message_content">行数指定</a>
</td>

<td>
    <div class="custom-arrow">
        <select name="pagination" class="form-control left_select "
            style="width: 95px!important; border:1px solid #e1e1e1 !important;border-radius: 0.25rem!important;"
            onchange="changeByDataAmount_0610_page();">
            <option value="50" @if(isset($numberOfData)&&($numberOfData==50)) selected="selected" @endif>50</option>
            <option value="100" @if(isset($numberOfData)&&($numberOfData==100)) selected="selected" @endif>100</option>
            <option value="200" @if(isset($numberOfData)&&($numberOfData==200)) selected="selected" @endif>200</option>
        </select>
    </div>
</td>

<td></td>
<td class="">
    <a class="b2">行</a>
</td>