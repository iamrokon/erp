<div class="modal" data-backdrop="static" id="office_modal4" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <td style=" border: none!important;"><input type="text" class="form-control" id="lastname"
                        placeholder=""></td>
                    <td style=" border: none!important;">
                      <button type="button" id="office_search_button" class="btn btn-info btn_search"
                        data-toggle="modal" data-target="#" style="margin-top: 2px;">
                        検索
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <script type="text/javascript">
              $(function () {
                $('#office_search_button').click(function () {
                  $('#office_modal4').find("tr").removeClass('add_border');
                  document.getElementById('choice_buttonApi').disabled = true;
                  $("#personal_master_content_div").hide();
                  $("#office_content_div_last").hide();
                  $("#office_master_content_div").hide();

                  var value = $('#lastname').val().toLowerCase();
                  $("#table-body tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                  $("#product_supplier_content1").show();
                });
              });
            </script>

            <div class="table_wrap">
              <div class=" page4_table_design mt-2  table_hover  table-head-only">
                <div id="initial_content">
                  <table class="table table-striped " id="table-basic">
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
                      <tr class=" show_office_master_info table_hover2 gridAlternada" style="cursor: pointer"
                        id="{{$kokyaku->yobi12}}"
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
                    <table class="table table-striped " id="table2">
                      <thead class="thead-dark header text-center" id="myHeader">
                        <tr>
                          <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            事業所CD
                          </th>
                          <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            事業所名
                          </th>
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

        <div class="row">
          <div class="col-lg-6">
            <div id="personal_master_content_div" style="display: none;">
              <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>
              <input type="hidden" id="kokyakuIP" value="">
              <input type="hidden" id="haisouIP" value="">
              <input type="hidden" id="etsuransyaIP" value="">
              <div style="width: 99%;">
                <table class="table table-striped " id="table3">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                      <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        個人CD
                      </th>
                      <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        名称
                      </th>
                    </tr>
                  </thead>
                  <tbody id="etsuransya-table" style="white-space: normal !important;">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- 3rd modal content end  -->

          <!-- 4th modal content end  -->
          <div class="col-lg-6">
            <div id="office_content_div_last" style="display: none;">
              <div style="width: 99%;">
                <table class="table table-striped " id="table-basic">
                  <tbody style="white-space: normal !important;">
                    <tr style="cursor: pointer">
                      <td
                        style="width: 112px;background-color: #c2d6d6!important;border-top: 1px solid #29487d!important;">
                        番号</td>
                      <td style="width: 300px;border-top: 1px solid #29487d!important;" id="table_datatxt0049"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">部署</td>
                      <td style="width: 300px;" id="table_mail2"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">役職</td>
                      <td style="width: 300px;" id="table_mail3"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">氏名</td>
                      <td style="width: 300px;" id="table_tantousya"> </td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">メールアドレス</td>
                      <td style="width: 300px;" id="table_mail1"></td>
                    </tr>
                    <tr style="cursor: pointer">
                      <td style="width: 112px;background-color: #c2d6d6!important;">電話番号</td>
                      <td style="width: 300px;" id="table_datatxt0016"></td>
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
        <button type="button" id="reset_button" class="btn btn-info">1つ前に戻る</button>

        <button type="button" id="choice_buttonApi" onclick="sum()" class="btn btn-info" disabled="disabled"> 
          <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i>
          選択
        </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function getHaisouData(url, kokyaku) {
    $('#table-basic').find("tr").removeClass('add_border');
    $("#" + kokyaku).addClass("add_border");
    $("#personal_master_content_div").hide();
    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    document.getElementById('kokyakuIP').value = kokyaku;
    $.ajax({
      url: url,
      type: "GET",
      data: url,
      success: function (response) {
        console.log(response)
        var html = null;
        $("#haisou-table tr").remove();
        for (var i = 0; i < response.length; i++) {
          html += '<tr class="show_personal_master_info" style="cursor: pointer" id="' + response[i]['torihikisakibango'] + '">'
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
        $("#haisou-table").append(html);
        for (var i = 0; i < response.length; i++) {
          var d = response[i]['bango'];
          var b = (response[i]['torihikisakibango']).toString();
          document.getElementById(response[i]['torihikisakibango']).setAttribute("onclick", 'goToEtsuransya(' + d + ',"' + b + '")');
        }
        $("#office_master_content_div").show();
      },
    });
  }

  function goToEtsuransya(id, b) {
    $('#table2').find("tr").removeClass('add_border');
    $("#" + b).addClass("add_border");
    $("#personal_master_content_div").hide();
    $("#office_content_div_last").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    document.getElementById('haisouIP').value = b;

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
        $("#etsuransya-table tr").remove();
        for (var i = 0; i < response.length; i++) {
          html += '<tr class="show_personal_master_info" style="cursor: pointer" id="' + response[i]['bango'] + '">'
          /* for (var key in response[i])
             {*/
          //console.log(key+'='+ response[i][key]);
          html += '<td style="width:50px;text-align: center;">' + response[i]['datatxt0049'] + '</td>';
          html += '<td>' + response[i]['tantousya'] + '</td>';
          // }
          html += '</tr>'

        }

        //$("#office_master_content_div").show();
        $("#etsuransya-table").append(html);
        for (var i = 0; i < response.length; i++) {
          var datatxt0049 = response[i]['datatxt0049'].toString();
          console.log(datatxt0049)
          var d = response[i]['bango'];
          document.getElementById(response[i]['bango']).setAttribute("onclick", 'goToEtsuransyaDetail(' + d + ',"' + datatxt0049 + '")');
        }
        $("#personal_master_content_div").show();
      }
    });
  }

  function goToEtsuransyaDetail(id, datatxt0049) {
    $('#table3').find("tr").removeClass('add_border');
    $("#" + id).addClass("add_border");
    document.getElementById('etsuransyaIP').value = datatxt0049;
    console.log(datatxt0049);
    $("#office_content_div_last").hide();
    document.getElementById('choice_buttonApi').disabled = true;
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
          document.getElementById('choice_buttonApi').disabled = false;
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

  function sum() {
    var kokyaku = document.getElementById('kokyakuIP').value;
    var haisou = document.getElementById('haisouIP').value;
    var etsuransya = document.getElementById('etsuransyaIP').value;
    console.log(kokyaku, haisou, etsuransya)
    document.getElementById('insert_other9').value = kokyaku.toString() + haisou.toString() + etsuransya.toString();
    document.getElementById('edit_other9').value = kokyaku.toString() + haisou.toString() + etsuransya.toString();
    $("#office_modal4").modal('hide');
    document.getElementById('choice_buttonApi').disabled = true;
    $('#office_modal4').find("tr").removeClass('add_border');
  }

  $("#office_modal4").on('hidden.bs.modal', function () {
    $('#office_modal4').find("tr").removeClass('add_border');
  });
  $('[data-dismiss=modal]').on('click', function (e) {
    $('#office_modal4').find("tr").removeClass('add_border');
  });
</script>