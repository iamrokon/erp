<div class="modal" data-backdrop="static" id="office_modal42" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog " role="document" style="max-width: 1050px!important;">
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
                    <td style=" border: none!important;">
                      <input type="text" class="form-control" id="lastname2" placeholder="">
                    </td>
                    <td style=" border: none!important;">
                      <button type="button" id="office_search_button2" class="btn btn-info btn_search" data-toggle="modal" data-target="#" style="margin-top: 2px;">
                        検索
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <script type="text/javascript">
              $(function () {
                $('#office_search_button2').click(function () {
                  $('#office_modal42').find("tr").removeClass('add_border');
                  document.getElementById('choice_buttonApi2').disabled = true;
                  $("#personal_master_content_div2").hide();
                  $("#office_content_div_last2").hide();
                  $("#office_master_content_div2").hide();

                  var value = $('#lastname2').val().toLowerCase();
                  $("#table-body2 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                  $("#product_supplier_content12").show();
                });
              });
            </script>

            <div class="table_wrap">
              <div class=" page4_table_design mt-2  table_hover  table-head-only">
                <div id="initial_content2">
                  <table class="table table-striped " id="table-basic2">
                    <thead class="thead-dark header text-center" id="myHeader2">
                      <tr>
                        <th scope="col" style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          番号
                        </th>
                        <th scope="col" style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          会社名
                        </th>
                      </tr>
                    </thead>
                    <tbody id="table-body2" style="white-space: normal !important;">
                      @foreach($popUpData['kokyaku1'] as $kokyaku)
                      <tr class=" show_office_master_info table_hover2 gridAlternada" style="cursor: pointer"
                        id="{{'2_'.$kokyaku->yobi12}}"
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
                    <table class="table table-striped " id="table22">
                      <thead class="thead-dark header text-center" id="myHeader2">
                        <tr>
                          <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            事業所CD
                          </th>
                          <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            事業所名
                          </th>
                        </tr>
                      </thead>
                      <tbody id="haisou-table2" style="white-space: normal !important;">

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

        <div class="row">
          <div class="col-lg-6">
            <div id="personal_master_content_div2" style="display: none;">
              <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>
              <input type="hidden" id="kokyakuIP2" value="">
              <input type="hidden" id="haisouIP2" value="">
              <input type="hidden" id="etsuransyaIP2" value="">
              <div style="width: 99%;">
                <table class="table table-striped " id="table32">
                  <thead class="thead-dark header text-center" id="myHeader2">
                    <tr>
                      <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        個人CD
                      </th>
                      <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        名称
                      </th>
                    </tr>
                  </thead>
                  <tbody id="etsuransya-table2" style="white-space: normal !important;">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- 3rd modal content end  -->

          <!-- 4th modal content end  -->
          <div class="col-lg-6">
            <div id="office_content_div_last2" style="display: none;">
              <div style="width: 99%;">
                <table class="table table-striped " id="table-basic2">
                  <tbody style="white-space: normal !important;">
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;border-top: 1px solid #29487d!important;">
                        番号
                      </td>
                      <td style="width: 300px;border-top: 1px solid #29487d!important;" id="table_datatxt0049_2"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">部署</td>
                      <td style="width: 300px;" id="table_mail2_2"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">役職</td>
                      <td style="width: 300px;" id="table_mail3_2"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">氏名</td>
                      <td style="width: 300px;" id="table_tantousya_2"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">メールアドレス</td>
                      <td style="width: 300px;" id="table_mail1_2"></td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">電話番号</td>
                      <td style="width: 300px;" id="table_datatxt0016_2"></td>
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
        <button type="button" id="reset_button2" class="btn btn-info">1つ前に戻る</button>

        <button type="button" id="choice_buttonApi2" onclick="sum2()" class="btn btn-info" disabled="disabled"> 
          <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i>
          選択
        </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function getHaisouData2(url, kokyaku) {
    $('#table-basic2').find("tr").removeClass('add_border');
    $("#2_" + kokyaku).addClass("add_border");
    $("#personal_master_content_div2").hide();
    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    document.getElementById('kokyakuIP2').value = kokyaku;
    $.ajax({
      url: url,
      type: "GET",
      data: url,
      success: function (response) {
        console.log(response)
        var html = null;
        $("#haisou-table2 tr").remove();
        for (var i = 0; i < response.length; i++) {
          html += '<tr class="show_personal_master_info2" style="cursor: pointer" id="2_' + response[i]['torihikisakibango'] + '">'
          /* for (var key in response[i])
             {*/
          //console.log(key+'='+ response[i][key]);
          html += '<td style="width:50px;text-align: center;">' + response[i]['torihikisakibango'] + '</td>';
          html += '<td>' + response[i]['name'] + '</td>';
          // }
          html += '</tr>'

        }
        console.log(html);
        //$("#office_master_content_div").show();
        $("#haisou-table2").append(html);
        for (var i = 0; i < response.length; i++) {
          var d = response[i]['bango'];
          var b = (response[i]['torihikisakibango']).toString();
          document.getElementById('2_' + response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya2(' + d + ',"' + b + '")');
        }
        $("#office_master_content_div2").show();
      },
    });
  }

  function goToEtsuransya2(id, b) {
    $('#table22').find("tr").removeClass('add_border');
    $("#2_" + b).addClass("add_border");
    $("#personal_master_content_div2").hide();
    $("#office_content_div_last2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    document.getElementById('haisouIP2').value = b;

    var num = id;
    var bango = '{{$bango}}';
    var url = '/office/etsuransyaApi/' + bango + '/' + num;
    console.log(url)
    $.ajax({
      url: url,
      type: "GET",
      data: url,
      success: function (response) {
        console.log(response)
        var html = null;
        $("#etsuransya-table2 tr").remove();
        for (var i = 0; i < response.length; i++) {
          html += '<tr class="show_personal_master_info2" style="cursor: pointer" id="2_' + response[i]['bango'] + '">'
          /* for (var key in response[i])
             {*/
          //console.log(key+'='+ response[i][key]);
          html += '<td style="width:50px;text-align: center;">' + response[i]['datatxt0049'] + '</td>';
          html += '<td>' + response[i]['tantousya'] + '</td>';
          // }
          html += '</tr>'

        }

        //$("#office_master_content_div").show();
        $("#etsuransya-table2").append(html);
        for (var i = 0; i < response.length; i++) {
          var datatxt0049 = response[i]['datatxt0049'].toString();
          console.log(datatxt0049)
          var d = response[i]['bango'];
          document.getElementById('2_' + response[i]['bango']).setAttribute("onclick", 'goToEtsuransyaDetail2(' + d + ',"' + datatxt0049 + '")');
        }
        $("#personal_master_content_div2").show();
      }
    });
  }

  function goToEtsuransyaDetail2(id, datatxt0049) {
    $('#table32').find("tr").removeClass('add_border');
    $("#2_" + id).addClass("add_border");
    document.getElementById('etsuransyaIP2').value = datatxt0049;
    console.log(datatxt0049);
    $("#office_content_div_last2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    var num = id;
    var bango = '{{$bango}}';
    var url = '/office/etsuransyaDetailApi/' + bango + '/' + num;
    console.log(url)
    $.ajax({
      url: url,
      type: "GET",
      data: url,
      success: function (response) {
        if (response.datatxt0049 != null) {
          document.getElementById('choice_buttonApi2').disabled = false;
        }
        console.log(response);
        $('#table_datatxt0049_2').html(response.datatxt0049);
        $('#table_mail1_2').html(breakData(response.mail1, 35));
        $('#table_mail2_2').html(breakData(response.mail2, 35));
        $('#table_mail3_2').html(response.mail3);
        $('#table_tantousya_2').html(response.tantousya);
        $('#table_datatxt0016_2').html(response.datatxt0016);
        $("#office_content_div_last2").show();
      }

    });
  }

  function sum2() {
    var kokyaku = document.getElementById('kokyakuIP2').value;
    var haisou = document.getElementById('haisouIP2').value;
    var etsuransya = document.getElementById('etsuransyaIP2').value;
    console.log(kokyaku, haisou, etsuransya)
    document.getElementById('insert_other15').value = kokyaku.toString() + haisou.toString() + etsuransya.toString();
    document.getElementById('edit_other15').value = kokyaku.toString() + haisou.toString() + etsuransya.toString();
    $("#office_modal42").modal('hide');
    document.getElementById('choice_buttonApi2').disabled = true;
    $('#office_modal42').find("tr").removeClass('add_border');
  }

  $("#office_modal42").on('hidden.bs.modal', function () {
    $('#office_modal42').find("tr").removeClass('add_border');
  });
  $('[data-dismiss=modal]').on('click', function (e) {
    $('#office_modal42').find("tr").removeClass('add_border');
  });
</script>