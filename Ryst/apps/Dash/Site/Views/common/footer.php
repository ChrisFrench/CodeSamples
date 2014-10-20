

<?php //echo \Dsc\Debug::dump( $this->app->hive(), false ); ?>

<div class="bottom-nav footer"> 2013 &copy; Crosscliq </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="/dash/js/jquery.js"></script> 
<script src="/dash/js/bootstrap.min.js"></script> 
<script src="/dash/js/jquery.mixitup.min.js"></script>
<script src='/dash/assets/plugins/form-inputmask/jquery.inputmask.min.js' type='text/javascript'></script>
<script src="/dash/js/jquery.datetimepicker.js"></script>

<script type="text/javascript">
$(function(){
  $('.mask').inputmask(); 
  $('#grid').mixitup();  

$('.datepicker').datetimepicker();

});
</script>