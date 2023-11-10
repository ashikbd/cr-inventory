<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Expiry Date</th>
                            <th>Current Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                        <tr>
                            <td>
                                {{ $product['name'] }}
                            </td>
                            <td>
                                {{ $product['brand'] }}
                            </td>
                            <td>
                                {{ $product['expiry_date'] }}
                            </td>
                            <td>
                                {{ $product['current_stock'] }}
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</div>