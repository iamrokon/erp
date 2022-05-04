<style>
  .bg-teal3 {
    background: #0070C0;
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

  .alert-dismissible button:focus {
    outline: 0;
    /*box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);*/
  }

  .container {
    max-width: 1140px !important;
  }

  .disMsg {
    display: none;
  }

  .uskc-button {
    width: 150px !important;
    height: 30px;
    line-height: 30px;
  }

  .table {
    margin-bottom: 12px !important;
  }

  .fullpage_width1 {
    min-width: 1349px;
  }


  .inner-top-content {
    position: relative;
    top: 14px !important;
  }

  .common_error {
    position: relative;
    top: 48px;
    width: 100%;
    font-size: 12px !important;
    color: red;
    margin-bottom: 10px;
  }

  .common_error > p {
    margin-bottom: 10px !important;
  }


  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      top: 1px !important;
    }

    .common_error {
      top: 24px;
    }
  }

  .fullpage_width1 {
    margin-top: 123px !important;
  }

  @media (max-width: 1800px) and (min-width: 280px) {
    .fullpage_width1 {
      margin-top: 75px !important;
      min-width: 1140px;
    }
    .container.position-relative{
      top: 71px;
    }
  }

  .footer-wrapper {
    min-width: 1349px !important;
  }
</style>