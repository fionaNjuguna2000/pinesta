@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="table-responsive">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Online</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Direct Sale</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Quantity</th>
                            <th>Shoe</th>
                            <th>Image</th>
                            <th>Retail Amount</th>
                            <th>Selling Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($online_sales as $sale)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->employee->name}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->product->shoe}}</td>
                                <td><img src="{{$sale->product->thumbUrl}}" class="app-sidebar__user-avatar" height="80px" width="100px" alt=""></td>
                                <td>{{$sale->product->retail_price}}</td>
                                <td>{{$sale->amount}}</td>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Quantity</th>
                            <th>Shoe</th>
                            <th>Image</th>
                            <th>Retail Amount</th>
                            <th>Selling Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($direct_sales as $sale)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->employee->name}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->product->shoe}}</td>
                                <td><img src="{{$sale->product->thumbUrl}}" class="app-sidebar__user-avatar" height="80px" width="100px" alt=""></td>
                                <td>{{$sale->product->retail_price}}</td>
                                <td>{{$sale->amount}}</td>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>



        </div>
    </div>


</x-app-layout>
