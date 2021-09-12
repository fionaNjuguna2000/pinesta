@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>

    <div class="container">
        <form action="{{route('admin.storeProducts')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name"  type="text"  placeholder="Storm Blue"  autocomplete="on">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shoe Name</label>
                                <input class="form-control" name="shoe"  type="text"  placeholder="Jordan 1 Retro AJKO"  autocomplete="on">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" name="quantity" placeholder="Quantity"  type="number" min="1"  autocomplete="on">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="title" class="form-control" placeholder="" id="" cols="5" rows="5"></textarea>
            </div>
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand_id" class="form-control" id="">
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{ucwords($brand->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Color</label>
                        <input class="form-control" name="colorway"  type="text"  placeholder="Black/White-Red"  autocomplete="on">
                    </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                @foreach (config('settings.status') as $status)
                                    <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Retail Price</label>
                            <input class="form-control" name="retail_price"  type="number" min="100"  placeholder="100"  autocomplete="on">

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Gender</label>
                            <select name="gender" class="form-control" id="">
                                @foreach (config('settings.gender') as $gender)
                                    <option value="{{strtolower($gender)}}">{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Size</label>
                            <select name="size" class="form-control" id="">
                                @foreach(config('settings.shoe_size') as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Large Image</label>
                            <input type="file" name="imageUrl" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Medium Image</label>
                            <input type="file" name="smallImageUrl" class="form-control">

                        </div>

                        <div class="col-sm-4">
                            <label for="">Small Image</label>
                            <input type="file" name="thumbUrl" class="form-control">

                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="{{route('admin.products')}}" class="btn btn-danger btn-xs">Cancel</a>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn  btn-primary">Save</button>

                    </div>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
