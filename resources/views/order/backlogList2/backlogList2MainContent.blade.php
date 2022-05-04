<div class="content-bottom-bottom" style="margin-top: 10px;">
  <form id="mainForm" action="{{ route('backlogList2') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    @csrf

    <!-- first search req data //fsReqData=first search request data -->
    @if(isset($fsReqData))
    @foreach($fsReqData as $k=>$v)
    <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
    @endforeach
    @endif

    <div class="content-bottom-section" style="padding-bottom:46px;">
      <div class="content-bottom-top">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="bottom-top-title">
                月別受注残一覧２
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination Starts Here -->
        @include('order.backlogList2.pagination')
        <!-- Pagination Ends Here -->

      </div>
      
      <div class="content-bottom-bottom" style="margin-top: 10px;">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                <div class="table-responsive largeTable">
                  <table id="userTable" class="table table-bordered table-fill table-striped custom-form">
                    <thead class="thead-dark header text-center" id="myHeader">
                      <tr>
                        @foreach($headers as $header=>$field)
                        <th scope="col" class="signbtn"><span 
                            style="cursor: default;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>

                      @php
                      $group_check = "";
                      $n = 0;
                      $total_count = isset($backlogList2Info)?count($backlogList2Info):0;
                      $sub_total = 0;
                      $temp_sub_total = 0;
                      $grand_total = 0;
                      $previous_date = "";
                      @endphp

                      @if(isset($backlogList2Info))
                      @foreach($backlogList2Info as $key=>$val)
                      @php
                      if(request('rd2') == 'rd2_2'){
                      $temp_current = $val->jhvw050.$val->jhvw032;
                      }else{
                      $temp_current = $val->jhvw050.$val->jhvw021.$val->jhvw032;
                      }
                      //$current_group = $val->jhvw021;
                      $current_group = $val->jhvw050_detail;
                      @endphp
                      @if($n > 0 && $temp_current != $temp_sub_check)
                      <tr>
                         @foreach($headers as $header=>$field)
                            @if($field == "jhvw045")
                            <td class="text-right font-weight-bold">
                            {{substr($previous_date,0,4)}}年{{substr($previous_date,5,2)}}月 </td>
                            @elseif($field == "jhvw049")
                            <td class="text-right font-weight-bold">{{number_format($sub_total)}}</td>
                            @else
                             <td> </td>
                            @endif
                         @endforeach
                          
                       <!-- <td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">
                          {{--substr($previous_date,0,4)}}年{{substr($previous_date,5,2)--}}月 </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--number_format($sub_total)--}}</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        
                        
                      </tr>
                      @php
                      $temp_sub_total = $temp_sub_total + $sub_total;
                      $sub_total = 0;
                      @endphp
                      @endif
                      @if($n > 0 && $current_group != $group_check)
                      <tr>
                          
                         @foreach($headers as $header=>$field)
                            @if($field == "jhvw045")
                            <td class="text-right font-weight-bold">{{$group_check}}</td>
                            @elseif($field == "jhvw049")
                            <td class="text-right font-weight-bold">{{number_format($temp_sub_total)}}</td>
                            @else
                             <td> </td>
                            @endif
                         @endforeach
                          
                        <!--<td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--$group_check--}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--number_format($temp_sub_total)--}}</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        
                      </tr>
                      @php
                      $grand_total = $grand_total + $temp_sub_total;
                      $temp_sub_total = 0;
                      @endphp
                      @endif

                      <tr>
                        @foreach($headers as $header=>$field)
                        @if($field == "jhvw001")
                        <td> 
                            @if(substr($val->jhvw001,0,2) == '03')
                            {{$val->$field}}
                            @else
                            <a href="#" onclick="gotoOrderInquiry('{{$val->jhvw001}}',{{$val->ordertypebango2}})"
                            target="_blank"
                            style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                            @endif
                        </td>
                        @elseif($field == "user_name")
                        <td>{{$val->user_name_short}}</td>
                        @elseif($field == "jhvw032")
                        <td>{{$val->display_jhvw032}}</td>
                        @elseif($field == "jhvw048")
                        <td style="text-align:right;">{{$val->jhvw048}}</td>
                        @elseif($field == "jhvw049")
                        <td style="text-align:right;">{{$val->formatted_jhvw049}}</td>
                        @elseif($field == "jhvw050")
                        <td>{{$val->jhvw050_detail}}</td>
                        @elseif($field == "jhvw051")
                        <td>{{$val->jhvw051_detail}}</td>
                        @else
                        <td>{{$val->$field}}</td>
                        @endif
                        @endforeach
                      </tr>

                      @php
                      $n++;
                      if(request('rd2') == 'rd2_2'){
                      $temp_sub_check = $val->jhvw050.$val->jhvw032;
                      $previous_date = $val->jhvw032;
                      //$group_check = $val->jhvw032;
                      $group_check = $val->jhvw050_detail;
                      }else{
                      $temp_sub_check = $val->jhvw050.$val->jhvw021.$val->jhvw032;
                      $previous_date = $val->jhvw032;
                      //$group_check = $val->jhvw021;
                      $group_check = $val->jhvw050_detail;
                      }
                      $sub_total = $sub_total + $val->jhvw049;
                      @endphp

                      @if($total_count == $n)
                      @php
                      $temp_sub_total = $temp_sub_total+$sub_total;
                      $grand_total = $grand_total + $temp_sub_total;
                      @endphp
                      <tr>
                          
                         @foreach($headers as $header=>$field)
                            @if($field == "jhvw045")
                            <td class="text-right font-weight-bold">
                             {{substr($val->jhvw032,0,4)}}年{{substr($val->jhvw032,5,2)}}月 </td>
                            @elseif($field == "jhvw049")
                            <td class="text-right font-weight-bold">{{number_format($sub_total)}}</td>
                            @else
                             <td> </td>
                            @endif
                         @endforeach 
                          
                        <!--<td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">
                          {{substr($val->jhvw032,0,4)}}年{{--substr($val->jhvw032,5,2)--}}月 </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--number_format($sub_total)--}}</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        
                      </tr>
                      <tr>
                         @foreach($headers as $header=>$field)
                            @if($field == "jhvw045")
                            <td class="text-right font-weight-bold">{{$val->jhvw050_detail}}</td>
                            @elseif($field == "jhvw049")
                            <td class="text-right font-weight-bold">{{number_format($temp_sub_total)}}</td>
                            @else
                             <td></td>
                            @endif
                         @endforeach  
                          
                        <!--<td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--$val->jhvw050_detail--}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--number_format($temp_sub_total)--}}</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        
                      </tr>
                      
                      <!-- <tr>
                        <td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">合計</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{--number_format($grand_total)--}}</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr> -->
                      @endif

                      @endforeach
                      @endif
                      
                      @if(isset($backlogList2Info) && (count($backlogList2Info) > 0) && $current_page == $lastPage)
                      <tr>
                         
                         @foreach($headers as $header=>$field)
                            @if($field == "jhvw045")
                            <td class="text-right font-weight-bold">合計</td>
                            @elseif($field == "jhvw049")
                            <td class="text-right font-weight-bold">@if(isset($grand_total_amount)){{number_format($grand_total_amount)}}@endif</td>
                            @else
                             <td></td>
                            @endif
                         @endforeach  
                          
                        <!--<td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right font-weight-bold">合計</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">@if(isset($grand_total_amount)){{number_format($grand_total_amount)}}@endif</td>
                        <td class="text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>-->
                        
                      </tr>
                      @endif

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </form>
</div>
</div>