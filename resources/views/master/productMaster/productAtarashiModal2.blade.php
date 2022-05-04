<div class="modal" data-backdrop="static" id="product_modal42" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">取引先</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="row">
          <div class="col-lg-6">

            <h4 style="margin-bottom: 15px;margin-top: 10px;">会社マスタ</h4>
            <div style="margin-bottom: 5px;">
              <table class="table table-striped" style="border: none!important;width: auto;">
                <tbody>
                  <tr>

                    <td style=" border: none!important;width: 40px!important;">ｶﾅ/名称</td>
                    <td style=" border: none!important;"><input type="text" class="form-control" id="lastname2"
                        placeholder=""></td>
                    <td style=" border: none!important;"><button type="button" id="office_search_button2"
                        class="btn btn-info btn_search" data-toggle="modal" data-target="#" style="margin-top: 2px;">検索

                      </button></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <script type="text/javascript">
              //    $(function(){
//    $('.show_office_master_info').click(function(){
//    //e.preventDefault();
//    //$(this).removeClass('active')
//    $(this).addClass('add_border');
//    // $(this).css('border', "solid 2px red");
//    $("#office_master_content_div2").show();
//
//    // $(this).closest('td').find("#office_master_content_div2").toggle();
//    });
//     });

            </script>

            <script type="text/javascript">
              $(function(){
      $('#office_search_button2').click(function(){
            $('.show_office_master_info').removeClass('add_border');
            document.getElementById('choice_buttonApi2').disabled=true;
            $("#office_master_content_div2").hide();
            $("#product_master_content_div2").hide();
            $("#product_content_div_last2").hide();

     var value = $('#lastname2').val().toLowerCase();
     $("#table-body tr").filter(function() {
       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
     });
       $("#product_supplier_content1").show();


         });

     });

            </script>


            <div class="table_wrap">
              <div class=" page4_table_design mt-2  table_hover  table-head-only">


                <div id="initial_content">

                  <table class="table table-striped " id="table-basic2"
                    style="white-space: normal;word-break: break-all;">
                    <thead class="thead-dark header text-center" id="myHeader2">
                      <tr>

                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          番号</th>
                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          会社名</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      @foreach($popUpData['kokyaku1'] as $kokyaku)
                      <tr class=" show_office_master_info table_hover2 gridAlternada" id="{{$kokyaku->yobi12}}"
                        onclick="getHaisouData2('{{route('haisouApi',[$bango,$kokyaku->bango])}}','{{$kokyaku->yobi12}}')">
                        <td style="width: 50px; text-align: center;">{{$kokyaku->yobi12}}</td>
                        <td> {{$kokyaku->name}} </td>
                        <td style="display:none;"> {{$kokyaku->furigana}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>






                <div id="office_master_content_div2" style="display: none;">

                  <!-- 2nd modal content -->
                  <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ</h4>

                  <div style="width: 99%;">
                    <table class="table table-striped " style="white-space: normal;word-break: break-all;">

                      <thead class="thead-dark header text-center" id="myHeader2">
                        <tr>

                          <th scope="col"
                            style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            番号</th>
                          <th scope="col"
                            style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            事務所名</th>
                          <!--                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">住所</th>-->
                        </tr>
                      </thead>
                      <tbody id="haisou-table2">



                      </tbody>
                    </table>
                  </div>


                </div>




              </div>
            </div>

          </div>
        </div>
        <!-- 2nd modal content end -->

        <!-- 3rd modal content  -->
        <script type="text/javascript">
          //$(function(){
//    $('.show_personal_master_info2').click(function(){
//       // e.preventDefault();
//        $(this).addClass('add_border');
//             //$(this).css('border', "solid 2px red");
//         $("#product_master_content_div2").show();
//        // $(this).closest('td').find("#office_master_content_div2").toggle();
//    });
//});

        </script>


        <div class="row">
          <div class="col-lg-6">
            <div id="product_master_content_div2" style="display: none;">

              <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>


              <input type="hidden" id="kokyakuIP2" value="">
              <input type="hidden" id="haisouIP2" value="">
              <input type="hidden" id="etsuransyaIP2" value="">


              <div style="width: 99%;">
                <table class="table table-striped " style="white-space: normal;word-break: break-all;">

                  <thead class="thead-dark header text-center" id="myHeader2">
                    <tr>

                      <th scope="col"
                        style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        番号</th>
                      <th scope="col"
                        style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        氏名</th>
                      <!--                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">部署</th>-->
                    </tr>
                  </thead>
                  <tbody id="etsuransya-table2">

                    <!--   <tr class="show_content_last">

        <td style="width:50px;text-align: center;">11</td>

      <td>山田</td>

      <td>経営企画部</td>


      </tr>

         <tr class="show_content_last">

        <td style="width:50px;text-align: center;">25</td>


      <td>佐藤</td>

      <td>営業部</td>


      </tr>-->

                  </tbody>
                </table>
              </div>

            </div>


          </div>
          <!-- 3rd modal content end  -->

          <!-- 4th modal content end  -->

          <script type="text/javascript">
            //  $(function(){
//    $('.show_content_last').click(function(){
//         $(this).addClass('add_border');
//     // $(this).css('border', "solid 2px red");
//        //e.preventDefault();
//         $("#product_content_div_last2").show();
//        // $(this).closest('td').find("#office_master_content_div2").toggle();
//    });
//});

          </script>
          <div class="col-lg-6">


            <div id="product_content_div_last2" style="display: none;">

              <div style="width: 99%;">



                <table class="table table-striped " id="table-basic2"
                  style="white-space: normal;word-break: break-all;">

                  <tbody>

                    <tr>
                      <td
                        style="width: 112px;background-color: #c2d6d6!important;border-top: 1px solid #29487d!important;">
                        番号</td>
                      <td style="width: 300px;border-top: 1px solid #29487d!important;" id="table_datatxt0049_2"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">部署</td>
                      <td style="width: 300px;" id="table_mail2_2"> </td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">役職</td>
                      <td style="width: 300px;" id="table_mail3_2"> </td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">氏名</td>
                      <td style="width: 300px;" id="table_tantousya_2"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">メールアドレス</td>
                      <td style="width: 300px;" id="table_mail1_2"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">電話番号</td>
                      <td style="width: 300px;" id="table_datatxt0016_2"> </td>

                    </tr>






                  </tbody>
                </table>
              </div>

            </div>

          </div>


        </div>


        <!-- 4th modal content end  -->
        <!-- modal content enddd   -->

      </div>
      <div class="modal-footer">
        <button type="button" id="clearParentScreen2" class="btn btn-info"> 親画面をクリア</button>
        <button type="button" id="reset_button2" class="btn btn-info"> 1つ前に戻る

        </button>
        <button type="button" id="choice_buttonApi2" onclick="sum2()" class="btn btn-info" data-dismiss=""> <i
            class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i>選択

        </button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function getHaisouData2(url,kokyaku)
{
  $("#product_content_div_last2").hide();
  $("#product_master_content_div2").hide();
  document.getElementById('choice_buttonApi2').disabled=true;
    document.getElementById('kokyakuIP2').value= kokyaku;

     $.ajax({
        url:  url,
        type: "GET",
        data: url,
        success: function( response )
        {
          console.log(response)
         var html=null;
         $("#haisou-table2 tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             html+='<tr class="show_personal_master_info2" id="2_'+response[i]['torihikisakibango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;text-align: center;">'+response[i]['torihikisakibango']+'</td>';
                    html+='<td>'+response[i]['name']+'</td>';
               // }
               html+='</tr>'

          }
          console.log(html);
          //$("#office_master_content_div2").show();
          $("#haisou-table2").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['torihikisakibango'];
           document.getElementById('2_'+response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya2('+d+',"'+b+'")');
          }
          $("#office_master_content_div2").show();
        },
      });
}

function goToEtsuransya2(id,b)
{
    $("#product_content_div_last2").hide();
    $("#product_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled=true;
    document.getElementById('haisouIP2').value= b;

    var num=id;
    var bango='{{$bango}}';
    var url='/office/etsuransyaApi/'+bango+'/'+num ;
    console.log(url)
    $.ajax({
        url:  url,
        type: "GET",
       // data: url,
        success: function( response )
        {
             console.log(response)
         var html=null;
         $("#etsuransya-table2 tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             html+='<tr class="show_content_last2" id="2_'+response[i]['bango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;text-align: center;">'+response[i]['datatxt0049']+'</td>';
                    html+='<td>'+response[i]['tantousya']+'</td>';
               // }
               html+='</tr>'

          }
          console.log(html);
          //$("#office_master_content_div2").show();
          $("#etsuransya-table2").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['datatxt0049'];
           document.getElementById('2_'+response[i]['bango']).setAttribute("onclick", 'goToEtsuransya2Detail2('+d+',"'+b+'")');
          }
          $("#product_master_content_div2").show();
        }
    });
}

function goToEtsuransya2Detail2(id,b)
{
    $("#product_content_div_last2").hide();
    document.getElementById('choice_buttonApi2').disabled=true;
    document.getElementById('etsuransyaIP2').value= b;

    var num=id;
    var bango='{{$bango}}';
    var url='/office/etsuransyaDetailApi/'+bango+'/'+num ;
    console.log(url)
    $.ajax({
        url:  url,
        type: "GET",
       // data: url,
        success: function( response )
        {
            if (response.datatxt0049 != null)
             {
                document.getElementById('choice_buttonApi2').disabled=false;
             }
                console.log(response);
                $('#table_datatxt0049_2').html(response.datatxt0049);
                $('#table_mail1_2').html(breakData(response.mail1, 35));
                $('#table_mail2_2').html(breakData(response.mail2, 35));
                $('#table_mail3_2').html(response.mail3);
                $('#table_tantousya_2').html(response.tantousya);
                $('#table_datatxt0016_2').html(response.datatxt0016);
                $("#product_content_div_last2").show();
        }

    });
}

function sum2()
{
   var kokyaku= document.getElementById('kokyakuIP2').value;
   var haisou= document.getElementById('haisouIP2').value;
   var etsuransya= document.getElementById('etsuransyaIP2').value;
   document.getElementById('reg_data104').value= kokyaku.toString()+haisou.toString()+etsuransya.toString();
   document.getElementById('edit_data104').value= kokyaku.toString()+haisou.toString()+etsuransya.toString();
   $("#product_modal42").modal('hide');
}

$("#clearParentScreen2").on("click", function () {
    if($("#modal_type").val() == 'reg'){
        $("#reg_data104").val("");
        $("#product_modal42").modal('hide');
    }else if($("#modal_type").val() == 'edit'){
        $("#edit_data104").val("");
        $("#product_modal42").modal('hide');
    }
});

</script>