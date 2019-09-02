<div class="clearfix"></div>
<footer class="footer text-center">
  POWERED BY <a href="http://theprismoid.com/" target="_blank">PRISMOIDAL COMPANY LIMITED</a> &copy; <?php echo date('Y'); ?>  All Rights Reserved.
</footer>
<!-- multistep modal -->
<script>
$(document).ready(function(){
  // adding datatable class to all
  let datatable = $('.table').dataTable({destroy: true,ordering:false,searching: false,info: false});
  // checkboxes select all
  $('#select_all').change(function() {
      var checkboxes = $(this).closest('form').find(':checkbox');
      checkboxes.prop('checked', $(this).is(':checked'));
  });

  

//   var current = 1,current_step,next_step,steps;
//   fixStepIndicator(current);
//   steps = $("fieldset").length;
//   $(".next").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().next();
//     next_step.show();
//     current_step.hide();
//     fixStepIndicator(++current);
//   });
//   $(".previous").click(function(){
//     current_step = $(this).parent();
//     next_step = $(this).parent().prev();
//     next_step.show();
//     current_step.hide();
//     fixStepIndicator(--current);
//   });
//   fixStepIndicator(current);
  
//   function fixStepIndicator(n) {
//   // This function removes the "active" class of all steps...
//   var i, x = document.getElementsByClassName("step");
//   $('step').css('color','red');
//   for (i = 0; i < x.length; i++) {
//     x[i].className = x[i].className.replace(" active", "");
//   }
//   //... and adds the "active" class on the current step:
//   x[n].className += " active";
// }
});
  </script>
           
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- for datetime picker Javascript -->
    <script src="../plugins/bower_components\datepicker\datepicker.min.js"></script>
    <!-- select2 -->
    <script src="../plugins/bower_components\select2\select2.min.js"></script>
    <!-- parsely -->
    <script src="../plugins/bower_components\parsley\parsley.min.js"></script>
    <!-- tostr -->
    <script src="../plugins/bower_components/toastr/toastr.min.js"></script>


    <!-- mcafee antivirus script -->
    <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>

    <!-- <script type="text/javascript" src="js/dataTables.jqueryui.js"></script> -->
    <script type="text/javascript" src="js/datatables.js"></script>
    <!-- button  toggle -->
    <script src="../plugins/bower_components\bootstrap-toggle\bootstrap2-toggle.min.js"></script>


</body>

</html>
