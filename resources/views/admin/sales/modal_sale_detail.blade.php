<div class="row">
    <div class="col-md-12">
        <h6><strong>Name:</strong> {{ $sale->client->first_name }} {{ $sale->client->last_name }}</h6>
        <h6><strong>Email:</strong> {{ $sale->client->email }}</h6>
        <h6><strong>Mobile:</strong> {{ $sale->client->mobile }}</h6>
        <br />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="30%">Service</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                
                @if($sale->items)
                    @foreach($sale->items as $i=>$item)
                    <tr>
                    <td>
                        {{ $item->service->name }}
                    </td>
                    <td>{{ $item->price + $item->discount }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->price }}</td>
                    </tr>
                    @endforeach
                @endif
                
            </tbody>
            <tfoot>
                      <tr>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td><strong>{{ $sale->total_discount }}</strong></td>
                        <td><strong>{{ $sale->total_price }}</strong></td>
                        
                      </tr>
                    </tfoot>
        </table>
    </div>
    
</div>