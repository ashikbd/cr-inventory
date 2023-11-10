<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{url('admin/stock/stockout')}}">+ Create</a>
                <table class="table datatable">
                    <thead>
                        <tr>
                        <th>Reference</th>
                        <th>Products</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($stocks as $stock)
                            <tr>
                                <td>{{$stock->reference_no}}</td>
                                <td>
                                    @foreach($stock->items as $item)
                                        {{$item->product->name}}: {{$item->qty}} pcs <br />
                                    @endforeach
                                </td>
                                <td>{{$stock->created_at}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{url('admin/stock/stockout_edit/'.$stock->id.'')}}">Edit</a> 
                                    <a class="btn btn-info show_detail_modal" data-title="Stock-out Detail" href="{{ url('admin/stock/stockout_detail/'.$stock->id) }}">Detail</a> 
                                    <a class="btn btn-danger">Remove</a>
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