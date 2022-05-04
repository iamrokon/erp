<style>
  .bg-teal3 {
    background: #0070C0;
  }

  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  .content-head-section1 {
    padding-top: 25px;
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

  .content-head-section1 {
    padding-top: 112px;
  }

  @media (max-width: 1800px){
    .content-head-section1 {
      padding-top: 1px;
    }
    .fullpage_width1 {
      min-width: 1349px;
      margin-top: 75px !important;
    }
    
  }

  /*custom window  changes*/
  .inner-top-content {
    position: relative;
    top: 0px !important;
    margin-top: 0px !important;
  }

  .success-msg-box {
    top: 62px !important;
  }

  .common_error {
    color: red;
    font-size: 12px !important;
    position: relative;
    top: 62px;
    width: 100%;
    margin-bottom: 10px;
  }


  .common_error div p {
    margin-bottom: 10px !important;
  }

  .success-msg-box,
  .common_error {
    top: -39px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      top: 85px !important;
     
    }

    .success-msg-box,
    .common_error {
      top: 108px !important;
    }
  }

  @media (max-width: 1800px) and (min-width: 280px) {
    .footer-wrapper {
      min-width: 1349px;
    }
  }


  /* @media (max-width: 1024px) {
    .deposit-sys-application {
      margin-top: 138px !important;
    }
  } */
</style>