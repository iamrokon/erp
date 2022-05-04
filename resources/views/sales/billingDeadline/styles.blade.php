<style>
  .bg-teal3 {
    background: #0070C0;
  }

  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

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

  .inner-top-content {
    margin-top: 69px !important;
  }

  @media (max-width: 1800px) and (min-width: 280px) {
    .fullpage_width1 {
      margin-top: 75px !important;
      min-width: 1140px;
    }
    .content-head-section1{
      margin-top: 52px;
    }
    .common-nav .inner-top-content {
      margin-top: 66px !important;
    }
  }

  .show:before {
    display: block;
  }

  .loading.show {
    display: block !important;
  }

  .success-msg-box {
    top: 39px !important;
  }
  .common_error {
    color: red;
    font-size: 12px !important;
    position: relative;
    top: 39px;
    width: 100%;
    margin-bottom: 10px;
  }

  #error_message {
    top: 39px !important;
  }

  #error_data {
    margin-top: -1px;
  }
  
  .common_error > p {
    margin-bottom: 10px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      top: 0px !important;
    }

    .success-msg-box,
    .common_error {
      top: 33px !important;
    }

    #error_message {
      top: 33px !important;
    }
  }

  #main_msg>p {
    margin-bottom: 0rem !important;
  }
  @media (max-width: 1800px) and (min-width: 280px) {
	
  .footer-wrapper {
    min-width: 1349px;
  }
}
</style>