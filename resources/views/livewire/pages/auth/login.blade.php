<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();


    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div>
        <h2 class="mt-6 text-xl font-bold tracking-tight text-gray-900">Login</h2>
        <p class="mb-4 text-sm text-gray-500">
            {{ __('Welcome back, enter your credentials to continue.') }}
        </p>
    </div>

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input wire:model="form.email" :label="__('Email')" id="form.email" class="block mt-1 w-full"
                     type="email" name="form.email" placeholder="soul@domain.com" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-inputs.password wire:model="form.password" :label="__('Password')" id="form.password" class="block mt-1 w-full"
                            type="password" name="form.password" required autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-between mt-4">
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
            @if (Route::has('password.request'))
                <a class="underline underline-offset-4 font-semibold text-sm text-blue-500 hover:text-blue-600 rounded-md" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('register') }}" class="underline underline-offset-4 font-semibold text-sm text-blue-500 hover:text-blue-600">Register→</a>
            <x-button md black label="{{ __('Sign in') }}" class="rounded-md font-semibold text-sm items-center" type="submit"/>
        </div>
    </form>
</div>
