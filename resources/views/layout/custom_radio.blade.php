<style>
  /* The radio_container */
  .radio_container {
    display: block;
    position: relative;
    padding-left: 22px;
    margin-bottom: 0px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  
  /* Hide the browser's default radio button */
  .radio_container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }
  
  /* Create a custom radio button */
  .radio_checkmark {
    position: absolute;
    top: 1.5px;
    left: 0;
    height: 16px;
    width: 16px;
    background-color: #eee;
    border-radius: 50%;
    border: 1px solid #3e6ec1 !important;
  }
  
  /* On mouse-over, add a grey background color */
  .radio_container:hover input ~ .radio_checkmark {
    background-color: #ccc;
  }
  
  /* When the radio button is checked, add a blue background */
  .radio_container input:checked ~ .radio_checkmark {
    background-color: #3e6ec1;
    box-shadow: 1px 1px 3px 1px lightgray;
  }
  
  /* Create the indicator (the dot/circle - hidden when not checked) */
  .radio_checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }
  
  /* Show the indicator (dot/circle) when checked */
  .radio_container input:checked ~ .radio_checkmark:after {
    display: block;
  }
  
  /* Style the indicator (dot/circle) */
  .radio_container .radio_checkmark:after {
    top: 4px;
    left: 4px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: white;
  }

  /* Custom radio - no label */
  </style>

{{-- <label class="radio_container">One
  <input type="radio" checked="checked" name="radio">
  <span class="radio_checkmark"></span>
</label> --}}