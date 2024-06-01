<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
};

?>

<div>
    <div>
        <h2 class="mt-6 text-xl font-bold tracking-tight text-gray-900">{{ __('Forgot Password') }}</h2>
        <div class="mb-4 text-sm text-gray-500">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-input wire:model="email" :label="__('Email')" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-button md :label="__('Cancel')" class="rounded-md font-semibold text-sm" :href="route('login')" wire:navigate />
            <x-button md black :label="__('Email Password Reset Link')" class="rounded-md font-semibold text-sm" type="submit"/>
        </div>
    </form>
</div>
