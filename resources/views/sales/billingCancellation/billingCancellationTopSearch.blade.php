<div class="content-head-section">
	<div class="container position-relative">

		{{-- Error Message Starts Here --}}
		<div id="errorMsgDiv" class="common_error"></div>
		{{-- Error Message Ends Here --}}

		<div class="row inner-top-content">
			<div class="col-12">
				<form method="POST" id='searchForm'>
					@csrf
					<input type="hidden" name="bango" id='userId' value="{{$tantousya->bango}}">
                    <input id='page_name' value='billingCancellation' type='hidden'/>
					<div class="row" style="padding-top: 0px;">
						<div class="col-4">
							<table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
								<tbody>
									<tr>
										<td style="width: 23px!important;padding: 0!important;border:0!important;">
											<div class="line-icon-box"></div>
										</td>
										<td style=" border: none!important;width: 86px!important;">締め日</td>
										<td style=" border: none!important;width: 178px;">
											<div class="custom-arrow">
												<select class="form-control" name="categorykanri" id="categorykanri" autofocus="">
													<option value="">-</option>
													@foreach($categorykanri as $val)
													<option value="{{$val->category1.$val->category2}}">
														{{substr($val->category2,-2,2).' '.$val->category4}}</option>
													@endforeach
												</select>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="ml-3 mr-3">
							<table class="table custom-form" style="margin-bottom:4px !important;">
								<tbody>
									<tr>
										<td style="width: 23px!important;border:0!important;padding-left: 0px!important;">
											<div class="line-icon-box" style="background: #353A81;"></div>
										</td>
										<td style="width: 84px!important;border: none!important;text-align: left;color: black;">
											売上請求先
										</td>
										<td style=" border: none!important;">
											<div>
												<div class="input-group input-group-sm">
													<!--                                            <input type="text" class="form-control" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                                                <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                                                    <button class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                                </div>-->
													<input type="text" id="billingCancellationSupplier" name="billingCancellationSupplier"
														readonly="" class="form-control custom_modal_input" placeholder="売上請求先"
														style="padding: 0!important;" value="">
													<input type="hidden" id="billingCancellationSupplier_db" name="billingCancellationSupplier_db"
														value="">
													<div class="input-group-append">
														<a class="input-group-text btn"
															onclick="supplierSelectionModalOpener_2('billingCancellationSupplier','billingCancellationSupplier_db','1','required','r16cd',event.preventDefault())"
															style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></a>
													</div>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
								<tbody>
									<tr>
										<td
											style="border: none!important;text-align: left;color: black;width: 110px !important;padding-left: 0px!important;">
											<div class="line-icon-box float-left mr-3"></div>
											請求日
										</td>
										<td style="border: none!important;width: 151px;">
											<div class="input-group">
												<input type="text" class="form-control" name="billingDate" id="datepicker1_oen"
													oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
													onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
													maxlength="8" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;" value="">
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
								<a id="contenthide" onclick="searchOrder()" href="#" class="btn btn-info uskc-button"
									style="width: 120px;">実 行</a>
							</div>
							<div id="loading-icon" class="loading-icon">
								<span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
