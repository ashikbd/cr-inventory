<div class="row">
          <div class="col-md-6">
          <div class="card card-primary">
            
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
              <form method="post" action="{{ url('admin/settings/sms_settings_save') }}">
                @csrf
                <div class="form-group">
                  <label for="bday_sms_default_text">Birthday SMS Default Text</label>
                  <textarea id="bday_sms_default_text" name="bday_sms_default_text" rows="10" class="form-control">{{ $bday_sms_default_text }}</textarea>
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