<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('Thumbnail') }}</th>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Price')}}</th>
                    <th>{{ __('Total Price')}}</th>
                    <th>{{ __('Note')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    @if(empty($item->product))
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ __("Can't find product data. Product ID: :id", ['id' => $item->product_id]) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                @if(!empty($item->product->productMedias[0]->url))
                                    <img style="max-width: 150px; word-break: normal;" src="{{ asset($item->product->productMedias[0]->url) }}" alt="{{ $item->product->name }}" class="image-column">
                                @endif
                            </td>
                            <td style="white-space: normal;">
                                <a href="{{ route('products.edit', ['product' => $item->product->id]) }}">{{ $item->product->name}}</a>
                                <br>
                                @if (!empty($item->warranty_name))
                                    Bảo hành: <b>{{ $item->warranty_name }}</b>
                                @endif

                                <br>

                                @if (!empty($item->warranty_price))
                                    Giá bảo hành: <b>{{ number_format($item->warranty_price) }}</>
                                @endif
                            </td>
                            <td>{{ number_format($item->amount)}}</td>
                            <td>{{ number_format($item->price)}}</td>
                            <td>{{ number_format($item->total_price)}}</td>
                            <td>{{ $item->note }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
