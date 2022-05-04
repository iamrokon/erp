<style>
  .header-fixed {
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 99;
    background: white;
  }

  .loading-icon {
    display: block;
    width: 40px;
    position: absolute;
    right: -58px;
    z-index: 9;
    /* font-size: 42px; */
    top: -7px;
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
      margin-top: 60px !important;
    }
  }

  .show:before {
    display: block;
  }

  .loading.show {
    display: block !important;
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

  .loading {
    width: 50px !important;
  }

  .uskc-button {
    width: 150px;
    height: 30px;
    line-height: 30px;
  }

  .inner-top-content {
    position: relative;
    top: 87px !important;
    margin-top: 0px;
  }

  .success-msg-box {
    top: 60px !important;
  }

  .common_error {
    color: red;
    font-size: 12px !important;
    margin-bottom: 10px;
    position: relative;
    top: 60px;
    width: 100%;
    display: none;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      top: 75px !important;
      margin-top: 12px !important;
    }

    .success-msg-box,
    .common_error {
      top: 35px !important;
    }
  }
</style>