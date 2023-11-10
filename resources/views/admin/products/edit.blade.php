<div class="row">
          <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit</h3>

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
              <form method="post" action="{{ route('products.update',$product) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="inputName">Product Name</label>
                  <input type="text" id="inputName" required name="name" value="{{ $product->name }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea id="inputDescription" class="form-control" name="description" rows="4">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="brand">Brand</label>
                  <select id="brand" name="brand_id" class="form-control custom-select select2">
                    <option value="">Select</option>
                    @foreach($brands as $row)
                      <option value="{{$row->id}}" @if($product->brand_id == $row->id) selected @endif>{{$row->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" name="category_id" class="form-control custom-select select2">
                    <option value="">Select</option>
                    @foreach($categories as $row)
                      <option value="{{$row->id}}" @if($product->category_id == $row->id) selected @endif>{{$row->name}}</option>
                      @foreach(App\Models\ProductCategories::where('parent_id',$row->id)->get() as $child)
                        <option value="{{$child->id}}" @if($product->category_id == $child->id) selected @endif> --- {{$child->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="low_stock_qty">Low Stock Qty</label>
                  <input type="text" name="low_stock_qty" value="{{ $product->low_stock_qty }}" id="low_stock_qty" class="form-control">
                </div>
                <!--
                <div class="form-group">
                  <label for="low_stock_qty">Initial Stock Qty</label>
                  <input type="text" name="initial_stock_qty" value="{{ $product->initial_stock_qty }}" id="initial_stock_qty" class="form-control">
                </div>
-->
                <div class="form-group">
                  <label>Reference No/Product Code</label>
                  <input type="text"  name="sku" value="{{ $product->sku }}" class="form-control">
                </div>
                <!--
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" name="image" id="image" class="form-control" />
                </div>
                -->
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" name="status" class="form-control custom-select">
                    <option @if($product->status == 1) selected @endif value="1">Enabled</option>
                    <option @if($product->status == 0) selected @endif value="0">Disabled</option>
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