@php(extract($data))
<div>
    <div class="navigation__column right">
        <form class="ps-search--header" action="do_action" method="post">
            <input class="form-control" type="text" placeholder="Search Product…">
            <button><i class="ps-icon-search"></i></button>
        </form>
        <div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i>{{count($contents)}}</i></span><i
                    class="ps-icon-shopping-cart"></i></a>
            <div class="ps-cart__listing">
                <div class="ps-cart__content">
                    @foreach($contents as $content)
                        <div class="ps-cart-item">
                            <a class="ps-cart-item__close" onclick="return confirm('Are you sure you want to remove?')" href="{{route('removeIndex',$content)}}"></a>
                            <div class="ps-cart-item__thumbnail"><a href="{{route('details',$content->product_id)}}"></a><img
                                    src="{{$content->product->thumbUrl}}" alt=""></div>
                            <div class="ps-cart-item__content"><a class="ps-cart-item__title"
                                                                  href="{{route('details',$content->product_id)}}">{{$content->product->shoe}}</a>
                                <p><span>Quantity:<i>{{$content->quantity}}</i></span><span>Total:<i>Sh {{$content->amount * $content->quantity}}</i></span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="ps-cart__total">
                    <p>Number of items:<span>{{count($contents)}}</span></p>
                    <p>Item Total:<span>Sh. {{$totals}}</span></p>
                </div>
                @if (count($contents)>0)
                    <div class="ps-cart__footer"><a class="ps-btn" href="{{route('checkout')}}">Check out<i
                                class="ps-icon-arrow-left"></i></a></div>
                @endif
            </div>

        </div>
        <div class="menu-toggle"><span></span></div>
    </div>
</div>
