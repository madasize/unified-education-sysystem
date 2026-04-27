<?php

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\computed;
use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => '',
    'role' => 'teacher',
    'school_id' => null,
    'verification_info' => '',
]);

$schools = computed(fn() => School::all());

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    'role' => ['required', 'string', 'in:teacher,cluster,headteacher,ministry'],
    'school_id' => ['required_if:role,headteacher', 'nullable', 'exists:schools,id'],
    'verification_info' => ['required_if:role,headteacher', 'nullable', 'string', 'max:1000'],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    'role' => ['required', 'string', 'in:teacher,cluster_leader,headteacher,ministry_official'],
    'school_id' => ['required_if:role,headteacher', 'nullable', 'exists:schools,id'],
    'verification_info' => ['required_if:role,headteacher', 'nullable', 'string', 'max:1000'],
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
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Create Your USEMS Account</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Register now to manage resources, grades, and cluster collaboration.</p>
    </div>

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />

            <select wire:model="role" id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                <option value="teacher">Teacher</option>
                <option value="cluster_leader">Cluster Leader</option>
                <option value="headteacher">Headteacher</option>
                <option value="ministry_official">Ministry Official</option>
            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        @if($this->role === 'headteacher')
            <div class="mt-4">
                <x-input-label for="school_id" :value="__('School')" />

                <select wire:model="school_id" id="school_id" name="school_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                    <option value="">Select School</option>
                    @foreach($this->schools as $school)
                        <option value="{{ $school->id }}">
                            {{ $school->name }}
                            @if($school->region || $school->district)
                                — {{ $school->region ?? '' }}{{ $school->region && $school->district ? ' / ' : '' }}{{ $school->district ?? '' }}
                            @endif
                            @if($school->school_type)
                                · {{ $school->school_type }}
                            @endif
                            @if($school->gender)
                                · {{ $school->gender }}
                            @endif
                            @if($school->ownership)
                                · {{ $school->ownership }}
                            @endif
                        </option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="verification_info" :value="__('Verification Information')" />

                <textarea wire:model="verification_info" id="verification_info" name="verification_info" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" rows="4" placeholder="Enter credential verification details such as name of the school, district office, or registration number."></textarea>

                <x-input-error :messages="$errors->get('verification_info')" class="mt-2" />
            </div>
        @endif

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
