@php
$check = "";
@endphp
    @if(isset($orderDetail))
    @foreach($orderDetail as $key=>$val)
    @php
    $tmp_check = $val->minyuko_yoteimeter.'_'.$val->minyuko_nyukometer;
    if($check != $tmp_check){
        $type = "original_";
        $check = $tmp_check;
    }else{
        $type = "copy_";
    }
    @endphp
    <tr @if($val->minyuko_denpyobango == 1){{"style=pointer-events:none"}}@endif>
      <td>
        <div class="data-box-content"
          style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
          <div style="padding: 8px 0px;height: 37px;">
            <div style="width:100%;float:left;">
              <div style="text-align: center;width:20%;float:left;color: #fff;">
                    <input name="minyuko_syouhinsyu[]" value="{{$val->minyuko_syouhinsyu}}" class="minyuko_syouhinsyu" type="hidden" />
                    <input name="current_minyuko_syouhinsyu[]" value="{{$val->minyuko_syouhinsyu}}" class="current_minyuko_syouhinsyu" type="hidden" />
                    <input name="is_new[]" value="no" class="is_new" type="hidden" />
                    <input  value="" class="parent_id" type="hidden" />
                    <input value="{{$val->minyuko_idoutanabango}}" class="minyuko_idoutanabango" type="hidden" />
                    <input value="{{$val->minyuko_yoteimeter}}" class="minyuko_yoteimeter" type="hidden" />
                    <input value="{{$val->minyuko_nyukometer}}" class="minyuko_nyukometer" type="hidden" />
                    <input value="{{$type.$val->minyuko_yoteimeter.'-'.$val->minyuko_nyukometer}}" class="delete_check" type="hidden" />
                    <input name="idoutanabango_yoteimeter_nyukometer[]" value="{{$val->minyuko_idoutanabango.'_'.$val->minyuko_yoteimeter.'_'.$val->minyuko_nyukometer}}" type="hidden"/>
                <span class="minyuko_syouhinsyu_display">{{$val->minyuko_syouhinsyu}}</span>
              </div>
              <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
              <button onclick="cloneRow($(this))" class="btn" type="button" style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;margin-left:3px;background-color: #5497e9;color: #fff;cursor: pointer;">複</button>
              </div>
              <div style="width:40%;float:left;margin-top: -2px;">
		<input name="is_deleted[]" value="@if($val->minyuko_denpyobango == 1){{'yes'}}@else{{'no'}}@endif" class="is_deleted" type="hidden" />
                <button onclick="deleteRow($(this))" class="btn deleteBtn" type="button" style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>
      </td>
      <td @if($val->minyuko_denpyobango == 1){{"class=bg-gray-tr"}}@endif> {{$val->minyuko_datachar02}} {{$val->minyuko_datachar03}}</td>
      <td class="text-right @if($val->minyuko_denpyobango == 1){{'bg-gray-tr'}}@endif">
        <input name="minyuko_nyukosu[]" type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" class="form-control qty" value="{{$val->minyuko_nyukosu}}" />
      </td>
      <td class="text-right @if($val->minyuko_denpyobango == 1){{'bg-gray-tr'}}@endif"><input name="minyuko_genka[]" type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)" class="form-control unit-price" value="{{$val->formatted_minyuko_genka}}"/></td>
      <td class="text-right @if($val->minyuko_denpyobango == 1){{'bg-gray-tr'}}@endif">
	  <input name="hidden_minyuko_syouhizeiritu[]" class="minyuko_syouhizeiritu" value="{{$val->minyuko_syouhizeiritu}}" type="hidden"/>
	  <span class="syouhizeiritu_total">{{$val->formatted_minyuko_syouhizeiritu}}</span>
	  </td>
      <td @if($val->minyuko_denpyobango == 1){{"class=bg-gray-tr"}}@endif>
        <div class="custom-arrow">
          <select class="form-control classification-amount" name="datachar01[]" onchange="enableDisableRegButton($(this))" id="datachar01_{{$val->minyuko_syouhinsyu}}" autofocus="">
            <!--<option value="">-</option>-->
            @foreach($datachar01 as $dtchar01)
            <option value="{{$dtchar01->category1.$dtchar01->category2}}" @if($val->minyuko_datachar01 == $dtchar01->category1.$dtchar01->category2){{'selected'}}@endif> 
                    {{$dtchar01->category2_display." ".$dtchar01->category4}}
            </option>
            @endforeach
          </select>
        </div> 
      </td>
      <td @if($val->minyuko_denpyobango == 1){{"class=bg-gray-tr"}}@endif> 
        <div class="custom-arrow">
          <select class="form-control responsible-persion" name="datachar13[]" onchange="enableDisableRegButton($(this))" id="datachar13_{{$val->minyuko_syouhinsyu}}" @if($val->minyuko_datachar01 == 'V160') readonly style="pointer-events:none;"@endif autofocus="">
            <option value="">-</option>
			@foreach($datachar13 as $dtchar13)
			<option value="{{$dtchar13->bango}}" @if($val->minyuko_datachar13 == $dtchar13->bango){{'selected'}}@endif> 
				{{$dtchar13->bango." ".$dtchar13->name}}
			</option>
			@endforeach
          </select>
        </div> 
      </td>
      <td style="width: 180px;" @if($val->minyuko_denpyobango == 1){{"class=bg-gray-tr"}}@endif>
        <div style="width: 100%;">
          <div class="input-group input-group-sm position-relative">
              <input id="temp_datachar19" type="hidden" value="0" />
            <input name='db_datachar19[]' id='reg_db_datachar19_{{$val->minyuko_syouhinsyu}}' type="hidden" class="db_datachar19 form-control" readonly >
            <input name='datachar19[]' id='reg_datachar19_{{$val->minyuko_syouhinsyu}}_v2' type="text" class="datachar19 form-control" placeholder="" readonly="" style="width: 127px!important;padding: 0!important;">
            <div class="input-group-append" id="modalarea" data-toggle="modal" data-target="#search_modal4">
              <button onclick="supplierSelectionModalOpener('reg_datachar19_{{$val->minyuko_syouhinsyu}}_v2','reg_db_datachar19_{{$val->minyuko_syouhinsyu}}','1','required','r17_3',1,event.preventDefault())" class="input-group-text btn supplier-btn" @if($val->minyuko_datachar01 != 'V160') disabled @endif><i class="fas fa-arrow-left"></i></button>
            </div>
          </div>
        </div>
    </td>
    </tr>
    @endforeach
    @endif
