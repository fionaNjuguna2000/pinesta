<!DOCTYPE html>
<html lang="en">
<head>
<title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @toastr_css
    <!-- Scripts -->
{{--    <script src="{{ mix('js/app.js') }}" defer ></script>--}}

</head>
<body class="app sidebar-mini">
<!-- Page Heading -->
<header class="app-header"><a class="app-header__logo" href="#">{{ucwords(config('app.name'))}}</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto align-items-baseline">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <x-jet-dropdown id="teamManagementDropdown">
                    <x-slot name="trigger">
                        {{ Auth::user()->currentTeam->name }}

                        <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Team Management -->
                        <h6 class="dropdown-header">
                            {{ __('Manage Team') }}
                        </h6>

                        <!-- Team Settings -->
                        <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                            {{ __('Team Settings') }}
                        </x-jet-dropdown-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </x-jet-dropdown-link>
                        @endcan

                        <hr class="dropdown-divider">

                        <!-- Team Switcher -->
                        <h6 class="dropdown-header">
                            {{ __('Switch Teams') }}
                        </h6>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" />
                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
            @endif

        <!-- Settings Dropdown -->
            @auth
                <x-jet-dropdown id="settingsDropdown">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                            {{ Auth::user()->name }}

                            <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <h6 class="dropdown-header small text-muted">
                            {{ __('Manage Account') }}
                        </h6>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <hr class="dropdown-divider">

                        <!-- Authentication -->
                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </x-jet-dropdown-link>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @endauth
        </ul>
    </ul>
</header>
<!-- Sidebar menu-->

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
{{--            <p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        </div>
    </div>
    @include('partials.nav', ['data' => $data??''])
</aside>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> {{ucwords($title?? ' '.config('app.name')) }}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{$title?? config('app.name')}}</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade ml-5" id="confirmDeleteModal" role="dialog" aria-labelledby="mediumModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <form id="action" method="post">
            @csrf
            @method('patch')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="target" name="modal" type="hidden" value="{{old('modal')}}">
                    <p>
                        Do you want to confirm this action?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Essential javascripts for application to work-->
<script src="{{asset('backend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('backend/js/popper.min.js')}}"></script>
{{--<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>--}}
<script src="{{asset('backend/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('backend/js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
<!-- Google analytics script-->
@stack('modals')

@livewireScripts
@jquery
@toastr_js
@toastr_render
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).on("click", ".deleteDialog ", function () {
        $('.modal-dialog #action').attr('action', $(this).data('url'));
        $(".modal-body #target").val($(this).data('target'));
    });
</script>
@stack('scripts')
</body>
</html>
