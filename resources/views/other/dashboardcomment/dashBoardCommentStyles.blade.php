<style>

  p {
    margin-bottom: 10px !important;
  }
  .footer-wrapper p{
    margin-bottom: 0px !important;
  }
  .cke_bottom {
    display: none !important;
  }

  .pl-m {
    padding-left: 0px !important;
  }

  /* .largeTable {
    padding-bottom: 10px;
    height: 455px;
    overflow: auto;
  } */

  .content-head-top {
    border-bottom: 1px solid #E1E1E1;
  }

  .input-data {
    background: #EFEFEF;
  }

  .custom-table-1 {
    position: relative;
  }

  label:focus {
    outline: none !important;
    /*or outline-color:#FFFFFF; if the first doesn't work*/

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

  @media only screen and (min-width: 1400px) {
  .left_right_margin {
      margin-bottom: : 0px;
    }
  }

  .m_t {
    margin-top: 7px;
  }

  @media only screen and (max-width: 767px) {
    .rounded_table_wrap {
      width: 50%;
      padding-left: 15px !important;
    }

    .button-responsive-view {
      padding: 0 !important;
      padding-top: 10px !important;
    }

    .pl-m {
      padding-left: 15px !important;
    }

    .nav_mview {
      margin-bottom: 15px !important;
    }

    .pagi-input-field {
      height: 36px !important;
    }

    .radio-rounded {
      margin-left: 12px !important;
    }
  }

  .border_none_table td {
    border: 1px solid #29487d !important;
    padding: 4px;
  }

  .form-control-custom-input {
    border: 1px solid #29487d !important;
    background: white;
    height: 28px !important;
    margin-top: 2px;
    border-radius: 0px !important;
  }

  .form-control-custom-input {
    display: block;
    width: auto;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-border-radius: 0.25rem;
    border-radius: 0.25rem;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
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
  .loading.hide {
      display: none !important;
  }

  @media (max-width: 1800px) and (min-width: 280px) {
    .fullpage_width1 {
      min-width: 0;
    }
  }

  @media (max-width: 1800px) and (min-width: 992px) {

    #datepicker1_c,
    #datepicker2_c,
    #datepicker3_c,
    #datepicker4_c {
      max-width: 228px;
    }
  }

  .header-checkbox {
    margin-top: 5px;
    margin-left: 15px !important;
  }

  @media only screen and (max-width: 767px) {
    .header-checkbox {
      margin-left: 0 !important;
    }
  }

  /* CKEditor Styles Starts Here */
  body {
    --ck-z-default: 100;
    --ck-z-modal: calc(var(--ck-z-default) + 999);
  }

  .cke_dialog tr td:first-child {
    width: 500px !important;
  }

  /* CKEditor Styles Ends Here */

  @media (max-width: 1800px) and (min-width: 280px) {

    /* .fullpage_width1, */
  .footer-wrapper {
    min-width: 1349px !important;
  }
}


  .input-file-container1 {
    width: 80px !important;
  }

  /*custom window  changes*/
  .inner-top-content {
    position: relative;
    top: 0px !important;
  }
  .common_error {
    position: relative;
    top: 60px;
    width: 100%;
    font-size: 12px !important;
    color: red;
    margin-bottom: 10px;
    word-break: break-all;
    white-space: normal;
  }
  .success-msg-box, .common_error {
    top: 63px !important;
}
  @media (max-width: 1800px) {
  
    .common-nav .inner-top-content {
      top: 0px !important;
      margin-top: 57px !important;
    }
    .common_error,
    .success-msg-box {
      top: 32px !important;
    }
  

  }

</style>
