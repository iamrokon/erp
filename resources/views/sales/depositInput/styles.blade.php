<style>
	body {
		pointer-events: none;
	}

	.bg-blue {
		background: #363A81 !important;
	}

	.bg-teal3 {
		background: #0070C0;
	}

	table tr:focus {
		box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
		outline: 0;
	}

	.table-nohover .page-link:hover {
		background: white !important;
	}

	.custom-table-oh {
		position: relative;
	}

	.custom-table-oh:after {
		content: '';
		position: absolute;
		background: #D0D0D0;
		width: 1px;
		height: 20px;
		right: -15px;
		top: 3px;
	}

	.custom-arrow {
		position: relative;
	}

	.content-head-top {
		/* border-bottom: 1px solid #E1E1E1;*/
	}

	.custom-table-1 {
		position: relative;
	}

	.custom-table-1:after {
		content: '';
		position: absolute;
		background: #D0D0D0;
		width: 1px;
		height: 90px;
		right: -15px;
		top: 3px;
	}

	.tag-line {
		margin-bottom: 13px;
		font-size: 12px;
	}

	.form-button {
		padding: 10px;
		text-align: right;
		border-radius: 5px;
	}

	.form-button .btn {
		width: 163px;
	}

	.form-button .btn-success {
		background: #009943;
	}

	.form-button .btn-primary {
		background: #2C66B0;
	}

	select:focus option {
		outline: none;
		-moz-appearance: none;
		-webkit-appearance: none;
	}

	.form-control:focus option {
		outline: none;
		-moz-appearance: none;
		-webkit-appearance: none;
	}

	/*select option:focus{
       outline: 0;
      -moz-appearance: none;
      -webkit-appearance: none;
    }*/
	.w-145 {
		width: 145px;
	}

	.border-line-area {
		position: relative;
	}

	.border-line-area:before {
		position: absolute;
		right: 9px;
		height: 26px;
		background: #D0D0D0;
		width: 1px;
		content: '';
	}

	.custom-data-modal .bg-white {
		background: #fff !important;
	}

	@media only screen and (max-width: 767px) {
		.radio-rounded .custom-control {
			margin-left: 10px !important;
			margin-right: 14px !important;
		}

		.radio-rounded {
			margin-left: 17px !important;
		}

		.pagi {
			margin-top: 12px;
		}

		.right-pagi {
			padding-top: 9px;
		}
	}

	.line-title:after {
		background: transparent !important;
	}

	.custom-form .error {
		border: 1px solid red !important;
		border-radius: 4px !important;
	}

	.custom-form .billing_address.error {
		border: 1px solid red !important;
	}

	.alert-dismissible button:focus {
		outline: 0;
		/*box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);*/
	}

	.inner-top-content {
		position: relative;
		top: 26px !important;
	}

	.success-msg-box {
		top: 60px !important;
	}

	.common_error {
		position: relative;
		top: 60px;
		width: 100%;
		font-size: 12px !important;
		color: red;
		margin-bottom: 10px;
	}

	.common_error>div>p,
	p {
		margin-bottom: 10px !important;
		padding-left: 0px !important;
	}

	@media (max-width: 1800px) {

		.common-nav .inner-top-content {
			top: 13px !important;
		}

		.success-msg-box,
		.common_error {
			top: 35px !important;
		}

	}
	.deposit_branch {
		pointer-events: none;
	}
</style>