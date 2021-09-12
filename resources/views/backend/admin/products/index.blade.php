@php(extract($data))
<x-app-layout>
    <x-slot name="title">
            {{$title }}
    </x-slot>
    <div>
        <div class="m-3">
            <div class="row ">
                <div class="col-sm-4">
                    <a href="{{route('admin.createProducts')}}" class="btn btn-primary rounded">Add Products</a>
                </div>
                <div class="col-sm-8"></div>
            </div>
        </div>
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
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->retail_price}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->colorway}}</td>
                        <td>{{$product->gender}}</td>
                        <td>{{$product->status}}</td>
                        <td>{{$product->size}}</td>
                        <td>
                            <a href="{{route('admin.showProduct',$product)}}" class="btn btn-sm btn-info">view More</a>
                            <a href="#" class="btn btn-sm btn-dark">edit</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$products->render()}}
        </div>
    </div>
</x-app-layout>
