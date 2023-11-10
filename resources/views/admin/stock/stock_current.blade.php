<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{route('products.create')}}">+ Create</a>
                <table class="table datatable">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Current Stock</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $row)
                            @php
                                $current_stock = $row->getCurrentStockQuantity();
                            @endphp
                        <tr @if($row->low_stock_qty >= $current_stock) class='low_stock_row' @endif>
                            <td>{{$row->name}}</td>
                            <td>{{$row->brand?$row->brand->name:''}}</td>
                            <td>{{$row->category?$row->category->name:''}}</td>
                            <td><strong>{{$current_stock}}</strong></td>
                            <td>{!! show_status($row->status) !!}</td>
                            <td>{{date("d M Y", strtotime($row->created_at))}}</td>
                            <td>
                                <a class="btn btn-info show_detail_modal" data-title="{{$row->name}}" href="{{ url('admin/stock/show_transaction/'.$row->id) }}">Show Transactions</a>
                                <a class="btn btn-default show_detail_modal" data-title="{{$row->name}}" href="{{ url('admin/stock/show_expiry_dates/'.$row->id) }}">Expiry Dates</a>
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