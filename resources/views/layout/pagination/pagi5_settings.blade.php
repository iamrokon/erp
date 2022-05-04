<style type="text/css">
  @media only screen and (min-width:768px) and (max-width:992px) {
    #tbl_border_none {
      width: 100%;
      margin-bottom: 10px;
    }
  }

  @media only screen and (max-width:767px) {
    #tbl_border_none {
      margin-left: 0px;
      float: none !important;
    }
  }
</style>

@php
  if(isset($old['pagination'])){
    $numberOfData=$old['pagination'];
  }
  elseif(isset($pagi)){
    $numberOfData=$pagi;
  }
@endphp

<div class=" right_colset_div" style="float: right;width: auto;">
  <table class="margin_left_b" id="tbl_border_none" style="">
    <tbody>
      <tr>
        <td class="" style="margin-left : 0px;padding-left: 0px!important;">
          <a message="@if(array_key_exists('pagination', $buttonMessage)){{$buttonMessage['pagination']}}@endif" class="b1 message_content">行指定</a>
        </td>
        <td>
          <div class="custom-arrow">
            <select name="pagination" class="form-control left_select" style="border-radius: 0.25rem!important; padding: 0px !important; padding-left: 4px !important; padding-right: 0px !important; width: 50px!important;" onchange="changeByDataAmount();">
              <option value="20" @if(isset($numberOfData)&&($numberOfData==20)) selected="selected" @endif>20</option>
              <option value="50" @if(isset($numberOfData)&&($numberOfData==50)) selected="selected" @endif>50</option>
              <option value="100" @if(isset($numberOfData)&&($numberOfData==100)) selected="selected" @endif>100</option>
            </select>
          </div>
        </td>
        <td></td>
        <td class=""><a class="b2">行</a></td>
        <td class=""></td>
        <td class="">
          <a id="openSettingModal" class="btn btn-info" style="width: 100%; background-color:#3e6ec1!important;margin-top: 2px;" data-toggle="" data-target="#">設定カラム表示</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>