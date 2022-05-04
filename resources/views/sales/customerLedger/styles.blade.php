<style>
	.largeTable {
		max-height: 800px;
		padding-bottom: 20px
	}
	table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
}
	.pl-m {
		padding-left: 0px !important;
	}

	.pl-m-non-res {
		padding-left: 0px !important;
	}

	.m_t {
		margin-top: 7px;
	}

	.box-wrap {
		height: 30px;
	}

	@media screen and (min-width:992px) and (max-width: 1024px) {
		.overflow-wrapper-100 {
			display: block !important;
			width: 100%;
			overflow-x: auto;
			position: relative;
		}

		.overflow-inner {
			display: block !important;
			width: 1500px;
			/* float:left;*/
		}
	}

	@media screen and (max-width: 1350px) {
		.overflow-wrapper-100 {
			display: block !important;
			width: 100%;
			overflow-x: auto;
			position: relative;
		}

		.overflow-inner {
			display: block !important;
			width: 1500px;
			/* float:left;*/
		}
	}


	/*=============media query===============*/

	@media only screen and (max-width: 767px) {
		.pl-m {
			padding-left: 15px !important;
		}

		.bordera {
			padding: 7px !important;
		}

		.padd-bottm {
			padding-bottom: 9px !important;
		}

		.overflow-wrapper-100 {
			display: block !important;
			width: 100%;
			overflow-x: auto;
			position: relative;
		}

		.overflow-inner {
			display: block !important;
			width: 1300px;
			/* float:left;*/
		}

		.pl-m-non-res {
			padding-left: 0px !important;
		}
	}

	.removeBorder {
		border: none;
		padding: 0px;
	}

	.td-border-line:after {
		content: '';
		position: absolute;
		background: #D0D0D0;
		width: 1px;
		height: 26px;
		left: 15px;
		top: 3px;
	}

	@media screen and (min-width: 1900px) {
		.largeTable {
			margin-bottom: 70px;
		}
	}

	.content-head-section {
		padding: 0;
		min-height: 0;
	}

	@media (max-width: 767px) {
		.customer-ledger {
			margin-top: 55px !important;
		}
	}

	.pagination li a.page-link {
		background: #2C66B0 !important;
		color: white !important;
	}

	@media screen and (max-width: 991px) {
		.res-w-76 {
			width: 76px !important;
		}
	}

	@media only screen and (max-width: 767px) {
		.btn-m-view {
			width: 150px !important;
			margin-bottom: 10px;
		}
	}

	.uskc-button {
		width: 150px;
		height: 30px;
		line-height: 30px;
	}

	.container {
		max-width: 1140px !important;
	}

	/*custom window  changes*/
	.inner-top-content {
		position: relative;
		top: 27px !important;
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

	@media (max-width: 1800px) {
		.common-nav .inner-top-content {
			top: 14px !important;
		}

		.common_error {
			top: 48px;
		}

		.content-button-section {
			margin-bottom: 39px !important;
		}
	}
	/* Removing first row (td) stickyness */
	#userTable tbody tr:nth-child(1) td {
    position: -webkit-static !important;
    position: static !important;
    top: 43px;
    z-index: 1;
  }
</style>