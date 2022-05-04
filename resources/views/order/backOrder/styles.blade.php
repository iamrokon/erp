<style>
  .tbl_long_height {
    max-height: 580px;
    padding-bottom: 20px;
    overflow-x: auto;
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
    right: -12px;
    top: 3px;
  }

  .pl-m {
    padding-left: 0px !important;
  }

  .box-wrap {
    height: 30px;
  }

  .pl-m-non-res {
    padding-left: 0px !important;
  }

  .content-head-top {
    border-bottom: 1px solid #E1E1E1;
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
    }
  }

  /*=============media query===============*/
  @media only screen and (max-width: 992px) and (min-width: 320px) {
    .bgcolr_common {
      margin-top: 73px !important;
    }
  }

  @media only screen and (max-width: 767px) {
    .nav_mview {
      margin-bottom: 0px !important;
    }

    .m-p-10 {
      padding: 0px 10px;
    }

    .pl-m {
      padding-left: 15px !important;
    }

    .pl-m-non-res {
      padding-left: 0px !important;
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
    }

    .margin_l_custom {
      margin-left: 28px !important;
    }

    .radio-rounded .custom-control {
      margin-left: 10px !important;
      margin-right: 14px !important;
    }

    .radio-rounded {
      margin-left: 17px !important;
    }
  }

  table tr:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: 0;
  }

  .bg-teal3 {
    background: #0070C0;
  }

  #userTable tbody tr td input.error {
    border: 1px solid red !important;
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

  /*custom window  changes*/
  .inner-top-content {
    margin-top: 111px !important;
  }

  .success-msg-box {
    top: 73px !important;
  }

  .common_error {
    position: relative;
    top: 73px;
    width: 100%;
    font-size: 12px !important;
    color: red;
    z-index: 2;
    word-break: break-all;
    white-space: normal;
    margin-bottom: 10px !important;
  }

  .common_error>p {
    padding-top: 0px !important;
    margin-bottom: 10px !important;
  }

  @media (max-width: 1800px) {

    .common-nav .inner-top-content {
      margin-top: 88px !important;
    }

    .success-msg-box,
    .common_error {
      top: 48px !important;
    }
  }

  .form-button {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
  }
</style>