<form id="editForm" action="{{ route('postEditSeqNumberingMaster',[$bango]) }}" method="post"
  data-editmethod="editSeqNumbering"
  onsubmit="editSeqNumbering('{{route("postEditSeqNumberingMaster",[$bango])}}');event.preventDefault();">
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" id="hiddenBango1" name="review_bango" value="">

  <div class="modal" data-keyboard="false" data-backdrop="static" id="seq_numbering_edit_modal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt mt-0" style="margin:11px;">

            {{-- Error Message Starts Here --}}
            <div class="row">
              <div id="edit_error_data" style="margin-left: -12px !important;"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <!-- #SI - code starts here -->
            <!-- Title with buttons start here -->
            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-6 pl-1">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>SEQ番号付番マスタ(変更)</h5>
                        <div class="mt-3">変更(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-6 pr-2">
                <div style="float: right;">
                  <button type="submit" id="editButton" class="btn btn-info" autofocus="">
                    <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                  </button>
                </div>
              </div>

            </div>
            <!-- Title with buttons ends here -->
            <!-- #SI - code ends here -->
          </div>

          <div id="input_boxwrap_seq2" class="input_boxwrap_seq2 custom-form">
            <div class="row mt-1 mb-3">
              <div class="col-lg-12">
                <div class="tbl_name">
                  <div class="w-100">

                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t ">
                          <span>番号区分<span style="color: red;">※</span></span>
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" id="edit_kokyakusyouhinbango_detail" class="form-control" readonly>
                            <input name="kokyakusyouhinbango" id="edit_kokyakusyouhinbango" type="hidden">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>番号<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input name="orderbango" id="edit_orderbango" type="text" class="form-control" autofocus>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>番号総桁数<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input name="mobile_flag" id="edit_mobile_flag" type="text" class="form-control">
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
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</form>

{{-- <script>
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script> --}}