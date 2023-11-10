
<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">

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
                                <a class="btn btn-primary show_detail_modal" data-title="SMS" href="{{url('admin/clients/send_sms_modal/'.$row->id)}}">Send SMS</a>
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