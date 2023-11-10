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
              <form method="post" action="{{ route('clients.update',$client) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" id="fname" required name="first_name" value="{{ $client->first_name }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" required name="last_name" value="{{ $client->last_name }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" value="{{ $client->email }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" id="mobile" name="mobile" value="{{ $client->mobile }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="birthday">Birthday</label>
                  <input type="text" id="birthday" name="birthday" value="{{ mydate($client->birthday,'/') }}" class="form-control datepicker">
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" name="status" class="form-control custom-select">
                    <option @if($client->status=='1') selected @endif value="1">Enabled</option>
                    <option @if($client->status=='0') selected @endif value="0">Disabled</option>
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
    maxYear: "<?php echo date('Y'); ?>",
    locale: {
      "format": 'DD/MM/YYYY'
    }
  });

   $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });
});
</script>