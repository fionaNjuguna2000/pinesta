@php(extract($data))
<x-app-layout>
    <x-slot name="title">
        {{$title }}
    </x-slot>
    <div>
        <div class="container">
            <form method="POST" action="{{ route('admin.storeUser') }}">
                @csrf

                <div class="form-group">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <select class="form-control" name="role" id="">
                    <option value="1">ADMIN</option>
                    <option value="2">SALES</option>
                </select>



                <div class="mb-0 mt-3">
                    <div class="d-flex justify-content-end">

                        <x-jet-button class="mt-3">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>

        </div>
    </div>


</x-app-layout>
