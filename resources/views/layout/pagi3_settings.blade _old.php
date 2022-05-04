
<style type="text/css">
@media only screen and (min-width:768px) and (max-width:992px)     {

#tbl_border_none{
   width: 100%;
margin-bottom: 10px;
float: right;
 }
}

/*#tbl_border_none{
    float: right;
}
*/


 @media only screen and (max-width:767px)  {

#tbl_border_none{
    margin-left: 0px;
    float: none!important;

 }
}


</style>


<!-- new pagination row starts here -->

@php
  if(isset($old['pagination']))
  {
    $numberOfData=$old['pagination'];
  }
  elseif(isset($pagi))
  {
    $numberOfData=$pagi;
  }
@endphp
<div class="col-lg-4 col-xl-4 col-md-5 col-sm-4">
    <div class="mt-2 mb-2">
        <table class="margin_left_b" id="tbl_border_none" style="">
            <tbody>
                <tr>
                    <!----------pagination Start-------->


                    <td class="" style="margin-left : 0px;padding-left: 0px!important;">
                        <a class="b1">行指定 </a>
                    </td>
                    <td>
                        <select name="pagination" class="form-control left_select" style="width: auto!important;border-radius: 0.25rem!important;" onchange="changeByDataAmount();">
                            <option value="20"   @if(isset($numberOfData)&&($numberOfData==20)) selected="selected" @endif>20</option>
                            <option value="50"  @if(isset($numberOfData)&&($numberOfData==50)) selected="selected" @endif>50</option>
                            <option value="100"  @if(isset($numberOfData)&&($numberOfData==100)) selected="selected" @endif>100</option>
                                           
                        </select>
                    </td>
                    <td></td>
                    <td class="">
                        <a class="b2">行</a>
                    </td>



                    <td class="">

                    </td>

                    <td class="">
                        <a id="openSettingModal" class="btn btn-info " style="width: 100%; background-color:#3e6ec1!important;margin-top: 2px;" data-toggle="modal" data-target="#">設定カラム表示</a>   

                    </td>
                  <!--   <td class="">
                        <a href="#" class="btn btn-info " style="width: 100%; background-color:#3e6ec1!important;margin-top: 2px;" data-toggle="modal" data-target="#">全ｶﾗﾑ表示</a>
                    </td> -->
                </tr>
                <!----------pagination End----------------->
            </tbody>
        </table>
    </div>

</div>



<!-- new pagination row ends here -->
