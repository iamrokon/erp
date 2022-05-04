<style>
	.button_capture_wrap {
		float: right;
		margin-right: 26px;
		max-width: 81px;
		width: 100%;
	}

	.loading-icon {
		display: block;
		width: 40px;
		position: absolute;
		right: -30px;
		z-index: 9;
		top: -5px;
		display: none;
	}

	table tr:focus {
		box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
		outline: 0;
	}

	/*=============media query===============*/

	@media only screen and (min-width: 768px) and (max-width: 1024px) {
		.button_capture_wrap {
			float: right;
			margin-right: 17px;
			max-width: 81px;
			width: 100%;
		}
	}

	@media only screen and (max-width: 767px) {
		.padd-bottm {
			padding-bottom: 9px !important;
		}

		.button_capture_wrap {
			margin-right: 36px !important;
		}

		.custom-control-label {
			margin-left: 8px !important;
		}
	}

	a.pagi-input-field {
		width: 38px;
		height: 37px;
	}

	.tag-line {
		margin-bottom: 13px;
		font-size: 12px;
	}

	.container {
		max-width: 1140px !important;
	}

	@media (max-width: 1800px) and (min-width: 280px) {
		.fullpage_width1 {
			margin-top: 75px;
			min-width: 1140px;
		}
	}

	/* .fullpage_width1 {
		min-height: 680px !important;
	} */

	.uskc-button {
		width: 150px !important;
		height: 30px;
		line-height: 30px;
	}

	.common_error {
		position: relative;
		top: 73px;
		width: 100%;
		font-size: 12px !important;
		color: red;
		margin-bottom: 10px;
	}

	p {
		margin-bottom: 10px !important;
	}

	.success-msg-box {
		position: relative;
		top: 73px;
		width: 100%;
		max-width: 1452px;
		z-index: 1;
		display: none;
	}

	.inner-top-content {
		margin-top: 0px !important;
		position: relative;
		top: 124px !important;
	}

	@media (max-width: 1800px) {
		.common-nav .inner-top-content {
			top: 160px !important;
			margin-top: 0px !important;
			
		}

		.success-msg-box,
		.common_error {
			top: 112px;
		}
	}
</style>