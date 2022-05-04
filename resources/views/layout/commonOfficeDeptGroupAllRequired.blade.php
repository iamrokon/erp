<div class="row">
  <div class="ml-3">
    <table class="table custom-form" style="width:auto;">
        <tbody>
          <tr>
            <td style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px !important;">
              <div class="line-icon-box float-left mr-3"></div> 事業部
            </td>
            <td style="border: none!important;width:270px;">
              <input type="hidden" id="search_data_exist_status" value="@if(isset($fsReqData['division_datachar05_start'])){{ $fsReqData['division_datachar05_start'] }}@endif">
                <div class="custom-arrow">
              <select name="division_datachar05_start" id="division_datachar05_start" class="form-control" autofocus>
                    <!--<option class="null" value="">-</option>-->
                    @foreach($B9Data_left as $B9Dt)
                      @if(isset($fsReqData['division_datachar05_start']) && $fsReqData['division_datachar05_start'] !='')
                        <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($fsReqData['division_datachar05_start']) && $fsReqData['division_datachar05_start'] == $B9Dt->category1.$B9Dt->category2){{'selected'}}@endif >
                          {{$B9Dt->category2_show." ".$B9Dt->category4}}
                        </option>
                      @else
                        <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($personal_datatxt0003->category2 ) && $personal_datatxt0003->category2 == $B9Dt->category2) selected @endif>
                          {{$B9Dt->category2_show." ".$B9Dt->category4}}
                        </option>
                      @endif
                    @endforeach
              </select>
                </div>
            </td>
            <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
              ～
            </td>
            <td style="border: none!important;width:270px;">
              <div class="custom-arrow">
                <select name="division_datachar05_end" id="division_datachar05_end" class="form-control">
                    <!--<option class="null" value="">-</option>-->
                    @foreach($B9Data_right as $B9Dt)
                      @if(isset($fsReqData['division_datachar05_end']) && $fsReqData['division_datachar05_end'] !='')
                          <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($fsReqData['division_datachar05_end']) && $fsReqData['division_datachar05_end'] == $B9Dt->category1.$B9Dt->category2){{'selected'}}@endif >
                            {{$B9Dt->category2_show." ".$B9Dt->category4}}
                          </option>
                      @else
                          <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($personal_datatxt0003->category2) && $personal_datatxt0003->category2 == $B9Dt->category2) selected @endif>
                            {{$B9Dt->category2_show." ".$B9Dt->category4}}
                          </option>
                      @endif
                    @endforeach
                </select>
              </div>

            </td>
          </tr>
          <tr>
            <td style="border: none!important;text-align: left;color: black;padding-left: 0px !important;"><div class="line-icon-box float-left mr-3"></div>部
          </td>
          <td style="border: none!important;">
            <div class="custom-arrow">
                <select class="form-control" name="department_datachar05_start" id="department_datachar05_start" >
                <option class="null" value="">-</option>
                    @foreach($C1Data_left as $C1Dt)
                      @if(isset($fsReqData['department_datachar05_start']))
                        <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($fsReqData['department_datachar05_start']) && $C1Dt->category1.$C1Dt->category2==$fsReqData['department_datachar05_start']){{'selected'}}@endif >
                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                        </option>
                      @else
                          @if(isset($fsReqData)  && count($fsReqData)>0))
                              <option value="{{$C1Dt->category1.$C1Dt->category2}}">
                                {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                              </option>
                          @else
                              <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($personal_datatxt0004->category2 ) && $personal_datatxt0004->category2 == $C1Dt->category2) selected @endif>
                                {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                              </option>
                          @endif
                      @endif
                    @endforeach
                </select>
            </div>
          </td>
          <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
            ～
          </td>
        <td style="border: none!important;">
            <div class="custom-arrow">
                <select class="form-control" name="department_datachar05_end" id="department_datachar05_end" >
                <option class="null" value="">-</option>
                    @foreach($C1Data_right as $C1Dt)
                      @if(isset($fsReqData['department_datachar05_end']))
                        <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($fsReqData['department_datachar05_end']) && $C1Dt->category1.$C1Dt->category2==$fsReqData['department_datachar05_end']){{'selected'}}@endif >
                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                        </option>
                      @else
                          @if(isset($fsReqData) && count($fsReqData)>0))
                          <option value="{{$C1Dt->category1.$C1Dt->category2}}" >
                              {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                          </option>
                          @else
                          <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($personal_datatxt0004->category2) && $personal_datatxt0004->category2 == $C1Dt->category2) selected @endif>
                              {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                          </option>
                          @endif
                      @endif
                    @endforeach
                </select>
            </div>
        </td>
      </tr>
      <tr>
        <td style="border: none!important;text-align: left;color: black;padding-left: 0px !important;">
          <div class="line-icon-box float-left mr-3"></div>グループ
        </td>
        <td style="border: none!important;">
            <div class="custom-arrow">
                <select class="form-control" name="group_datachar05_start" id="group_datachar05_start" >
                <option class="null" value="">-</option>
                    @foreach($C2Data_right as $C2Dt)
                        @if(isset($fsReqData['department_datachar05_start']))
                            <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($fsReqData['group_datachar05_end']) && $C2Dt->category1.$C2Dt->category2==$fsReqData['group_datachar05_end']){{'selected'}}@endif >
                                {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                            </option>
                        @else
                            @if(isset($fsReqData) && count($fsReqData)>0))
                            <option value="{{$C2Dt->category1.$C2Dt->category2}}" >
                                {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                            </option>
                            @else
                                <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($personal_datatxt0005->category2) && $personal_datatxt0005->category2 == $C2Dt->category2) selected @endif>
                                    {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                                </option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
        </td>
        <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
            ～
          </td>
        <td style="border: none!important;">
            <div class="custom-arrow">
                <select class="form-control" name="group_datachar05_end" id="group_datachar05_end" >
                <option class="null" value="">-</option>
                    @foreach($C2Data_right as $C2Dt)
                        @if(isset($fsReqData['department_datachar05_start']))
                            <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($fsReqData['group_datachar05_end']) && $C2Dt->category1.$C2Dt->category2==$fsReqData['group_datachar05_end']){{'selected'}}@endif >
                              {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                            </option>
                        @else
                            @if(isset($fsReqData) && count($fsReqData)>0))
                            <option value="{{$C2Dt->category1.$C2Dt->category2}}" >
                                {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                            </option>
                            @else
                                <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($personal_datatxt0005->category2) && $personal_datatxt0005->category2 == $C2Dt->category2) selected @endif>
                                    {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
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
