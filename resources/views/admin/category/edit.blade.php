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
              <form method="post" action="{{ route('categories.update', $category) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text"  name="name" value="{{ old('name',$category->name) }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="category">Parent Category</label>
                  <select id="category" name="parent_id" class="form-control custom-select">
                    <option value="0">Select</option>
                    @foreach($parents as $parent)
                      <option value="{{$parent->id}}" @if($category->parent_id == $parent->id) selected @endif>{{$parent->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" name="status" class="form-control custom-select">
                    <option  @if($category->status == 1) selected @endif value="1">Enabled</option>
                    <option @if($category->status == 0) selected @endif value="0">Disabled</option>
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