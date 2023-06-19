    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <script type="text/javascript">
      setTimeout(function() { 
        $('.alert').hide(); 
      }, 3000);
      $('div.alert .close').on('click', function() {
        $(this).parent().alert('close'); 
      });
        $(document).ready(function() {
            $('.tableExport').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel',
                ]
            } );
        } );
    </script>


    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script> -->
      <!-- Bootstrap Js -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script> -->
  <!--    <script>
  $(document).ready(function() {
  
   var nice = $("html").niceScroll(
   {
      cursorborder:"none",
      cursorcolor:"#d73100",
      cursorwidth:"6px"
   }
   );  // The document page (body)
    
    $("#sidebar-collapse").niceScroll({cursorborder:"",cursorwidth:"6px",cursorcolor:"#d73100",touchbehavior:true}); // First scrollable DIV

    $(".messages").niceScroll({cursorborder:"",cursorwidth:"6px",cursorcolor:"#d73100",touchbehavior:true}); 
    
  });
</script> -->

</body>
<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if ((charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>
</html>