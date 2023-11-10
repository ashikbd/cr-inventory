<div class="row">
          <div class="col-md-12">
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
              <form method="post" action="{{ route('sales.store') }}">
                @csrf
                <div class="form-group">
                  <label for="name">Client</label>
                  <select required name="client_id" class="form-control select2">
                    <option value="">Select</option>
                    @if($clients)
                      @foreach($clients as $client)
                        <option value="{{ $client->id }}" @if(isset($_GET['client_id']) && ($_GET['client_id'] == $client->id)) selected @endif>{{ $client->first_name }} {{ $client->last_name }} [Mobile: {{ $client->mobile }} | Email: {{ $client->email }}]</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <table class="table table-bordered" id="services">
                    <thead>
                        <tr>
                            <th width="30%">Service</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control select2 service" required style="width:100%" name="service[]">
                                    <option value="">Select Service</option>
                                    @foreach($services as $row)
                                      <option value="{{$row->id}}" data-price="{{$row->purchase_price}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" required name="unit_price[]" value="0" class="form-control unit_price"></td>
                            <td><input type="text"  name="discount[]" class="form-control discount" value="0"></td>
                            <td><input type="text" readonly name="price[]" value="" class="form-control price"></td>
                            <td><a class="btn btn-success add_more">+Add More</a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td><input type="text" readonly name="total_discount" class="form-control total_discount" value="0"></td>
                        <td><input type="text" readonly name="total_price" class="form-control total_price" value="0"></td>
                        <td></td>
                      </tr>
                    </tfoot>
                </table>
                <div class="form-group">
                  <label for="name">Reference No</label>
                  <input type="text" name="reference_no" class="form-control">
                </div>
                <div class="form-group">
                  <label for="notes">Notes</label>
                  <textarea id="notes" class="form-control" name="notes" rows="4"></textarea>
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

  var service_options = "";

  @foreach($services as $row)
    service_options += '<option value="{{$row->id}}" data-price="{{$row->purchase_price}}">{{$row->name}}</option>';
  @endforeach

  var item_row = '<tr><td><select class="form-control select2 service" required name="services[]"><option value="">Select Service</option>'+service_options+'</select></td><td><input type="text" required name="unit_price[]" class="form-control unit_price" value="0"></td><td><input type="text" value="0" name="discount[]" class="form-control discount"></td><td><input type="text" readonly name="price[]" value="0" class="form-control price"></td><td><a class="btn btn-success add_more">+Add More</a> <a class="btn btn-danger remove_item">+Remove</a></td></tr>';

  $(document).on("click",".add_more",function(e){
    e.preventDefault();
    $("#services tbody").append(item_row);


    $(".select2").select2({
        theme: 'bootstrap4'
    });
  });

  $(document).on("click",".remove_item",function(e){
    e.preventDefault();
    $(this).parents("tr").remove();
  });

  $(document).on("change",".service",function(e){
    var price = $(this).find("option:selected").data('price');
    $(this).parents("tr").find(".unit_price").val(price);
    calc_price($(this).parents("tr"));
  });

  $(document).on("change",".unit_price, .discount",function(e){
    calc_price($(this).parents("tr"));
  });

  function calc_price(tr){
    var unit_price = tr.find('.unit_price').val();
    var discount = tr.find('.discount').val();
    var price = unit_price - discount;
    tr.find('.price').val(price);
    calc_total_discount();
    calc_total_price();
  }

  function calc_total_discount(){
    var total_discount = 0;
    $('.discount').each(function() {
        total_discount += Number($(this).val());
    });

    $(".total_discount").val(total_discount);
  }

  function calc_total_price(){
    var total_price = 0;
    $('.price').each(function() {
        total_price += Number($(this).val());
    });

    $(".total_price").val(total_price);
  }
  
});
</script>