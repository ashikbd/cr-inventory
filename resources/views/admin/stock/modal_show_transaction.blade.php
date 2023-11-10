<div class="row">
    <div class="col-md-6">
        <h6>Stock-Ins</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stock-in Date</th>
                    <th>Qty</th>
                    <th>Expiry Date</th>
                    <th>Ref#</th>
                </tr>
            </thead>
            <tbody>
                @if($stock_in)
                @foreach($stock_in as $row)
                <tr>
                    <td>{{ date("d M Y", strtotime($row->created_at)) }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ $row->expiry_date?date("d M Y", strtotime($row->expiry_date)):'Undefined' }}</td>
                    <td>{{ $row->stock->reference_no }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h6>Stock-Outs</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stock-out Date</th>
                    <th>Qty</th>
                    <th>Expiry Date</th>
                    <th>Ref#</th>
                </tr>
            </thead>
            <tbody>
                @if($stock_out)
                @foreach($stock_out as $row)
                <tr>
                    <td>{{ date("d M Y", strtotime($row->created_at)) }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ $row->expiry_date?date("d M Y", strtotime($row->expiry_date)):'Undefined' }}</td>
                    <td>{{ $row->stock->reference_no }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>