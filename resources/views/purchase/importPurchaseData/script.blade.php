<script>
	$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	$("#order_data_input").val(fileName);
	});
</script>
<script>
	$(document).ready(function(){
	  $(".customalert, .loading-icon").hide();
	  $("#contenthide").click(function(){
		$(".customalert,.loading-icon").toggle();
	  });
	});
</script>
    <!--  footer content // windows height resize call-->
<script type="text/javascript">
	jQuery(function($){
        var e = function() {
            var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
            (e -= 224) < 1 && (e = 1), e > 219 && jQuery(".fullpage_width1").css("min-height", e + "px")
        };
        jQuery(window).ready(e), jQuery(window).on("resize", e);
    });
</script>