@extends('layouts.app')


@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="container mt-4 border-3 rounded-3">
            <div class="row">
                <div class="col-12">
                    <h1 class="mt-3 mb-4">Novo Usuário</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="col-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <x-input-label for="password" :value="__('Senha')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="col-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-end">
                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn btn-primary mt-3 mb-3">{{ __('Cadastrar Usuário') }}</button>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
@endsection