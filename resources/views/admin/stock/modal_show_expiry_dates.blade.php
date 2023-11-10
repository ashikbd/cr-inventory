<div class="row">
    <div class="col-md-12">
        <h6>Current Stock</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Expiry Date</th>
                    <th>Current Stock</th>
                </tr>
            </thead>
            <tbody>
                @if($stock)
                @foreach($stock as $date=>$row)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $row }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
</div>