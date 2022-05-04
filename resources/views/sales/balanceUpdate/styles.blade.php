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
    /* right: -25px; */
    left: 155px;
    z-index: 9;
    top: -6px;
  }

  .content-head-section1 {
    padding-top: 75px;
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

  .inner-top-content {
    margin-top: 0px !important;
    position: relative;
    top: 87px;
  }

  .success-msg-box {
    top: 60px;
    position: relative;
  }

  .common_error {
    color: red;
    font-size: 12px !important;
    position: relative;
    top: 60px;
    width: 100%;
    margin-bottom: 10px;
  }

  .common_error>p {
    margin-bottom: 10px !important;
  }

  @media (max-width: 1800px) {
    .common-nav .inner-top-content {
      margin-top: 12px !important;
      top: 75px;
    }

    .success-msg-box,
    .common_error {
      top: 35px;
      position: relative;
    }
  }

  @media (max-width: 1800px) and (min-width: 280px) {
    .footer-wrapper {
      min-width: 1349px;
    }
  }
</style>