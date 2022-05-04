
{{-- <script src="{{ asset('js/common.js?v=5001') }}"></script> --}}

<script type="text/javascript">
  var filecomm = document.createElement("script");
  filecomm.type = "text/javascript";
  filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
  document.getElementsByTagName("head")[0].appendChild(filecomm);
</script>

