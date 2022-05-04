<div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="project_reg_modal2" tabindex="-1"
  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 350px !important;" role="document">
    <div class="modal-content bg-blue">
      <div class="modal-header" style="background-color: #fff;">
        <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px" ;>メール送信確認</h5>
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body text-white" data-bind="nextFieldOnEnter:true">
        <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">
          <!--======================= button start ======================-->
          <div class="row titlebr" style="margin-bottom: 15px;">
            検収確認書をメールで送信します。
          </div>

          <div class=" row row_data mb-1">
            <div class="radio-rounded custom-table-oh d-inline-block">
              <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                <input type="radio" class="custom-control-input" id="customRadio1" name="rd1" value="" autofocus=""
                  checked="" onclick="optionChange(this)">
                <label class="custom-control-label text-white" for="customRadio1"
                  style="font-size: 12px!important;cursor:pointer;">売上請求先</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="" onclick="optionChange(this)">
                <label class="custom-control-label text-white" for="customRadio2"
                  style="font-size: 12px!important;cursor:pointer;"> 受注先</label>
              </div>
            </div>
          </div>
          <div class="row titlebr mt-3" style="margin-bottom: 15px;">
            よろしいですか？
          </div>
          <!--======================= modal 2 table end here ======================-->
        </div>
        <div class="modal-footer border-top-0" style="padding: 0px;">
          <button type="button" id="" class="btn text-white bg-default  w-145" data-dismiss="modal"> <i class=""
              aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
          <input type="hidden" name="orderbangohidden" id="orderbangohidden" value="">
          <button type="button" id="choice_button" class="btn  w-145 bg-teal text-white ml-2" value="" onclick="sendMail(this)">
            送信する
          </button>
        </div>
        <script type="text/javascript">
          //Tab first field focus....
            $(document).on('shown.bs.modal', function (e) {
              $('[autofocus]', e.target).focus();
            });
        </script>
      </div>
    </div>
  </div>
</div>