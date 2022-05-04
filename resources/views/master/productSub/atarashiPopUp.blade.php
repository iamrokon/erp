<div class="modal" data-backdrop="static" id="product_sub_modal4" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">商品サブCD検索</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-10">
            <h4 style="margin-bottom: 15px;margin-top: 10px;">取引先</h4>
            <div style="margin-bottom: 5px;">
              <table class="table table-striped" style="border: none!important;width: auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;width: 40px!important;">カナ/名称</td>
                    <td style="border: none!important;">
                      <input type="text" class="form-control" id="lastname" placeholder="">
                    </td>
                    <td style="border: none!important;">
                      <button type="button" class="btn btn-info btn_search" data-toggle="modal" data-target="#"
                        id="product_sub_search_button" style="margin-top: 2px;">
                        検索
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <script type="text/javascript">
              $(function () {
                $('#product_sub_search_button').click(function () {
                  var value = $('#lastname').val();
                  $("#table-basic tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                  $("#product_supplier_content1").show();
                });
              });
            </script>

            <div class="table_wrap">
              <div class=" page4_table_design mt-2  table_hover  table-head-only">
                <div id="product_supplier_content1" style="display: none;">
                  <table class="table table-striped " id="table1">
                    <thead class="thead-dark header text-center" id="myHeader">
                      <tr>
                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          分類CD
                        </th>
                        <th scope="col"
                          style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">
                          分類名
                        </th>
                      </tr>
                    </thead>
                    <tbody id="table-basic" style="white-space: normal !important;">
                      @foreach($categorykanris['E4'] as $E4)
                      <tr class="product_supplier_content1_row table_hover2 gridAlternada" id="{{$E4->category2}}">
                        <td style="width: 50px; text-align: center;">{{$E4->category2}}</td>
                        <td>{{$E4->category4}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <script type="text/javascript">
                  var num1 = null;
                  var num2 = null;
                  var num3 = null;
                  $(function () {
                    $('.product_supplier_content1_row').click(function () {
                      num1 = this.id;
                      console.log(num1);
                      $('#table1').find("tr").removeClass('add_border');
                      $(this).addClass('add_border');
                      $("#product_supplier_content2").show();
                    });
                  });
                </script>

                <div id="product_supplier_content2" style="display: none;">
                  <!-- 2nd modal content -->
                  <h4 style="margin-bottom: 15px;margin-top: 15px;">データ種</h4>
                  <div style="width: 99%;">
                    <table class="table table-striped" id="table2">
                      <thead class="thead-dark header text-center" id="myHeader">
                        <tr>
                          <th scope="col"
                            style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            分類CD
                          </th>
                          <th scope="col"
                            style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                            分類名
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($categorykanris['E5'] as $E5)
                        <tr class="product_supplier_content2_row" id="{{$E5->category2}}">
                          <td style="width:50px; text-align: center;">{{$E5->category2}}</td>
                          <td>{{$E5->category4}}</td>
                        </tr>
                        @endforeach
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
          <div class="col-lg-10">
            <div id="product_supplier_content3" style="display: none;">
              <h4 style="margin-bottom: 15px; margin-top: 10px;">バージョン区分</h4>
              <div style="width: 99%;">
                <table class="table table-striped" id="table3">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                      <th scope="col"
                        style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        番号
                      </th>
                      <th scope="col"
                        style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">
                        バージョン区分名
                      </th>
                    </tr>
                  </thead>
                  <tbody style="white-space: normal !important;">
                    @foreach($request['2'] as $request)
                    <tr class="product_supplier_content3_row" id="{{'0'.$request->syouhinbango}}">
                      <td style="width:50px; text-align: center;">{{'0'.$request->syouhinbango}}</td>
                      <td>{{$request->jouhou}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{-- <button type="button" style="visibility: hidden;" id="close_popup" data-dismiss="modal">hh</button> --}}
            </div>

            <script type="text/javascript">
              $(function () {
                $('.product_supplier_content2_row').click(function () {
                  num2 = this.id;
                  console.log(num2)
                  $('#table2').find("tr").removeClass('add_border');
                  $(this).addClass('add_border');
                  if ($("#insert_other1").val() == '1') {
                    $("#insert_other2").val(num1 + num2);
                    $("#edit_other2").val(num1 + num2);
                    $("#close_popup").click();
                    $('#product_sub_modal4').find("tr").removeClass('add_border');
                  } else {
                    $("#product_supplier_content3").show();
                  }
                });
              });

            </script>

            <script type="text/javascript">
              $(function () {
                $('.product_supplier_content3_row').click(function () {
                  num3 = this.id;
                  console.log(num3)
                  $("#insert_other2").val(num1 + num2 + num3);
                  $("#edit_other2").val(num1 + num2 + num3);
                  $("#close_popup").click();
                  $('#product_sub_modal4').find("tr").removeClass('add_border');
                  $(this).addClass('add_border');
                });
              });
            </script>

          </div>
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

{{-- New Modal's Scripts Start Here --}}
<script>
  $("#product_sub_modal4").on('hidden.bs.modal', function () {
    $('#product_sub_modal4').find("tr").removeClass('add_border');
  });
  $('[data-dismiss=modal]').on('click', function (e) {
    $('#product_sub_modal4').find("tr").removeClass('add_border');
  });
</script>
{{-- New Modal's Scripts End Here --}}