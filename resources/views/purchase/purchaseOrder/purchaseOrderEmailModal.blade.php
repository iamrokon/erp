{{-- Confirm email transmission modal start here --}}

<div class="modal custom-modal d-none" data-backdrop="static" id="confirm_email_transmission_modal" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content bg-blue">
            <div class="modal-header" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel">メール送信確認</h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white" id="table-basic">
                        <tbody class="pl-4 pr-4">
                            <tr>
                                <td
                                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 5px 0px !important;border-bottom: 0px!important;">
                                    <div class="" style="font-size:16px;">
                                        発注書をメールで送信します。
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="font-size:16px;border-left: 0px !important;padding: 5px 8px 5px 2px !important;border-bottom: 0px !important;">
                                    <div class="radio-rounded d-inline-block">
                                        <div class="custom-control custom-radio custom-control-inline"
                                            style="padding-left:5px!important;">
                                            <input type="radio" class="custom-control-input" id="customRadioModal"
                                                name="modalRadio1" value="" checked="">
                                            <label class="custom-control-label" for="customRadioModal"
                                                style="font-size: 16px!important;cursor:pointer;">仕入先 </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="font-size:16px;border-left: 0px !important;border-right: 0px !important;width: 840px;border-bottom: 0px!important;padding: 5px 8px 5px 2px !important;">
                                    <div class="">
                                        よろしいですか？
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="" class="btn text-white uskc-button bg-default" data-dismiss="modal"> <i
                            class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="choice_button" class="btn uskc-button bg-teal text-white ml-2"
                        data-dismiss="modal">
                        <!--  <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->送信する
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Confirm email transmission modal end end here --}}
