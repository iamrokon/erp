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
  table tr:focus{
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

  {{-- .content-head-section1 {
    padding-top: 112px;
  }  --}}





@media (max-width: 1800px) and (min-width: 280px) {
    .fullpage_width1 {
      min-width: 1140px;
      margin-top: 75px !important;
    }
    .container.position-relative {
      margin-top: 60px !important;
    }
/*
    .content-head-section {
      margin-top: 123px;
    }*/
  }



.cancellation_Of_UnearnedSales_top {
    min-width: 1349px!important;
    /* max-width: 1349px!important; */
  }
  .content-bottom-section,
  .footer-wrapper {
    min-width: 1349px !important;
  }



/*Custom design css*/
 
  .cancellation_Of_preOrders_top {
    margin-top: 0px!important;
    position: relative;
    top: 99px;
  }

  .success-msg-box {
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

  .common_error>p {
    margin-bottom: 10px !important;
  }

  .custom-mb{
    margin-bottom: 124px!important;
  }
@media (max-width: 1800px){
  .error-div{
    min-height: 1px;
  }
  .success-msg-box,
  .common_error {
    top: 35px;
    
  }
  .custom-mb{
    margin-bottom: 95px!important;
  }
  .cancellation_Of_preOrders_top{
    margin-top: 75px !important;
    top: 12px !important;
  }
}

