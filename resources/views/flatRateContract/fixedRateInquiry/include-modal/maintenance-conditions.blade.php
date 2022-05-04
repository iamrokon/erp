<div class="modal custom-data-modal" data-backdrop="static" id="maintenanceCondition" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>保守条件</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white custom-form" id="table-basic">
                        <tbody class="pl-4 pr-4">
                        <tr>
                            <td class="border-left-0"
                                style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                                <div class="line-icon-box"></div>保守窓口
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" value="{{$fixed_rate_inquiry->maintenance_window}}" readonly>
                                    <div class="input-group-append" data-toggle="modal" >
                                        <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>窓口数
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <input type="text" class="form-control" value="{{$fixed_rate_inquiry->number_of_windows}}" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                                <div class="line-icon-box"></div>保守会社
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" value="{{$fixed_rate_inquiry->maintenance_company}}" readonly/>
                                    <div class="input-group-append" data-toggle="modal">
                                        <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                                <div class="line-icon-box"></div>保証書番号
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"  style="border-radius: 4px !important;" value="{{$fixed_rate_inquiry->warranty_number}}" readonly/>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal">
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
                        入力する
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
