@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="m-3">
            <div class="row ">
                <div class="col-sm-4">
                    <a href="{{route('admin.products')}}" class="btn btn-primary rounded">Back</a>
                </div>
                <div class="col-sm-8"></div>
            </div>
        </div>
        <div class="">

            <div class="row">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-4">

                            <img src="{{$product->imageUrl}}" class="img-fluid mb-4" alt="">

                            <img src="{{$product->smallImageUrl}}" class="img-fluid mb-4" alt=""
                                 data-wow-delay="0.3s">
                        </div>
                        <div class="col-lg-4 col-md-12 mb-4">

                            <img src="{{$product->thumbUrl}}" class="img-fluid mb-4" alt="">

                            <img src="{{$product->thumbUrl}}" class="img-fluid mb-4" alt=""
                                 data-wow-delay="0.3s">

                            <img src="{{$product->thumbUrl}}" class="img-fluid mb-4" alt=""
                                 data-wow-delay="0.3s">
                        </div>

                    </div>
                </div>
                <div class="col-sm-7">

                    <div class="ps-product__info">
                        <h1>{{Str::words($product->title,6)}}</h1>
                        <p class="ps-product__category"><a href="#"> {{$product->genre}} shoes</a>,<a
                                href="#"> {{$product->brand->name}}</a></p>
                        <h3 class="ps-product__price">sh. {{$product->retail_price}}</h3>
                        <div class="ps-product__block ps-product__quickview">
                            <h4>QUICK REVIEW</h4>
                            <p>{{$product->name}}<br>{{$product->title,6}}</p>
                        </div>
                    </div>

                </div>


            </div>

            <div class="m-2">
                <i class="alert-heading">Comments</i>
                <div class="media border p-3">
                    @foreach($product->comments as $comment)
                        <div class="media-body mb-2">
                            <h4>{{$comment->user->name}} <small><i>Posted
                                        on {{$comment->created_at->format('F d, Y')}}</i></small></h4>
                            <p>{{$comment->comment}}</p>
                            <h5 class="mt-2">{{$comment->rating}} star rating</h5>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
