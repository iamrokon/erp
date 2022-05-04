@php

    $old = array();
        if(session()->has('oldInput'.$bango))
        {
          $old = session()->get('oldInput'.$bango);

        }

    $current_page=$kaiinInfos->currentPage();

    $per_page=$kaiinInfos->perPage();

    $first_data= ($current_page - 1)*$per_page+1;

    $last_data=($current_page - 1)*$per_page+ sizeof($kaiinInfos->items());

    $total=$kaiinInfos->total();

    $lastPage=$kaiinInfos->lastPage() ;

@endphp


<form id="mainForm" action="{{ route('creditMaster') }}" method="post">
    @csrf
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
<!--first div and first two table start here  -->
<div class="row">
    <!-- first table -->
    <div class="col-lg-3 col-sm-3 col-md-3">
        <table class="table table-bordered">


            <tbody>
            <tr>
                <td style="background-color: #3e6ec1 ;text-align: center;color: white;font-weight: bold;">会社名</td>
            </tr>
            <tr>
                <td>
                    <select class="form-control left_select " name="kokyakuNameDrop" style="">
                        <option value="0"></option>
                        @php $toTalName = count($kokyakuNames); @endphp
                        @for($i=0; $i<$toTalName; $i++)
                            <option value="{{$kokyakuNames[$i]}}" {{ $kokyakuNames[$i]==$kokyakuDrop?'selected':''}}>{{$kokyakuNames[$i]}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- 2nd table -->
    <div class="col-xl-6 col-lg-9 col-md-9 col-sm-9" style="">
        <div class="outer row">


            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="tbl_credit">
                    <div class="table-responsive">
                        <table class="">

                            <thead class="thead-dark">
                            <tr>
                                <td scope="col" colspan="4" style="background-color: #3e6ec1!important;text-align: center;color: white;font-weight: bold;">選択開始年月</td>
                                <td scope="col" colspan="4" style="background-color: #3e6ec1!important;text-align: center;color: white;font-weight: bold;">選択終了年月</td>

                            </tr>
                            </thead>


                            <tbody>
{{--                            @php $month1="";--}}
{{--                                                            if($month-1 == 0){--}}
{{--                                                                $month1="12";--}}
{{--                                                                $year = $year-1;--}}
{{--                                                            }--}}
{{--                                                            else--}}
{{--                                                                $month1=$month;--}}
{{--                            @endphp--}}
                            <tr>
                                <td style="border-right: 0px!important;padding-right: 0px;">
                                    <select class="form-control" name="fromYear" style="width: 95px!important;">
                                        @for($i=2000; $i<2050; $i++)
                                            <option value="{{$i}}" {{ $i==$year1?'selected':''}}>{{$i}}</option>
                                        @endfor

                                    </select>
                                </td>
                                <td style="border-left: 0px!important;">年</td>
                                <td style="border-right: 0px!important;padding-right: 0px;">

                                    <select class="form-control" name="fromMonth" style="width: 95px!important;">
                                        @for($j=1; $j<9; $j++)
                                            <option value="{{$j}}"   {{ '0'.$j == $month1 ? 'selected' : '' }}>0{{$j}}</option>
                                        @endfor
                                        <option value="10" {{ $month1 == '10' ? 'selected' : '' }}>10</option>
                                        <option value="11" {{ $month1 == '11' ? 'selected' : '' }}>11</option>
                                        <option value="12" {{ $month1 == '12' ? 'selected' : '' }}>12</option>
                                    </select>
                                </td>
                                <td style="border-left: 0px!important;">月</td>
                                <td style="border-right: 0px!important;padding-right: 0px;">
                                    <select class="form-control" name="toYear" style="width: 95px!important;">
                                        @for($i=2000; $i<2050; $i++)
                                            <option value="{{$i}}" {{ $i == $year ? 'selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td style="border-left: 0px!important;">年</td>
                                <td style="border-right: 0px!important;padding-right: 0px;">
                                    <select class="form-control" name="toMonth" style="width: 95px!important;">
                                        @for($j=1; $j<9; $j++)
                                            <option value="{{$j}}"{{ '0'.$j == $month ? 'selected' : '' }}>0{{$j}}</option>
                                        @endfor
                                        <option value="10" {{ '0'.$j == $month ? 'selected' : '' }}>10</option>
                                        <option value="11" {{ '0'.$j == $month ? 'selected' : '' }}>11</option>
                                        <option value="12" {{ '0'.$j == $month ? 'selected' : '' }}>12</option>
                                    </select>
                                </td>
                                <td style="border-left: 0px!important;">月</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!------------3rd table------->
    <div class="col-lg-3 col-sm-4" style="">

    </div>
    <!------------3rd table end------->
    <!--first div and first three table 2nd table end -->
</div>
<!-- end here -->

    <!-- show success message -->
    @if(Session::has('success_msg'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="close"
                            data-dismiss="alert">&times;</button>
                    <strong>{{session()->get('success_msg')}}</strong>
                </div>
            </div>
        </div>
    @endif

    @if(isset($exceedUser))
        <p style="color: red;">{{$exceedUser}}</p>
    @endif

    <div class="row" >
        <div class="col-lg-8 col-sm-12 m-pd">
            <div class="responsive button-responsive-view">
                <div class="row">
                    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 text-center"><button href="#" class="btn btn-info btn-m-view " onclick="Thesearch();" style="width: 100%;" ><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索</button></div>
                    <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m text-center"><a href="#" class="btn btn-info btn-m-view " type="button" style="width: 100%;" onclick="refresh()">一覧</a></div>
{{--                    <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m text-center"><a href="#"class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="" data-target=""     @if(isset($deleted_item) && $deleted_item == 0) onclick="openRegistration()" @endif >新規登録</a></div>--}}

                    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m text-center " ><button href="#" onclick="excelDownload()" id="excelDwld" class="btn btn-info btn-m-view"style="width: 100%;">EXCEL作成</button></div>
                    

             <!--        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2 text-center " >
                        <div class="chk-wrapper" style="margin-top: 3px;">
                            <input type="checkbox" id="chkboxinp" name="chkboxinp" value="1" @if(isset($deleted_item)?($deleted_item == 1):false) checked="checked" @endif>
                            <label for="chkboxinp" style="line-height: 17px;">削除データ表示</label>
                        </div>
                    </div> -->

<div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m ">
                  <div class="custom-control custom-checkbox custom-control-inline">
                       
<input type="checkbox" id="btnchk1" name="chkboxinp" value="1" class="custom-control-input customCheckBox" onclick="refresh()" value="1" @if(isset($deleted_item)?($deleted_item == 1):false) checked="checked" @endif>

                        
                         <label class="custom-control-label margin_btn_17" for="btnchk1" style="line-height: 25px;">削除データ表示</label>
                         </div>
         </div>




                </div>
            </div>





        </div>
    </div>

<!-- button table row  end -->

    <!-- pagination show start here -->
    <div class="col-lg-12">

        <div class="row">

            <div class="pagi_main_wrap">

                <div class="pagi_inner_wrap">
                    @if($kaiinInfos->lastPage() > 1)
                        <div class="pagi_left_div">

                            @include('layout.pagi1_settings')

                        </div>
                    @endif
                    <div  class="pagi_midd_div">

                        @include('layout.pagi2_settings')
                        @if($kaiinInfos->total() > 0)
                            @include('layout.pagi3_settings')
                        @endif
                        @include('layout.pagi4_settings')

                    </div>
                    <div class="right_colset" >

                        @include('layout.pagi5_settings')

                    </div>

                </div>

            </div>



        </div>
    </div>
    <!-- pagination show end here -->

    <!-- Large table row starts here -->
<div class="row">
    <div class="col-lg-12">
 <div style="overflow:hidden; ">
      <div class=" largeTable" style="overflow-x: auto;">
<table class="table table-bordered table-striped" style="width: fit-content;">

                <thead class="thead-dark header text-center" id="myHeader">
                <tr>
                    <th scope="col"></th>
                    @foreach($headers as $header=>$field)
                        <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;" onclick="AscDsc('{{$field}}');">{{$header}}</span></th>
                    @endforeach

                </tr>
                </thead>

                <tbody>


                <tr>
                    <td></td>
                    @foreach($headers as $header=>$field)
                        <td>
                            <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                        </td>
                    @endforeach
                </tr>

                <!--      2nd row -->
{{--                @foreach($kaiinInfos as $key=>$val)--}}
                @foreach($kaiinInfos as $kaiinInfo)
                <tr>

                        <td style="width:50px;">
                            <a href="{{$kaiinInfo->bango}}" id="creditButton1" data-toggle="modal" data-target="#" onclick="showSingleCredit('{{route('creditMasterDetail',[$bango])}}', '{{$kaiinInfo->bango}}')" class="btn btn-info btn-m-view " style="width: 100%;"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                        </td>
                        @foreach($headers as $header=>$field)
                        @if(gettype($kaiinInfo->$field) == 'integer')
                            <td style="text-align: right;">{{$kaiinInfo->$field}}</td>
                        @else
                            <td>{{$kaiinInfo->$field}}</td>
                        @endif
                        @endforeach
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
</div>
</form>
