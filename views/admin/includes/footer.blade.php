<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>&copy; {{ date("2022") }}-{{ date('Y', strtotime('+1 year')) }} <a href="#" style="color:#fd7e14;">Tech Reviewers</a>.</strong>
    All rights reserved.

</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/dist/js/pages/dashboard3.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>


<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Select2 -->
<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('public/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('public/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('public/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!--Daterangepicker -->

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<!-- Summernote -->
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/dist/js/custom.js') }}"></script>
<script src="{{ asset('public/dist/js/datepickers.js') }}"></script>
<script src="{{ asset('public/dist/js/dataTable.js') }}"></script>
<script src="{{ asset('public/plugins/toastr/toastr.min.js') }}"></script>



  <script src="{{ asset('public/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('public/plugins/jquery-validation/additional-methods.min.js') }}"></script>
  <script src="{{ asset('public/dist/js/validation.js') }}"></script>
  <script src="{{ asset('public/dist/js/user-detail.js') }}"></script>

  <!-- Summernote -->
<script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Page specific script -->

<script src="{{ asset('public/dist/js/tinymce.js') }}"></script>

<!-- Page specific script -->

<script type="text/javascript" src="{{ asset('public/parsley.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
@if(Session::has('success'))
      toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
      toastr.error("{{ session('error') }}");
  @endif

  $(document).ready(function() {
   tinymce.init({
        selector: '#assessment',
        height: 200,
        toolbar: 'mybutton',
        plugins: 'wordcount',
        preformatted: true,
        menubar: false,
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        setup: function(editor) {
            editor.addButton('mybutton', {
                type: 'listbox',
                text: 'Add Variable',
                icon: false,
                onselect: function(e) {
                    editor.insertContent(this.value());
                },
                values: [{
                        text: 'Album Name',
                        value: '$childName'
                    },
                    {
                        text: 'Operator Name',
                        value: '$operator_name'
                    },
                    {
                        text: 'User Name',
                        value: '$user_name'
                    }
                ],

            });
        }
    });


        const element = document.getElementById("content");
        element.scrollIntoView();

   });


</script>
@yield('scripts')
</body>
</html>
