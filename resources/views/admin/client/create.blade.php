<div class="row">
          <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <form method="post" action="{{ route('clients.store') }}">
                @csrf
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" id="fname" required name="first_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" required name="last_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" id="mobile" name="mobile" class="form-control">
                </div>
                <div class="form-group">
                  <label for="birthday">Birthday</label>
                  <input type="text" id="birthday" name="birthday" class="form-control datepicker">
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" name="status" class="form-control custom-select">
                    <option selected value="1">Enabled</option>
                    <option value="0">Disabled</option>
                  </select>
                </div>
                
                <div class="form-group float-right">
                  <input name="submit" type="submit" class="btn btn-success" value="Save" />
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</div>

<script>
$(function() {
  $('.datepicker').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoUpdateInput: false,
    maxYear: "<?php echo date('Y'); ?>"
  });

   $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });
});
</script>