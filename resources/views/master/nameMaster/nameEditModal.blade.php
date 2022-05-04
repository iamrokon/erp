<form id="editForm" action="{{ route('postEditNameMaster',[$bango]) }}" data-editmethod="editName" method="post">
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" name="edit_bango" id="edit_bango1" value="">
    <input type="hidden" name="validate_only" value="1">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="name_modal3" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt mt-0" style="margin: 11px !important;">

            {{-- Error Message Starts Here --}}
            <div class="col-12 pl-0" style="margin-left: -25px !important;">
              <div id="error_dataEdit"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-6 pl-1">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>名称マスタ(変更)</h5>
                        <div class="mt-3">変更(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6 pr-1">
                <div style="float: right;">
                  <button type="button" class="btn btn-info" id="editButton" onclick="editName('{{route("postEditNameMaster",[$bango])}}');" autofocus>
                    <i class="fas fa-save" style="margin-right: 5px;" ></i>保存
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div id="input_boxwrap_n2" class="input_boxwrap_n2 custom-form" >
            <div class="row mt-1 mb-3">
              <div class="col-lg-12">
                <div class="tbl_name">
                  <div class="w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t ">
                          <span>名称CD <span style="color: red;">※</span></span>
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="UA" id="edit_category1" name="category1" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>分類CD<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="01" id="edit_category2" name="category2" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>名称名<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="受注区分" id="edit_category3" name="category3" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>分類名<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="新規受注" id="edit_category4" name="category4">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>名称名略称</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_category5" name="category5" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>分類名略称</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_groupbango" name="groupbango">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>分類CD桁数</span><span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_osusume" name="osusume" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>表示順</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_suchi1" name="suchi1">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t " style="margin-top:12px;"><span>変更可否</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="radio-rounded d-inline-block" style="margin-top:10px;margin-bottom:8px;">

                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="changed3" name="edit_changed" value="1 可"/>
                                  <label class="custom-control-label" for="changed3" style="font-size: 12px!important;cursor:pointer;">可 </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left: 26px!important;">
                                  <input type="radio" class="custom-control-input" id="changed4" name="edit_changed" value="2 不可" />
                                  <label class="custom-control-label" for="changed4" style="font-size: 12px!important;cursor:pointer;"> 不可 </label>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>予備1</span> </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_spare_one" name="spare_one">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>予備2</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_spare_two" name="spare_two">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>予備3</span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" class="form-control" value="" id="edit_spare_three" name="spare_three">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</form>
