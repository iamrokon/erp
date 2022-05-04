{{-- line confirm delation  modal for deposit input start here --}}
<div class="modal custom-data-modal" data-backdrop="static" id="confirm_purchase_slip_line_delete" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <input type="hidden" id="lineItemId">
    <div class="modal-dialog" role="document" style="max-width: 415px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2  border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><button class="btn"  style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 7px;height: 26px;line-height: 23px;font-size:12px;cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></button></h5>
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
                                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                                <div class="" style="color:#fff!important;font-size:16px;">
                                    現在行を削除しますか？
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="submit_modal" class="btn text-white bg-teal" >
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>はい
                    </button>
                    <button type="button" id="close_modal" class="btn bg-teal text-white ml-2" >
                         いいえ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- line confirm delation modal end end here --}}
