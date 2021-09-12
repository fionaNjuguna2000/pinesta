@php(extract($data))
@extends('layouts.web')
@section('content')
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
            @if (count($contents)>0)
                <div class="ps-cart-listing">
                    <table class="table ps-cart__table">
                        <thead>
                        <tr>
                            <th>All Products</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contents as $content)
                            <tr>
                                <td><a class="ps-product__preview" href="product-detail.html"><img class="mr-15" src="{{$content->product->thumbUrl}}" height="80" width="90"alt="">
                                        {{$content->product->shoe}}
                                    </a></td>
                                <td>{{$content->size}}</td>
                                <td>Sh {{$content->amount}}</td>
                                <td>
                                    <div class="form-group--number">
                                        {{$content->quantity}}
                                    </div>
                                </td>
                                <td>sh. {{$content->amount * $content->quantity}}</td>
                                <td>
                                    <a class="ps-cart-item__close" onclick="return confirm('Are you sure you want to remove?')" href="{{route('removeIndex',$content)}}">
                                        <div class="ps-remove"></div>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="ps-cart__actions">
                        <div class="ps-cart__promotion">
                            <div class="form-group">

<!--                                 shipping info
 -->
                            </div>

                        </div>
                        <div class="ps-cart__total">
                            <h3>Total Price: <span>Sh {{$totals}}</span></h3><a class="ps-btn" href="{{route('customer.addOrder')}}">Proceed to payment<i class="ps-icon-next"></i></a>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center" role="alert">
                    Your cart is empty
                </div>
            @endif
        </div>
    </div>
@endsection
