<style>
  /* The container */
  .checkbox_container {
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
    margin-left: 0px !important;
    margin-right: 0px !important;
    
  }

  /* Hide the browser's default checkbox */
  .checkbox_container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
    
  }

  /* Create a custom checkbox */
  .checkmark {
    position: absolute;
    top: 1.5px; /* checkbox top margin */
    left: 0;
    height: 16px;
    width: 16px;
    background-color: #eee;
    border: 1px solid #3e6ec1 !important; /* checkbox border */
    border-radius: 4px !important; /* checkbox rounded corner */
    
  }

  /* On mouse-over, add a grey background color */
  .checkbox_container:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the checkbox is checked, add a blue background */
  .checkbox_container input:checked ~ .checkmark {
    background-color: #3e6ec1; /* checkbox background color */
    box-shadow: 1px 1px 3px 1px lightgray; /* checkbox shadow */
  }

  /* When the checkbox is focused, adding box shadow */
  .checkbox_container input:focus ~ .checkmark {
  box-shadow: 1px 1px 5px 1px lightgray; /* focused shadow */
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the checkmark when checked */
  .checkbox_container input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .checkbox_container .checkmark:after {
    left: 5px;
    top: 1.8px;
    width: 4px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }

</style>

{{-- <label class="checkbox_container">1行目に項目行あり
  <input type="checkbox" id="" name="" value="" checked="checked">
  <span class="checkmark"></span>
</label> --}}