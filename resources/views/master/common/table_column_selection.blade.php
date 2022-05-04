<script type="text/javascript">
  $(document).ready(function(){
    $('th.signbtn').click(function() {
    $(this).addClass('highlight').siblings().removeClass('highlight');
      var th_index = $(this).index();
      $('#userTable tr').each(function() {
          $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
      });
    });
  });
</script>