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
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->brand?$row->brand->name:''}}</td>
                            <td>{{$row->category?$row->category->name:''}}</td>
                            <td>{!! show_status($row->status) !!}</td>
                            <td>{{date("d M Y", strtotime($row->created_at))}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('products.edit',$row)}}">Edit</a>
                                <a class="btn btn-danger confirm_delete" href="{{url('admin/products/delete/'.$row->id)}}">Delete</a>
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