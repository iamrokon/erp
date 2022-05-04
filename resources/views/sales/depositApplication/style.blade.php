<style>
  .container {
    max-width: 1140px !important;
  }

  .fullpage_width1 {
    min-width: 1346px !important;
    min-height: 684px !important;
  }

  select,
  .form-control {
    font-size: 15.12px !important;
  }

  .data-box-bg .data-box {
    background: #fff;
    font-size: 0.8em;
  }

  .add_border {
    background: #aec7e7;
    padding: 0px;
  }

  .bg-teal3 {
    background: #0070C0;
  }

  .form-button {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
  }

  .form-button button:hover {
    background: #388af4;
    border: 1px solid #388af4;
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

  /* CSS Loader starts */
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

  .content-head-section {
    margin-bottom: 14px;
  }

  /* CSS Loader ends */

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

  /* #SI - Error Styles */
  .custom-form .error {
    border: 1px solid red !important;
    border-radius: 4px !important;
  }

  .common-nav .footer-wrapper {
    margin-top: 25px !important;
  }

  .inner-top-content {
    margin-top: 0;
    position: relative;
    top: 124px;
  }

  .success-msg-box {
    top: 73px;
  }

  .common_error {
    position: relative;
    top: 73px;
    width: 100%;
    font-size: 12px !important;
    color: red;
    margin-bottom: 10px !important;
  }

  p {
    margin-bottom: 10px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      margin-top: 0px !important;
      top: 101px;
    }

    .success-msg-box,
    .common_error {
      top: 48px;
    }
  }

  .footer-wrapper {
    min-width: 1349px !important;
  }
</style>