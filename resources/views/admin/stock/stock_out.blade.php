<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Stock OUT</h3>

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
              <form method="post" action="{{ url('admin/stock/stockout_save') }}">
                @csrf
                <div class="form-group">
                  <label>Reference No</label>
                  <input type="text"  name="reference_no" class="form-control">
                </div>
                <div class="form-group">
                  <label>Description/Notes</label>
                  <textarea class="form-control" name="description" rows="4"></textarea>
                </div>
                
                <table class="table" id="stockin_items">
                    <thead>
                        <tr>
                            <th width="30%">Product</th>
                            
                            <th>Expiry Date</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control select2 product_select" required style="width:100%" name="items[]">
                                    <option value="">Select Product</option>
                                    @foreach($products as $row)
                                      <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="expiry_date">
                                <select name="expiry_date[]" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </td>
                            <td><input type="text" required name="qty[]" class="form-control"></td>
                            <td><a class="btn btn-success add_more">+Add More</a></td>
                        </tr>
                    </tbody>
                </table>
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


  var products_options = "";

  @foreach($products as $row)
    products_options += '<option value="{{$row->id}}">{{$row->name}}</option>';
  @endforeach

  var item_row = '<tr><td><select class="form-control product_select select2" required name="items[]"><option value="">Select Product</option>'+products_options+'</select></td><td class="expiry_date"></td><td><input type="text" required name="qty[]" class="form-control"></td><td><a class="btn btn-success add_more">+Add More</a> <a class="btn btn-danger remove_item">+Remove</a></td></tr>';

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

  $(document).on("change",".product_select",function(){
    var product_id = $(this).val();
    var tr = $(this).parents("tr");
    $.ajax({
      "url": "{{url('admin/stock/get_product_stock')}}",
      "type": "post",
      "data": {product_id: product_id, "_token": "{{ csrf_token() }}"},
      success: function(result){
        var exp_dropdown = "<select class='form-control' name='expiry_date[]'><option value=''>Select</option>";
        if(result){
          $.each(JSON.parse(result), function(key,value) {
            if(key == 'undefined'){
              var exp = '';
            }else{
              var exp = key;
            }
            exp_dropdown += "<option value='"+exp+"' data-qty='"+value+"'>"+key+" ("+value+")</option>";
          });
        }
        exp_dropdown += "</select>";
        console.log(exp_dropdown);
        tr.find(".expiry_date").html(exp_dropdown);
      }
    });
  })
});
</script>