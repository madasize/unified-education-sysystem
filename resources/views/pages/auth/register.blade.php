<?php

use function Livewire\Volt\{state, rules, computed};
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Volt\Component;

state(['name' => '', 'email' => '', 'password' => '', 'password_confirmation' => '', 'role' => 'teacher', 'school_id' => null, 'verification_info' => '']);

$schools = computed(fn() => School::all());

rules([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => ['required', 'confirmed', Password::defaults()],
    'role' => 'required|in:teacher,headteacher,cluster,ministry',
    'school_id' => 'required_if:role,headteacher|exists:schools,id',
    'verification_info' => 'required_if:role,headteacher|string|max:1000',
]);

$submit = function () {
    $validated = $this->validate();

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'school_id' => $validated['school_id'],
        'verification_info' => $validated['verification_info'],
    ]);

    auth()->login($user);

    return redirect('/dashboard');
};

?>

<x-guest-layout>
    <form wire:submit="submit" class="space-y-6">
        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="role" value="Role" />
            <select wire:model="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="teacher">Teacher</option>
                <option value="headteacher">Headteacher</option>
                <option value="cluster">Cluster Head</option>
                <option value="ministry">Ministry</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        @if($this->role === 'headteacher')
        <div>
            <x-input-label for="school_id" value="School" />
            <select wire:model="school_id" id="school_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                        @if($school->ownership)
                            · {{ $school->ownership }}
                        @endif
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="verification_info" value="Verification Information" />
            <textarea wire:model="verification_info" id="verification_info" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Provide details on how to verify your credentials (e.g., contact info, certificate number)"></textarea>
            <x-input-error :messages="$errors->get('verification_info')" class="mt-2" />
        </div>
        @endif

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>