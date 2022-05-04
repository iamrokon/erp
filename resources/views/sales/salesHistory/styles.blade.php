<style>
  .bg-blue {
    background: #363A81 !important;
  }

  .uskc-button {
    width: 150px;
    height: 30px;
    line-height: 30px;
  }

  .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:before,
  .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:after {
    background: #3F8CED !important;
    box-shadow: none;
    content: "\f00c";
    font-family: 'FontAwesome';
    color: #fff;
    font-size: 10px;
    font-weight: normal !important;
    top: 2px;
    text-align: center;
    border: 1px solid #3F8CED !important;
  }

  .radio-rounded .custom-radio .custom-control-label:before {
    background: #EFEFEF !important;
    border: 1px solid #CDCDCD !important;
    top: 2px
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

  .form-control:focus option {
    outline: none;
    -moz-appearance: none;
    -webkit-appearance: none;
  }

  select option:focus {
    outline: 0 !important;
    -moz-appearance: none;
    -webkit-appearance: none;
  }

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

  .custom-form .input-group-sm .form-control {
    border-radius: 4px !important;
  }
 
  .content-bottom-section,
  .footer-wrapper,.fullpage_width1 {
    min-width: 1349px !important;
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

  .table-fill.table tbody tr td select {
    border: 1px solid lightgray !important;
    border-radius: 4px !important;
    width: 100% !important;
    /* height: 28px !important; */
  }
  .table-fill.table tbody tr td select.error{
      border: 1px solid red!important;
    }
  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  .container {
    max-width: 1140px !important;
  }

  /* @media screen and (max-width: 991px) {
  .res-w-76 {
    width: 76px !important;
  }
} */
  /*custom window  changes*/
  .inner-top-content {
    margin-top: 112px !important;
  }

  .success-msg-box {
    top: 51px !important;
  }

  .common_error {
    position: relative;
    top: 60px;
    width: 100%;
    font-size: 12px !important;
    color: red;
    z-index: 2;
    word-break: break-all;
    white-space: normal;
    margin-bottom: 10px !important;
  }

  #no_found_data {
    top: 51px;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      margin-top: 88px !important;
    }
    .success-msg-box,
    .common_error {
      top: 35px !important;
    }

    #no_found_data {
      top: 25px !important;
    }

  }

  @media (max-width: 1800px) and (min-width: 280px) {
	
  .footer-wrapper {
    min-width: 1349px;
  }
}
</style>