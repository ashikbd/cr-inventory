
<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{route('services.create')}}">+ Create</a>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->purchase_price}} BDT</td>
                            <td>{!! show_status($row->status) !!}</td>
                            <td>{{date("d M Y", strtotime($row->created_at))}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('services.edit',$row->id)}}">Edit</a>
                                <a class="btn btn-danger confirm_delete" href="{{url('admin/services/delete/'.$row->id)}}">Delete</a>
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