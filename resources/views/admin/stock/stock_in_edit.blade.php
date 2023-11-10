<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Stock IN Edit</h3>

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
              <form method="post" action="{{ url('admin/stock/stockin_update') }}">
                @csrf
                <div class="form-group">
                  <label>Reference No</label>
                  <input type="text" value="{{ $stock->reference_no }}" name="reference_no" class="form-control">
                </div>
                <div class="form-group">
                  <label>Description/Notes</label>
                  <textarea class="form-control" name="description" rows="4">{{ $stock->description }}</textarea>
                </div>
                
                <table class="table" id="stockin_items">
                    <thead>
                        <tr>
                            <th width="30%">Product</th>
                            <th>Qty</th>
                            <th>Purchase Price</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($stock->items()->count())
                        @foreach($stock->items as $i=>$item)
                          <tr>
                              <td>
                                  <select class="form-control select2" required style="width:100%" name="items[]">
                                      <option value="">Select Product</option>
                                      @foreach($products as $row)
                                        <option value="{{$row->id}}" @if($item->product_id == $row->id) selected @endif>{{$row->name}}</option>
                                      @endforeach
                                  </select>
                              </td>
                              <td><input type="text" required name="qty[]" value="{{ $item->qty }}" class="form-control"></td>
                              <td><input type="text"  name="purchase_price[]" value="{{ $item->purchase_price }}" class="form-control"></td>
                              <td><input type="text"  name="expiry_date[]" value="{{ mydate($item->expiry_date,'/') }}" class="form-control datepicker"></td>
                              <td>
                                <a class="btn btn-success add_more">+ Add More</a>
                                @if($i > 0)
                                  <a class="btn btn-danger remove_item">- Remove</a>
                                @endif
                              </td>
                          </tr>
                        @endforeach
                      @else
                          <tr>
                              <td>
                                  <select class="form-control select2" required style="width:100%" name="items[]">
                                      <option value="">Select Product</option>
                                      @foreach($products as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                      @endforeach
                                  </select>
                              </td>
                              <td><input type="text" required name="qty[]" class="form-control"></td>
                              <td><input type="text"  name="purchase_price[]" class="form-control"></td>
                              <td><input type="text"  name="expiry_date[]" value="" class="form-control datepicker"></td>
                              <td><a class="btn btn-success add_more">+ Add More</a></td>
                          </tr>
                      @endif
                    </tbody>
                </table>
                <div class="form-group float-right">
                  <a href="{{ url('admin/stock/stockin_list') }}" class="btn btn-default">Back</a>
                  <input type="hidden" name="id" value="{{ $stock->id }}" />
                  <input name="submit" type="submit" class="btn btn-success" value="Update" />
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
    locale: {
      format: 'DD/MM/YYYY'
    }
  });

   $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });

  var products_options = "";

  @foreach($products as $row)
    products_options += '<option value="{{$row->id}}">{{$row->name}}</option>';
  @endforeach

  var item_row = '<tr><td><select class="form-control select2" required name="items[]"><option value="">Select Product</option>'+products_options+'</select></td><td><input type="text" required name="qty[]" class="form-control"></td><td><input type="text"  name="purchase_price[]" class="form-control"></td><td><input type="text"  name="expiry_date[]" value="" class="form-control datepicker"></td><td><a class="btn btn-success add_more">+ Add More</a> <a class="btn btn-danger remove_item">- Remove</a></td></tr>';

  $(document).on("click",".add_more",function(e){
    e.preventDefault();
    $("#stockin_items tbody").append(item_row);

    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false
    });
    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });

    $(".select2").select2({
        theme: 'bootstrap4'
    });
  });

  $(document).on("click",".remove_item",function(e){
    e.preventDefault();
    $(this).parents("tr").remove();
  });
});
</script>