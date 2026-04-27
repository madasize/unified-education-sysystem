<?php

use function Livewire\Volt\{state, rules, action, computed};
use App\Models\Student;

state(['first_name' => '', 'last_name' => '', 'form' => 'Form 1', 'stream' => 'A', 'student_id' => '', 'search' => '', 'selected_form' => '']);

rules([
    'first_name' => 'required|min:2',
    'last_name' => 'required|min:2',
    'form' => 'required',
    'student_id' => 'required|unique:students,student_id',
]);

$students = computed(function () {
    $query = Student::query();

    if ($this->selected_form) {
        $query->where('form', $this->selected_form);
    }

    return $query->where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('student_id', 'like', '%' . $this->search . '%');
        })
        ->orderBy('form', 'asc')
        ->orderBy('last_name', 'asc')
        ->paginate(10);
});

$enroll = action(function () {
    $this->validate();

    Student::create([
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'form' => $this->form,
        'stream' => $this->stream,
        'student_id' => $this->student_id,
    ]);

    $this->reset(['first_name', 'last_name', 'student_id']);
    session()->flash('message', 'Student enrolled successfully!');
});

$remove = action(function ($id) {
    Student::find($id)->delete();
});

?>

<div class="space-y-6">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-emerald-600 font-bold uppercase text-xs tracking-widest mb-6">Enroll New Student</h2>
        <form wire:submit="enroll" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>
                <x-input-label value="First Name" class="text-[10px]" />
                <x-text-input wire:model="first_name" class="w-full bg-gray-50 border-none mt-1" placeholder="John" />
            </div>
            <div>
                <x-input-label value="Last Name" class="text-[10px]" />
                <x-text-input wire:model="last_name" class="w-full bg-gray-50 border-none mt-1" placeholder="Phiri" />
            </div>
            <div>
                <x-input-label value="Form" class="text-[10px]" />
                <select wire:model="form" class="w-full bg-gray-50 border-none rounded-lg mt-1 text-sm">
                    <option value="Form 1">Form 1</option>
                    <option value="Form 2">Form 2</option>
                    <option value="Form 3">Form 3</option>
                    <option value="Form 4">Form 4</option>
                </select>
            </div>
            <div>
                <x-input-label value="Student ID / MANEB" class="text-[10px]" />
                <x-text-input wire:model="student_id" class="w-full bg-gray-50 border-none mt-1" placeholder="S001-2024" />
            </div>
            <button type="submit" class="bg-emerald-600 text-white font-bold py-2.5 rounded-xl hover:bg-emerald-700 transition-all shadow-md shadow-emerald-100">
                Enroll
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="font-bold text-gray-800">Student Directory</h3>
                <p class="text-sm text-gray-500">Filter students by class or search by name / ID.</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <select wire:model.live="selected_form" class="bg-gray-50 border-none rounded-lg text-sm px-4 py-3">
                    <option value="">All Forms</option>
                    <option value="Form 1">Form 1</option>
                    <option value="Form 2">Form 2</option>
                    <option value="Form 3">Form 3</option>
                    <option value="Form 4">Form 4</option>
                </select>
                <input wire:model.live="search" type="text" placeholder="Search by name or ID..." class="bg-gray-50 border-none rounded-lg text-sm w-64 px-4 py-3" />
            </div>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-[10px] uppercase font-bold text-gray-400">
                <tr>
                    <th class="px-8 py-4">Name</th>
                    <th class="px-8 py-4">Class</th>
                    <th class="px-8 py-4">Student ID</th>
                    <th class="px-8 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @foreach($this->students as $student)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-8 py-4 font-semibold text-gray-700">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td class="px-8 py-4"><span class="bg-emerald-50 text-emerald-700 px-2 py-1 rounded text-xs font-bold">{{ $student->form }}</span></td>
                        <td class="px-8 py-4 text-gray-400 font-mono">{{ $student->student_id }}</td>
                        <td class="px-8 py-4 text-right">
                            <button wire:click="remove({{ $student->id }})" wire:confirm="Remove this student and all their grades?" class="text-gray-300 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>