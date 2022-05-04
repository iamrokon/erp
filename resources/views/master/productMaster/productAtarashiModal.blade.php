<div class="modal" data-backdrop="static" id="office_modal4" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <td style=" border: none!important;"><input type="text" class="form-control" id="lastname"
                        placeholder=""></td>
                    <td style=" border: none!important;"><button type="button" id="office_search_button"
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
//    $("#office_master_content_div").show();
//
//    // $(this).closest('td').find("#office_master_content_div").toggle();
//    });
//     });

            </script>

            <script type="text/javascript">
              $(function(){
      $('#office_search_button').click(function(){
            $('.show_office_master_info').removeClass('add_border');
            document.getElementById('choice_buttonApi').disabled=true;
            $("#office_content_div_last").hide();
            $("#office_master_content_div").hide();
            $("#personal_master_content_div").hide();

     var value = $('#lastname').val().toLowerCase();
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

                  <table class="table table-striped " id="table-basic"
                    style="white-space: normal;word-break: break-all;">
                    <thead class="thead-dark header text-center" id="myHeader">
                      <tr>

                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          番号</th>
                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          会社名</th>
                      </tr>
                    </thead>
                    <tbody id="table-body" style="white-space: normal !important;">
                      @foreach($popUpData['kokyaku1'] as $kokyaku)
                      <tr class=" show_office_master_info table_hover2 gridAlternada" id="{{$kokyaku->yobi12}}"
                        onclick="getHaisouData('{{route('haisouApi',[$bango,$kokyaku->bango])}}','{{$kokyaku->yobi12}}')">
                        <td style="width: 50px; text-align: center;">{{$kokyaku->yobi12}}</td>
                        <td> {{$kokyaku->name}} </td>
                        <td style="display:none;"> {{$kokyaku->furigana}} </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>






                <div id="office_master_content_div" style="display: none;">

                  <!-- 2nd modal content -->
                  <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ</h4>

                  <div style="width: 99%;">
                    <table class="table table-striped " style="white-space: normal;word-break: break-all;">

                      <thead class="thead-dark header text-center" id="myHeader">
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
                      <tbody id="haisou-table" style="white-space: normal !important;">



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
//    $('.show_personal_master_info').click(function(){
//       // e.preventDefault();
//        $(this).addClass('add_border');
//             //$(this).css('border', "solid 2px red");
//         $("#personal_master_content_div").show();
//        // $(this).closest('td').find("#office_master_content_div").toggle();
//    });
//});

        </script>


        <div class="row">
          <div class="col-lg-6">
            <div id="personal_master_content_div" style="display: none;">

              <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>


              <input type="hidden" id="kokyakuIP" value="">
              <input type="hidden" id="haisouIP" value="">
              <input type="hidden" id="etsuransyaIP" value="">


              <div style="width: 99%;">
                <table class="table table-striped " style="white-space: normal;word-break: break-all;">

                  <thead class="thead-dark header text-center" id="myHeader">
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
                  <tbody id="etsuransya-table" style="white-space: normal !important;">

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
//         $("#office_content_div_last").show();
//        // $(this).closest('td').find("#office_master_content_div").toggle();
//    });
//});

          </script>
          <div class="col-lg-6">


            <div id="office_content_div_last" style="display: none;">

              <div style="width: 99%;">



                <table class="table table-striped " id="table-basic" style="white-space: normal;word-break: break-all;">

                  <tbody style="white-space: normal !important;">

                    <tr>
                      <td
                        style="width: 112px;background-color: #c2d6d6!important;border-top: 1px solid #29487d!important;">
                        番号</td>
                      <td style="width: 300px;border-top: 1px solid #29487d!important;" id="table_datatxt0049"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">部署</td>
                      <td style="width: 300px;" id="table_mail2"> </td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">役職</td>
                      <td style="width: 300px;" id="table_mail3"> </td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">氏名</td>
                      <td style="width: 300px;" id="table_tantousya"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">メールアドレス</td>
                      <td style="width: 300px;" id="table_mail1"></td>

                    </tr>
                    <tr>
                      <td style="width: 112px;background-color: #c2d6d6!important;">電話番号</td>
                      <td style="width: 300px;" id="table_datatxt0016"> </td>

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
        <button type="button" id="clearParentScreen1" class="btn btn-info"> 親画面をクリア</button>
        <button type="button" id="reset_button" class="btn btn-info"> 1つ前に戻る

        </button>
        <button type="button" id="choice_buttonApi" onclick="sum()" class="btn btn-info" data-dismiss=""> <i
            class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i>選択

        </button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function getHaisouData(url,kokyaku)
{
  $("#office_content_div_last").hide();
  $("#office_master_content_div").hide();
  $("#personal_master_content_div").hide();
   document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('kokyakuIP').value= kokyaku;

     $.ajax({
        url:  url,
        type: "GET",
        data: url,
        success: function( response )
        {
          console.log(response)
         var html=null;
         $("#haisou-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             html+='<tr class="show_personal_master_info" id="'+response[i]['torihikisakibango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;text-align: center;">'+response[i]['torihikisakibango']+'</td>';
                    html+='<td>'+response[i]['name']+'</td>';
               // }
               html+='</tr>'

          }
          console.log(html);
          //$("#office_master_content_div").show();
          $("#haisou-table").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['torihikisakibango'];
           document.getElementById(response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya('+d+',"'+b+'")');
          }
          $("#office_master_content_div").show();
        },
      });
}

function goToEtsuransya(id,b)
{
    $("#office_content_div_last").hide();
    $("#personal_master_content_div").hide();

    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('haisouIP').value= b;

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
         $("#etsuransya-table tr").remove();
          for (var i = 0; i < response.length; i++)
          {
             html+='<tr class="show_content_last" id="'+response[i]['bango']+'">'
             /* for (var key in response[i])
                {*/
                    //console.log(key+'='+ response[i][key]);
                    html+='<td style="width:50px;text-align: center;">'+response[i]['datatxt0049']+'</td>';
                    html+='<td>'+response[i]['tantousya']+'</td>';
               // }
               html+='</tr>'

          }
          console.log(html);
          //$("#office_master_content_div").show();
          $("#etsuransya-table").append(html);
          for (var i = 0; i < response.length; i++)
          {
           var d= response[i]['bango'];
           var b= response[i]['datatxt0049'];
           document.getElementById(response[i]['bango']).setAttribute("onclick", 'goToEtsuransyaDetail('+d+',"'+b+'")');
          }
          $("#personal_master_content_div").show();
        }
    });
}

function goToEtsuransyaDetail(id,b)
{
    $("#office_content_div_last").hide();
    document.getElementById('choice_buttonApi').disabled=true;
    document.getElementById('etsuransyaIP').value= b;

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
                document.getElementById('choice_buttonApi').disabled=false;
             }
                console.log(response);
                $('#table_datatxt0049').html(response.datatxt0049);
                $('#table_mail1').html(breakData(response.mail1, 35));
                $('#table_mail2').html(breakData(response.mail2, 35));
                $('#table_mail3').html(response.mail3);
                $('#table_tantousya').html(response.tantousya);
                $('#table_datatxt0016').html(response.datatxt0016);
                $("#office_content_div_last").show();
        }

    });
}

function sum()
{
   var kokyaku= document.getElementById('kokyakuIP').value;
   var haisou= document.getElementById('haisouIP').value;
   var etsuransya= document.getElementById('etsuransyaIP').value;
   document.getElementById('reg_season').value= kokyaku.toString()+haisou.toString()+etsuransya.toString();
   document.getElementById('edit_season').value= kokyaku.toString()+haisou.toString()+etsuransya.toString();
   $("#office_modal4").modal('hide');
   document.getElementById('choice_buttonApi').disabled=true;
}

$("#clearParentScreen1").on("click", function () {
    if($("#modal_type").val() == 'reg'){
        $("#reg_season").val("");
        $("#office_modal4").modal('hide');
    }else if($("#modal_type").val() == 'edit'){
        $("#edit_season").val("");
        $("#office_modal4").modal('hide');
    }
});
</script>