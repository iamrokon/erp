<div class="row cancellation_Of_preOrders_top">
	<div class="col-12">
		<div class="row" style="padding-top: 0px;">
			<div class="col-3">
                <input type="hidden" name="user_id" id="user_id" value="{{$bango}}">
				<table class="table custom-form" style="border: none!important;width: auto;margin-bottom: 2px!important;">
				<tbody>
					<tr>
					<td style="width: 23px!important;padding: 0!important;border:0!important;">
						<div class="line-icon-box"></div>
					</td>
					<td style=" border: none!important;width: 88px!important;">受注番号</td>
					<td style=" border: none!important;width: 178px;">
                        <input type="text" class="form-control" name="order_no" id="order_no"
                               oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                               placeholder="" maxlength="10" autocomplete="off" style="width: 96px!important;"
                               value="">
					</td>
					</tr>
				</tbody>
				</table>
			</div>
			<div class="col-3">
				<table class="table custom-form" style="border: none!important;margin-bottom: 2px!important;">
				<tbody>
					<tr>
					<td style=" border: none!important;">
						<input  type="text" class="form-control" autocomplete="off" value="" placeholder="受注先" readonly>
					</td>
					</tr>
				</tbody>
				</table>
			</div>
			<div class="col-3">
				<table class="table custom-form" style="border: none!important;margin-bottom: 2px!important;">
				<tbody>
					<tr>
					<td style=" border: none!important;">
						<input  type="text" class="form-control" autocomplete="off" value="" placeholder="売上請求先" readonly >
					</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="padding-top: 0px;">
			<div class="col-3">

			</div>
			<div class="col-4">
			<table class="table custom-form" style="border: none!important;">
				<tbody>
				<tr>
					<td style=" border: none!important;">
					<input  type="text" class="form-control" autocomplete="off" value="" placeholder="受注件名" readonly>
					</td>
				</tr>
				</tbody>
			</table>
			</div>
			<div class="col-2">
			<table class="table custom-form" style="border: none!important;">
				<tbody>
				<tr>
					<td style=" border: none!important;">
					<input  type="text" class="form-control text-right" autocomplete="off" value="" placeholder="-999,999,999" readonly >
					</td>
				</tr>
				</tbody>
			</table>
			</div>
		</div>
		<div class="row">
			<div class="ml-3 mr-3">
			<table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
				<tbody>
				<tr>
					<td style="border: none!important;text-align: left;color: black;width: 113px !important;">
					<div class="line-icon-box float-left mr-3"></div>
					取消日
					</td>
					<td style="border: none!important;width: 178px;">
					<!-- <div class="input-group">
						<input id="datepicker2_oen" autocomplete="off" type="text" class="form-control input_field" value="" placeholder="年/月/日" style="width: 96px!important;">
					</div> -->
					<div class="input-group">
								<input type="text" class="form-control" id="datepicker1_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
									onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
										maxlength="10"
										autocomplete="off" placeholder="年/月/日"
										style="width: 96px!important;" value="">
								<input type="hidden" class="datePickerHidden">
							</div>
					</td>
				</tr>
				</tbody>
			</table>
			</div>
		</div>
		<div class="row">
			<div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
			<div>
				<button id="contenthide" href="#" class="btn btn-info uskc-button">実 行
				</button>
			</div>
			<div class="loading-icon" style="">
				<span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
			</div>
			</div>
		</div>
	</div>
  </div>
