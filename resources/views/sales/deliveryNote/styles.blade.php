<style>
	body {
		pointer-events: none;
	}

	.w-145 {
		width: 145px;
	}

	table tr:focus {
		box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
		outline: 0;
	}

	.checkbox_container input:checked~.checkmark {
		box-shadow: none !important;
	}

	.checkbox_container input:focus~.checkmark {
		box-shadow: none !important;
	}

	select:focus::-ms-value {
		background: transparent !important;
	}

	.pl-m-non-res {
		padding-left: 0px !important;
	}

	.span-font {
		font-size: 0.8em !important;
	}

	.m_t {
		margin-top: 7px;
	}

	.removeBorder {
		border: none;
		padding: 0px;
	}

	.show_office_master_info,
	.show_personal_master_info,
	.show_content_last {
		cursor: pointer;
	}

	.table_hover2_pagi .nav_mview {
		margin-bottom: 0px !important;
	}

	.box-dark {
		width: 13px;
		height: 13px;
		background-color: #333;
		color: #fff;
		text-align: right;
		float: right;
		cursor: pointer;
	}

	.m_t {
		margin-top: 7px;
	}

	.hidden-left-div {
		display: none;
	}

	.m-pl-15 {
		padding-left: 0px !important;
	}

	.m-pr-15 {
		padding-right: 0px !important;
	}

	.pl-md {
		padding-right: 15px;
	}

	.link-hover a {
		position: relative;
		display: inline-block;
		color: royalblue;
		font-weight: 800;
		text-decoration: none;
		overflow: hidden;
		vertical-align: middle;
		margin-left: 10px;
	}

	.link-hover {
		display: inline-block;
	}

	.link-hover a:hover {
		text-decoration: none;
	}

	.link-hover a:before {
		position: absolute;
		content: attr(data-content);
		top: 0;
		left: 0;
		width: 0;
		color: midnightblue;
		white-space: nowrap;
		overflow: hidden;
		transition: width 875ms ease;
	}

	.link-hover a:hover:before {
		width: 100%;
		text-decoration: none;
	}

	.pr-m {
		padding-left: 0px !important;
	}

	.input-data {
		background: #EFEFEF;
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

	.split-mark {
		margin-top: 30px;
	}

	.tag-line {
		margin-bottom: 13px;
		font-size: 12px;
	}

	.form-button {
		background: #fff;
		padding: 10px;
		text-align: center;
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

	/* Scrollbar Custom Height & Width */
	.scrollbararea::-webkit-scrollbar {
		width: 5px;
		height: 5px;
	}

	.scrollbararea::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 60px rgba(203, 203, 203, 1);
		-webkit-border-radius: 0px;
		border-radius: 0px;
	}

	.scrollbararea::-webkit-scrollbar-thumb {
		-webkit-border-radius: 0px;
		border-radius: 0px;
		background: rgba(44, 102, 176, 1);
		-webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
	}

	@media only screen and (min-width: 1024px) {
		.mpl-15 {
			padding-right: 0px !important;
		}

		.hidden-left-div {
			display: block;
		}
	}

	@media only screen and (max-width: 768px) {
		.mpl-15 {
			padding-right: 15px !important;
		}

		.hidden-left-div {
			display: block;
		}
	}

	@media only screen and (max-width: 767px) {
		.pl-m-non-res {
			padding-left: 0px !important;
		}

		.hidden-left-div {
			display: block;
		}

		.m-text-l {
			text-align: center;
			margin-top: 10px !important;
		}

		.mpl-15 {
			padding-right: 10px !important;
		}

		.m-pl-15 {
			padding-left: 15px !important;
		}

		.m-pr-15 {
			padding-right: 15px !important;
		}

		.rounded_table_wrap {
			width: 50%;
			padding-left: 15px !important;
		}

		.nav_mview {
			margin-bottom: 15px !important;
		}

		.pagi-input-field {
			height: 36px !important;
		}

		.border_none_table td {
			border: 1px solid #29487d !important;
			padding: 4px;
		}

		.pr-m {
			padding-left: 15px !important;
		}
	}

	.bg-teal3 {
		background: #0070C0;
	}

	table td {
		overflow: hidden;
	}

	.td-border-line:after {
		content: '';
		position: absolute;
		background: #D0D0D0;
		width: 1px;
		height: 26px;
		left: 15px;
		top: 7px;
	}

	.loading-icon {
		display: block;
		width: 40px;
		position: absolute;
		right: 319px;
		z-index: 9;
		top: -7px;
	}

	@media only screen and (min-width: 768px) and (max-width: 992px) {
		#tbl_border_none {
			width: 100%;
			margin-bottom: 10px;
			float: right;
		}
	}

	#tbl_border_none {
		float: right;
	}

	@media only screen and (max-width: 767px) {
		#tbl_border_none {
			margin-left: 0px;
			float: none !important;
		}

		#userTable .btn-m-view {
			margin-bottom: 0px !important;
		}

		/* .btn-view.btn-m-view {
            width: 92px !important;
        } */
	}

	ul.pagination li a {
		color: #fff !important;
	}

	ul.pagination li a:hover {
		color: #333 !important;
	}

	.check-line {
		position: relative;
	}

	.check-line:before {
		position: absolute;
		left: 4px;
		width: 98px;
		height: 2px;
		background: #000;
		z-index: 999;
		content: '';
		top: 2px;
	}

	.custom-form .error {
		border: 1px solid red !important;
		border-radius: 4px !important;
	}

	/* CSS Loader */
	.preloader {
		position: absolute;
		left: 0;
		right: 0;
		text-align: center;
		margin: 0 auto;
		z-index: 9999;
	}

	.loading {
		position: fixed;
		z-index: 999;
		height: 2em;
		width: 2em;
		overflow: show;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		background-color: #fff;
	}

	.loading:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: #000;
		opacity: .5;

	}

	.disable {
		pointer-events: none;
		cursor: default;
	}

	.loading:not(:required) {

		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0;
	}

	.loading:not(:required):after {
		content: '';
		display: block;
		font-size: 10px;
		width: 5.0em;
		height: 5.0em;
		margin-top: -0.5em;
		-webkit-animation: spinner 1500ms infinite linear;
		-moz-animation: spinner 1500ms infinite linear;
		-ms-animation: spinner 1500ms infinite linear;
		-o-animation: spinner 1500ms infinite linear;
		animation: spinner 1500ms infinite linear;
		border-left: 4px solid rgba(237, 237, 237, 0.7);
		border-right: 4px solid rgba(237, 237, 237, 0.7);
		border-bottom: 4px solid rgba(237, 237, 237, 0.7);
		border-top: 4px solid #408eee;
		border-radius: 100%;
	}


	@-webkit-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	@-moz-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	@-o-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	@keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	.loading.show {
		display: block !important;
	}

	.container {
		max-width: 1140px !important;
	}

	/*custom window  changes*/
	.inner-top-content {
		position: relative;
		top: 26px !important;
	}

	.success-msg-box {
		top: 59px !important;
	}

	.common_error {
		position: relative;
		top: 59px;
		width: 100%;
		font-size: 12px !important;
		color: red;
		margin-bottom: 10px;
		white-space: normal;
		word-break: break-all;
	}

	.common_error > div > p {
		margin-bottom: 10px !important;
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

	.scrollbararea::-webkit-scrollbar {
		width: 10px;
		height: 10px;
	}

	.scrollbararea::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 60px #cbcbcb;
		box-shadow: inset 0 0 60px #cbcbcb;
		border-radius: 100px;
	}

	.scrollbararea::-webkit-scrollbar-thumb {
		border-radius: 100px;
		background: #2c66b0;
		-webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
		box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.5);
	}
</style>