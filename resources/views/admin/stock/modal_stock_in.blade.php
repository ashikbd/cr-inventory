<div class="row">
          <div class="col-md-12">
                <div>
                  <strong>Reference No:</strong> {{ $stock->reference_no }}
                </div>
                <div>
                  <strong>Create Date:</strong>
                  {{ $stock->created_at }}
                </div>
                <div>
                  <strong>Created By:</strong>
                  {{ $stock->user?$stock->user->name:'' }}
                </div>
                <div>
                  <strong>Description/Notes:</strong>
                  {{ $stock->description?$stock->description:'None' }}
                </div>
                
                <table class="table" id="stockin_items" style="margin-top: 20px">
                    <thead>
                        <tr>
                            <th width="30%">Product</th>
                            <th>Qty</th>
                            <th>Purchase Price</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($stock->items()->count())
                        @foreach($stock->items as $i=>$item)
                          <tr>
                              <td>
                                 {{ $item->product->name }}
                              </td>
                              <td>{{ $item->qty }}</td>
                              <td>{{ $item->purchase_price }}</td>
                              <td>{{ $item->expiry_date?mydate($item->expiry_date,'/'):'' }}</td>
                             
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
        </div>
</div>