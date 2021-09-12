<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="alert alert-primary text-center" role="alert">
 Welcome to {{config('app.name')}}
</div>

</x-app-layout>
