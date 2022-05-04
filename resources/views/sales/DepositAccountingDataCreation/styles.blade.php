<style>
	.button_capture_wrap {
		float: right;
		margin-right: 26px;
		max-width: 81px;
		width: 100%;
	}

	/* .loading-icon {
		display: block;
		width: 40px;
		position: absolute;
		right: -30px;
		z-index: 9;
		top: -5px;
		display: none;
	} */


	.loading-icon {
		display: block;
		width: 40px;
		position: relative;
		right: 0px;
		z-index: 9;
		top: -6px;
		left: 5px;
		display: none;
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
	.fullpage_width1 {
		margin-top: 123px !important;
	}
	@media (max-width: 1800px){
		.fullpage_width1{
			margin-top: 75px !important;
		}
	}
	@media (max-width: 1800px) and (min-width: 280px) {
		.fullpage_width1 {
			min-width: 1349px;
		}
		
		
		.footer-wrapper {
			min-width: 1349px;
		}
	}

	/* .fullpage_width1 {
		min-height: 714px !important;
	} */

	.inner-top-content {
		margin-top: 0px !important;
		position: relative;
		top: 112px !important;
	}

	.common_error {
		position: relative;
		top: 78px;
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
		top: 78px;
		width: 100%;
		max-width: 1452px;
		z-index: 1;
		display: none;
	}

	@media (max-width: 1800px) {
		.common-nav .inner-top-content {
			margin-top: 0px !important;
			top: 152px !important;
		}

		.success-msg-box,
		.common_error {
			top: 112px;
		}
	}

	.custom-control-inline {
		margin-right: -9px !important;
	}
</style>