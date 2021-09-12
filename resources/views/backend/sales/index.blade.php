@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="table-responsive">
            {{$products->render()}}

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name & Title</th>
                    <th>Quantity</th>
                    <th>price</th>
                    <th>Brand</th>
                    <th>Color</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{$product->thumbUrl}}" class="app-sidebar__user-avatar" height="80px" width="100px" alt=""></td>
                        <td>{{$product->shoe}}<br>
                            <span class="small">{{$product->name}}</span>
                        </td>
                        <td>{{$product->quantity}}
                            {{$product->store_quantity}}
                        </td>
                        <td>{{$product->retail_price}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->colorway}}</td>
                        <td>{{$product->gender}}</td>
                        <td>{{$product->status}}</td>
                        <td>{{$product->size}}</td>
                        <td>
{{--                            @if ($product->quantity>1)--}}
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-prod="{{$product}}">Sell</button>
{{--                            @endif--}}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$products->render()}}
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sales.store')}}" method="post" enctype="multipart/form">
                        @csrf
                        <input type="hidden" name="prod" id="product_id" placeholder="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Quantity:</label>
                            <input type="number" min="0" name="quantity" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Amount: {Retail price: <span id="retail"></span> }</label>
                            <input type="number" min="0" name="amount" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Sell</button>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var product_id = button.data('prod')

                console.log(product_id['retail_price'])
                var modal = $(this)
                modal.find('.modal-title').text('New Sale')
                modal.find('.modal-body #product_id').val(product_id['id'])
                modal.find('.modal-body #retail').text(product_id['retail_price'])
            })

        </script>
        @endpush
</x-app-layout>
