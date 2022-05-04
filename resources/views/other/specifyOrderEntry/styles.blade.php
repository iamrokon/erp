<style>
  button:focus{
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
  }


    /*=============royal pagination css===============*/
    .switch {
      position: relative;
      display: inline-block;
      width: 62px;
      height: 29px;
    }

    .switch-area label {
      margin-bottom: 0px !important;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #7F7F7F;
      border-radius: 4px;
      -webkit-transition: .4s;
      transition: .4s;
      border: 1px solid #0070C0;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 27px;
      width: 30px;
      left: 1px;
      bottom: 0px;
      right: 1px;
      background-color: #FFC000;
      border-radius: 4px;
      -webkit-transition: .4s;
      transition: .4s;
      /*border-left: 1px solid #0070C0;
        border-top: 1px solid #0070C0;
        border-bottom: 1px solid #0070C0;*/
    }

    .slider span.on {
      float: left;
      line-height: 30px;
      margin-left: 5px;
      color: #fff;
      display: none;
    }

    input:checked+.slider span.on {
      display: block;
    }

    .slider span.off {

      float: right;
      line-height: 30px;
      margin-right: 2px;
      color: #fff;
    }

    input:checked+.slider span.off {
      display: none;
    }

    input:checked+.slider {
      background-color: #0070C0;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
      background: white;
    }
    .common-navbar .content-head-section{
      padding: 0px;
      min-height: 0px !important;
    }


    /*
---------------------------------------
  Css Loader
 --------------------------------------

  /*Navbar, footer & button css*/ 
  .specify_orderEntry {
    margin-top: 0px!important;
    position: relative;
    top: 111px;
  }


  .success-msg-box {
    top: 75px;
    position: relative;
  }

  .common_error {
    top: 56px;
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
    .fullpage_width1 {
		min-height: 641px!important;
	}

  .inner-top-content {
    margin-top: 111px !important;
}
@media (max-width: 1800px){
  .common-nav .inner-top-content {
    margin-top: 85px !important;
}
  .success-msg-box,
    .common_error {
      top: 45px;
      position: relative;
    }
    .custom-mb{
      margin-bottom: 95px!important;
    }
    .specify_orderEntry{
      margin-top: 0px !important;
      top: 88px !important;
    }
    .fullpage_width1 {
		min-height: 363px!important;
	}
}

  </style>