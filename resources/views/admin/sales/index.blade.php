
<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{route('sales.create')}}">+ Create</a>
                <table class="table datatable">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Services</th>
                        <th>Total Price</th>
                        <th>Created By</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $row)
                        <tr>
                            <td>{{ str_pad($row->id,4,'0',STR_PAD_LEFT) }}</td>
                            <td><a href="#">{{$row->client->first_name}} {{$row->client->last_name}}</a></td>
                            <td>
                                {{$row->items->implode('service.name', ', ')}}
                            </td>
                            <td>{{$row->total_price}} BDT</td>
                            <td>{{$row->user->name}}</td>
                            <td>{{date("d M Y", strtotime($row->created_at))}}</td>
                            <td>
                                <a class="btn btn-info show_detail_modal" data-title="Sale # {{ str_pad($row->id,4,'0',STR_PAD_LEFT) }}" href="{{ route('sales.show',$row->id) }}">Detail</a>
                                <a class="btn btn-success" href="{{route('sales.edit',$row->id)}}">Edit</a>
                                <a class="btn btn-danger confirm_delete" href="{{url('admin/sales/delete/'.$row->id)}}">Delete</a>
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