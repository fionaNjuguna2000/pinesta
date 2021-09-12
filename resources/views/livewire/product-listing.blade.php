@php(extract($data))
<div>
    <div class="ps-products-wrap pt-80 pb-80">
        <div class="ps-products" data-mh="product-listing">
            <div class="ps-product-action">
{{--                <div class="ps-product__filter">--}}
{{--                    <select class="ps-select selectpicker">--}}
{{--                        <option value="1">Shortby</option>--}}
{{--                        <option value="2">Name</option>--}}
{{--                        <option value="3">Price (Low to High)</option>--}}
{{--                        <option value="3">Price (High to Low)</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="ps-pagination">
                    {{$contents->render()}}
                </div>
            </div>
            <div class="ps-product__columns">
                @if(count($contents)>0)
                @foreach($contents as $product)
                    <div class="ps-product__column">
                        <div class="ps-shoe mb-30">
                            <div class="ps-shoe__thumbnail">
                                @if ($product->dateDiff<1)

                                    <div class="ps-badge"><span>New </span></div>
                                    <div class="ps-badge ps-badge--sale ps-badge--2nd">
                                        <span>-35%</span>
                                    </div>
                                @endif
                            </div>
                            <img src="{{$product->imageUrl}}" alt=""><a class="ps-shoe__overlay" href="{{route('details',$product)}}"></a>

                            <div class="ps-shoe__content">
                                <div class="ps-shoe__variants">
                                    <div class="ps-shoe__variant normal">
                                        <img src="{{$product->imageUrl}}" alt="">
                                        <img src="{{$product->smallImageUrl}}" alt="">
                                        <img src="{{$product->thumbUrl}}" alt="">
                                        <img src="{{$product->imageUrl}}" alt="">
                                    </div>
                                </div>
                                <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('details',$product)}}">{{Str::words($product->name,4)}}</a>
                                    <p class="ps-shoe__categories"><a href="#">{{Str::title($product->gender)}} shoes</a>,<a href="#"> {{$product->brand->name}}</a></p>
                                    <span class="ps-shoe__price"><del>sh {{$product->retail_price-10}}</del> sh {{$product->retail_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="alert alert-primary text-center" role="alert">
  This category doesnt have items, sorry for the inconvenience
</div>
                @endif
            </div>
            <div class="ps-product-action">
{{--                <div class="ps-product__filter">--}}
{{--                    <select class="ps-select selectpicker">--}}
{{--                        <option value="1">Shortby</option>--}}
{{--                        <option value="2">Name</option>--}}
{{--                        <option value="3">Price (Low to High)</option>--}}
{{--                        <option value="3">Price (High to Low)</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="ps-pagination">
                    {{$contents->render()}}
                </div>
            </div>
        </div>

        <div class="ps-sidebar" data-mh="product-listing">
            <aside class="ps-widget--sidebar ps-widget--category">
                <div class="ps-widget__header">
                    <h3>Category</h3>
                </div>
                <div class="ps-widget__content">
                    <ul class="ps-list--checked">
                        @foreach(array_slice(config('settings.gender'), 0, count(config('settings.gender')) - 1) as $menu)
                            <li class="{{(request()->segment(2)==$menu)?'current':''}}"><a href="{{route('listing',$menu)}}">{{$menu}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
{{--            <aside class="ps-widget--sidebar ps-widget--filter">--}}
{{--                <div class="ps-widget__header">--}}
{{--                    <h3>Category</h3>--}}
{{--                </div>--}}
{{--                <div class="ps-widget__content">--}}
{{--                    <div class="ac-slider" data-default-min="300" data-default-max="2000" data-max="3450" data-step="50" data-unit="$"></div>--}}
{{--                    <p class="ac-slider__meta">Price:<span class="ac-slider__value ac-slider__min"></span>-<span class="ac-slider__value ac-slider__max"></span></p><a class="ac-slider__filter ps-btn" href="#">Filter</a>--}}
{{--                </div>--}}
{{--            </aside>--}}
{{--            <aside class="ps-widget--sidebar ps-widget--category">--}}
{{--                <div class="ps-widget__header">--}}
{{--                    <h3>Sky Brand</h3>--}}
{{--                </div>--}}
{{--                <div class="ps-widget__content">--}}
{{--                    <ul class="ps-list--checked">--}}
{{--                        <li class="current"><a href="product-listing.html">Nike(521)</a></li>--}}
{{--                        <li><a href="product-listing.html">Adidas(76)</a></li>--}}
{{--                        <li><a href="product-listing.html">Baseball(69)</a></li>--}}
{{--                        <li><a href="product-listing.html">Gucci(36)</a></li>--}}
{{--                        <li><a href="product-listing.html">Dior(108)</a></li>--}}
{{--                        <li><a href="product-listing.html">B&G(108)</a></li>--}}
{{--                        <li><a href="product-listing.html">Louis Vuiton(47)</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </aside>--}}
{{--            <aside class="ps-widget--sidebar ps-widget--category">--}}
{{--                <div class="ps-widget__header">--}}
{{--                    <h3>Width</h3>--}}
{{--                </div>--}}
{{--                <div class="ps-widget__content">--}}
{{--                    <ul class="ps-list--checked">--}}
{{--                        <li class="current"><a href="product-listing.html">Narrow</a></li>--}}
{{--                        <li><a href="product-listing.html">Regular</a></li>--}}
{{--                        <li><a href="product-listing.html">Wide</a></li>--}}
{{--                        <li><a href="product-listing.html">Extra Wide</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </aside>--}}
{{--            <div class="ps-sticky desktop">--}}
{{--                <aside class="ps-widget--sidebar">--}}
{{--                    <div class="ps-widget__header">--}}
{{--                        <h3>Size</h3>--}}
{{--                    </div>--}}
{{--                    <div class="ps-widget__content">--}}
{{--                        <table class="table ps-table--size">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td class="active">3</td>--}}
{{--                                <td>5.5</td>--}}
{{--                                <td>8</td>--}}
{{--                                <td>10.5</td>--}}
{{--                                <td>13</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>3.5</td>--}}
{{--                                <td>6</td>--}}
{{--                                <td>8.5</td>--}}
{{--                                <td>11</td>--}}
{{--                                <td>13.5</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>4</td>--}}
{{--                                <td>6.5</td>--}}
{{--                                <td>9</td>--}}
{{--                                <td>11.5</td>--}}
{{--                                <td>14</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>4.5</td>--}}
{{--                                <td>7</td>--}}
{{--                                <td>9.5</td>--}}
{{--                                <td>12</td>--}}
{{--                                <td>14.5</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>5</td>--}}
{{--                                <td>7.5</td>--}}
{{--                                <td>10</td>--}}
{{--                                <td>12.5</td>--}}
{{--                                <td>15</td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </aside>--}}
{{--                <aside class="ps-widget--sidebar">--}}
{{--                    <div class="ps-widget__header">--}}
{{--                        <h3>Color</h3>--}}
{{--                    </div>--}}
{{--                    <div class="ps-widget__content">--}}
{{--                        <ul class="ps-list--color">--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                            <li><a href="#"></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </aside>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
