@php(extract($data))
@extends('layouts.web')
@section('content')

    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                <div class="item"><img src="{{$product->thumbUrl}}" alt=""></div>
                                <div class="item"><img src="{{$product->thumbUrl}}" alt=""></div>
                                <div class="item"><img src="{{$product->thumbUrl}}" alt=""></div>
                                <div class="item"><img src="{{$product->thumbUrl}}" alt=""></div>
                                <div class="item"><img src="{{$product->thumbUrl}}" alt=""></div>
                            </div>

                        </div>
                        <div class="ps-product__image">
                            <div class="item"><img class="zoom" src="{{$product->imageUrl}}" alt="" data-zoom-image="{{$product->imageUrl}}"></div>
                            <div class="item"><img class="zoom" src="{{$product->thumbUrl}}" alt="" data-zoom-image="{{$product->thumbUrl}}"></div>
                            <div class="item"><img class="zoom" src="{{$product->smallImageUrl}}" alt="" data-zoom-image="{{$product->smallImageUrl}}"></div>
                        </div>
                    </div>
                    <div class="ps-product__thumbnail--mobile">
                        <div class="ps-product__main-img"><img src="{{$product->imageUrl}}" alt=""></div>
                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
                    </div>


                    <form action="{{route('addCart')}}" method="post" enctype="multipart/form">
                        @csrf
                    <div class="ps-product__info">
                        <div class="ps-product__rating">
                            <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="2">5</option>
                            </select>
                            @if (count($product->comments)>0)
                                <a href="#">(Read all {{count($product->comments)}} reviews)</a>
                            @endif
                        </div>
                        <h1>{{Str::words($product->title,6)}}</h1>
                        <p class="ps-product__category"><a href="#"> {{$product->genre}} shoes</a>,<a href="#"> {{$product->brand->name}}</a></p>
                        <h3 class="ps-product__price">sh. {{$product->retail_price}}</h3>
                        <div class="ps-product__block ps-product__quickview">
                            <h4>QUICK REVIEW</h4>
                            <p>{{$product->name}}<br>{{$product->title,6}}</p>
                        </div>
                        <div class="ps-product__block ps-product__style">
                            <h4>CHOOSE YOUR STYLE</h4>
                            <ul>
                                <li><a href="#"><img src="{{$product->imageUrl}}" alt=""></a></li>
                                <li><a href="#"><img src="{{$product->thumbUrl}}" alt=""></a></li>
                                <li><a href="#"><img src="{{$product->smallImageUrl}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__block ps-product__size">
                            <select name="size" class="ps-select selectpicker" required>
                                @foreach(config('settings.shoe_size') as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <input class="form-control" name="quantity" type="number" value="1" min="1" >
                            </div>
                        </div>
                        <div class="ps-product__shopping">
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <input type="hidden" value="{{$product->retail_price}}" name="amount">
                            <button type="submit" class="ps-btn mb-10" >Add to cart<i class="ps-icon-next"></i></button>
                        </div>
                    </div>
                    </form>



                    <div class="clearfix"></div>
                    <div class="ps-product__content mt-50">
                        <ul class="tab-list" role="tablist">
                            <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
                            <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
                        </ul>
                    </div>
                    <div class="tab-content mb-60">
                        <div class="tab-pane active" role="tabpanel" id="tab_01">
                            <p>{{$product->title}}</p>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_02">
                            <p class="mb-20"> {{count($product->comments)}} review for <strong>{{$product->shoe}}</strong></p>
                            @foreach($product->comments as $comment)
                                <div class="ps-review">
                                    <div class="ps-review__content">
                                        <header>
                                            <select class="ps-rating">
                                                @for ($i = 0; $i < $comment->rating; $i++)
                                                    <option value="{{$comment->rating}}" {{($i==$comment->rating)?"selected":''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                            <p>By<a href=""> {{$comment->user->name}}</a> - {{$comment->created_at->format('F d, Y')}}</p>
                                        </header>
                                        <p>{{$comment->comment}}.</p>
                                    </div>
                                </div>
                            @endforeach
                            @auth

                                <form class="ps-product__review" action="{{route('storeComment')}}" method="post">
                                    @csrf
                                    <h4>ADD YOUR REVIEW</h4>
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Your rating<span></span></label>
                                                <select name="rating" id="rating" class="ps-rating">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                                            <div class="form-group">
                                                <label>Your Review:</label>
                                                <textarea name="comment" class="form-control" rows="6"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            @else
                                <div class="alert alert-success text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>OOps sorry!</strong> login to comment.
                                    <a href="{{route('login')}}" class="alert-link">Click here to login</a>.
                                </div>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
        <div class="ps-container">
            <div class="ps-section__header mb-50">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="ps-section__content">
                <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">

                    @foreach ($extras as $sale)
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    @if ($sale->dateDiff<1)
                                        <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                                    @endif
                                    <img src="{{$sale->imageUrl}}" alt=""><a class="ps-shoe__overlay" href="{{route('details',$sale)}}"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal">
                                            <img src="{{$sale->imageUrl}}" alt="">
                                            <img src="{{$sale->smallImageUrl}}" alt="">
                                            <img src="{{$sale->thumbUrl}}" alt="">
                                            <img src="{{$sale->imageUrl}}" alt="">
                                        </div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('details',$sale)}}">{{Str::words($sale->name,4)}}</a>
                                        <p class="ps-shoe__categories"><a href="#">{{Str::title($sale->gender)}} shoes</a>,<a href="#"> {{$sale->brand->name}}</a></p>
                                        <span class="ps-shoe__price"> sh {{$sale->retail_price}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
