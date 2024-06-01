<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <div>
        <h2 class="mt-6 text-xl font-bold tracking-tight text-gray-900">Register</h2>
        <p class="mb-4 text-sm text-gray-500">
            {{ __('Please login, if you have already created an account.') }}
        </p>
    </div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input wire:model="name" :label="__('Name')" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input wire:model="email" :label="__('Email')" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-inputs.password wire:model="password" :label="__('Password')" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-inputs.password wire:model="password_confirmation" :label="__('Password Confirmation')" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline underline-offset-4 font-semibold text-sm text-blue-500 hover:text-blue-600 rounded-md" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-button md black :label="__('Register')" class="ms-4 rounded-md font-semibold text-sm" type="submit" />
        </div>
    </form>
</div>
