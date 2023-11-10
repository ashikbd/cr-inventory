  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> Eve Salon</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By</b> CodeRiver Applications
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="show_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
    </div>
  </div>
</div>

<script>
  @if(session('cmsStatus') == 'success')
  Swal . fire(
    'Successfully Saved!',
    '',
    'success'
  );
  @endif
  
  @if(session('cmsStatus') == 'fail')
  Swal . fire(
    'Failed to Save!',
    '',
    'error'
  );
  @endif


  jQuery(document).ready(function($) {
      $(".select2").select2({
          theme: 'bootstrap4'
      });

      $(".datatable").dataTable();

      let current_url = window.location.href;
      $(".nav-link[href='"+current_url+"']").addClass('active');
      $(".nav-link[href='"+current_url+"']").parents('li.nav-item').addClass('menu-is-opening menu-open');

      $(".confirm_delete").on("click",function(e){
        e.preventDefault();

        let link = $(this).attr("href");

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link;
          }
        });
      });

      $(".show_detail_modal").on("click",function(e){
        e.preventDefault();
        let title = $(this).data('title');
        let link = $(this).attr('href');

        $.ajax({
          url: link,
          type: "GET",
          success: function(result){
            $('#show_detail_modal').find(".modal-title").text(title);
            $('#show_detail_modal').find(".modal-body").html(result);
            $('#show_detail_modal').modal('show');
          }
        });
        
      });
  });

</script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('resources/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('resources/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('resources/js/pages/dashboard3.js') }}"></script>
</body>
</html>
