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
              <form method="post" action="{{ route('services.store') }}">
                @csrf
                <div class="form-group">
                  <label for="name">Service Name</label>
                  <input type="text" id="name" required name="name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea id="inputDescription" class="form-control" name="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="purchase_price">Price</label>
                  <input type="text" id="purchase_price" required name="purchase_price" class="form-control">
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