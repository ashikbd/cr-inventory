<div class="row">
          <div class="col-lg-6">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Products in Low Stock</h3>
                <div class="card-tools">
                  <a href="{{ url('admin/stock/current_stock') }}" class="btn btn-sm btn-default">
                    <i class="fas fa-link"></i> Detail
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Current Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($low_stock_products as $prod)
                  <tr>
                    <td>
                        {{$prod->name}}
                    </td>
                    <td>{{$prod->brand->name}}</td>
                    <td>
                      {{$prod->getCurrentStockQuantity()}}
                    </td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->

          <div class="col-lg-6">
            

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Expiring products</h3>
                <div class="card-tools">
                  <a href="{{ url('admin/stock/expiring') }}" class="btn btn-sm btn-default">
                    <i class="fas fa-link"></i> Detail
                  </a>
                 
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Expiry Date</th>
                            <th>Current Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($expiring_products as $product)
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
            </div>
          </div>
          <!-- /.col-md-6 -->
</div>