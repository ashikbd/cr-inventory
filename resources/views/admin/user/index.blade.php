
<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
            <a class="btn btn-success float-right" href="{{route('users.create')}}">+ Create</a>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                @if($user->id!=1)
                                <a href="{{ url('admin/users/delete/'. $user->id) }}" class="btn btn-danger confirm_delete">Delete</a>
                                @endif
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