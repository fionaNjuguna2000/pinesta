@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="m-3">
            <div class="row ">
                <div class="col-sm-4">
                    <a href="{{route('admin.createUser')}}" class="btn btn-primary rounded">Add Users</a>
                </div>
                <div class="col-sm-8"></div>
            </div>
        </div>
        <div class="table-responsive">
            {{$users->render()}}

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->access}}</td>

                        <td>
                            @if ($user->role==\App\Models\User::CUSTOMER)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal" data-info="{{$user->info}}"> view info
                                </button>
                            @endif
                            @if (\Illuminate\Support\Facades\Auth::id()!=$user->id)
                                    @include('partials._delete_btn',['url'=>route('admin.destroy',$user->id)])

                                @endif



                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->render()}}
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                           <h5>Town:</h5>
                            <span id="town"></span>
                        </li>
                        <li class="list-group-item">
                            <h5>Phone:</h5>
                            <span id="phone"></span>
                        </li>
                        <li class="list-group-item">
                            <h5>Other Info:</h5>
                            <span id="other_info"></span>
                        </li>
                    </ul>
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
                var recipient = button.data('whatever')
                var info = button.data('info')
                console.log(info)
                var modal = $(this)
                modal.find('.modal-body #town').text(info['town'])
                modal.find('.modal-body #phone').text(info['phone'])
                modal.find('.modal-body #other_info').text(info['other_info'])
            })

        </script>
    @endpush

</x-app-layout>
