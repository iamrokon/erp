<style>
    .button_capture_wrap {
      float: right;
      margin-right: 26px;
      max-width: 81px;
      width: 100%;
    }
    .loading-icon {
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
        padding-bottom: 9px!important;
      }
      .button_capture_wrap {
        margin-right: 36px!important;
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

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        margin-top: 75px !important;
        margin-bottom: 24px;
        min-width: 1140px;
      }
    }


    /*Navbar, footer & button css*/
  .page-head-section {
      margin-top: 76px;
      height: 87px;
      padding: 25px 0px;
  }
  .container{
    max-width: 1920px !important;
    padding-left:240px;
    padding-right:240px;
  }

  header {
      padding: 12px 0px;
      height: 72px;
  }
  .custom-container{
    max-width: 1920px !important;
    padding: 0px 20px;
  }

  .flyout-right ul > li > a, .flyout-left ul > li > a, .flyout-mega-wrap, .mega-menu {
    top: 62px;
  }
.uskc-button{
  width: 150px !important;
  height: 30px;
  line-height: 30px;
}

.deposit-data-creation {
  margin-top: 0px!important;
  position: relative;
  top: 99px;
}

.success-msg-box{
  top: 49px;
}

.common_error {
  top: 49px;
  color: red;
  font-size: 12px !important;
  position: relative;
  width: 100%;
  z-index: 2;
}

@media (max-width: 1800px){
  .container{
    padding-left: 15px;
    padding-right: 15px;

  }
  .deposit-data-creation {
    margin-top: 75px!important;
    top: 72px;
  }

  .success-msg-box,
  .common_error {
    top: 98px;
  }
  
  .footer-wrapper {
    padding: 40px 0px 0px !important;
  }
  .footer-wrapper p {
    padding-bottom: 30px !important;
  }
}

    /*Checkbox design css start*/
    .checkbox_container {
      display: block;
      position: relative;
      padding-left: 22px;
      margin-bottom: 0px;
      cursor: pointer;
      font-size: .8rem;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      /*margin-left: 29px !important;
      margin-right: 0px !important;*/
    }

    .checkbox_container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      position: absolute;
      top: 1.5px;
      left: 0;
      height: 15px;
      width: 15px;
      background-color: #eee;
      border: 1px solid #3e6ec1 !important;
      border-radius: 4px !important;
    }
    .checkbox_container .checkmark:after {
      content: "";
      position: absolute;
      display: none;
      left: 5px;
      top: 1px;
      width: 4px;
      height: 9px;
      border: solid white;
      border-width: 0 2px 2px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
    .checkbox_container input:checked ~ .checkmark:after {
      display: block;
    }
    .checkbox_container input:checked ~ .checkmark {
      background-color: #3e6ec1;
      box-shadow: 1px 1px 3px 1px lightgrey;
    }
    /*Checkbox design css end*/

</style>