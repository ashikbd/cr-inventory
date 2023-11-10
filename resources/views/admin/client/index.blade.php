
<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{route('clients.create')}}">+ Create</a>
                <table class="table datatable">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Birthday</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $row)
                        <tr>
                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{ date("d M Y", strtotime($row->birthday)) }}</td>
                            <td>{!! show_status($row->status) !!}</td>
                            <td>{{date("d M Y", strtotime($row->created_at))}}</td>
                            <td>
                                <a class="btn btn-success" href="{{route('clients.edit',$row->id)}}">Edit</a>
                                <a class="btn btn-info" href="{{ url('admin/sales/create/?client_id='.$row->id) }}">Create Sales</a>
                                <a class="btn btn-primary" href="{{ url('admin/sales/?client_id='.$row->id) }}">Sale History</a>
                                <a class="btn btn-danger confirm_delete" href="{{url('admin/clients/delete/'.$row->id)}}">Delete</a>
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