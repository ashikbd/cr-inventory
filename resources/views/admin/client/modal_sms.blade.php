<div class="row">
    <div class="col-md-12">
        <h6>Send SMS</h6>
        <form method="post" action="{{ url('admin/clients/send_sms') }}">
                @csrf
                <div class="form-group">
                  <label>Mobile</label>
                  <input type="text" value="{{ $client->mobile }}" required name="mobile" class="form-control" />
                </div>
                <div class="form-group">
                  <label>SMS Body</label>
                  <textarea required name="sms_text" rows="8" class="form-control">{{ $default_text }}</textarea>
                </div>
                
                <div class="form-group float-right">
                  <input type="hidden" name="client_id" value="{{ $client->id }}" />
                  <input name="submit" type="submit" class="btn btn-success" value="Send" />
                </div>
              </form>
    </div>
</div>
