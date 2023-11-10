<div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
<a class="btn btn-success float-right" href="{{route('categories.create')}}">+ Create</a>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Create Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                        <tr>
                            <td>{{$cat->name}}</td>
                            <td>{!! show_status($cat->status) !!}</td>
                            <td>{{date("d M Y", strtotime($cat->created_at))}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('categories.edit',$cat->id)}}">Edit</a>
                                <a class="btn btn-danger confirm_delete" href="{{url('admin/categories/delete/'.$cat->id)}}">Delete</a>
                            </td>
                        </tr>
                            @foreach(App\Models\ProductCategories::where('parent_id',$cat->id)->get() as $child)
                                <tr>
                                    <td> ------  {{$child->name}}</td>
                                    <td>{!! show_status($child->status) !!}</td>
                                    <td>{{date("d M Y", strtotime($child->created_at))}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('categories.edit',$child)}}">Edit</a>
                                        <a class="btn btn-danger confirm_delete" href="{{url('admin/categories/delete/'.$child->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</div>