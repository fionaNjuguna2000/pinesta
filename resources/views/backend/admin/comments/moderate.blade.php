@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="table-responsive">
            {{$comments->render()}}

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Commented By</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Time</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td><a href="{{route('admin.showProduct',$comment->product)}}" target="_blank">{{$comment->product->shoe}}</a></td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->status}}</td>
                        <td>{{$comment->created_at->diffForHumans()}}</td>
                        <td>
                            @if (config('settings.status.active')==$comment->status)
                                <a href="{{route('admin.inactive',$comment)}}" class="btn btn-sm btn-info" onclick="return confirm('do you want to make inactive')">Mark Inactive</a>
                                @else
                                <a href="{{route('admin.active',$comment)}}" class="btn btn-sm btn-info" onclick="return confirm('do you want to make active')">Mark Active</a>
                            @endif
                                @include('partials._delete_btn',['url'=>route('admin.destroyComment',$comment->id)])

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$comments->render()}}
        </div>
    </div>
</x-app-layout>
