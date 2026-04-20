<?php

use function Livewire\Volt\{state, rules, action, computed};
use App\Models\Grade;
use App\Models\Student;

// 1. Setup State: Default to Form 1 and Term 1
state([
    'selected_form' => 'Form 1', 
    'subject' => '', 
    'term' => 'Term 1', 
    'scores' => [], // This will hold [student_id => score]
    'search' => ''
]);

// 2. Load Students: Automatically sorted alphabetically by Last Name
$students = computed(function () {
    return Student::where('form', $this->selected_form)
        ->where(function($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('last_name', 'asc')
        ->get();
});

// 3. Batch Save Action: Saves every score in the list at once
$saveAll = action(function () {
    if (!$this->subject) {
        session()->flash('error', 'Please select a subject first.');
        return;
    }

    foreach ($this->scores as $studentId => $scoreValue) {
        if ($scoreValue !== null && $scoreValue !== '') {
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject' => $this->subject,
                    'term' => $this->term,
                ],
                [
                    'student_id' => $studentId,
                    'subject' => $this->subject,
                    'term' => $this->term,
                    'score' => $scoreValue,
                    'user_id' => auth()->id(),
                ]
            );
        }
    }

    session()->flash('message', "Grades for {$this->selected_form} updated successfully!");
});

?>

<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-wrap gap-4 items-end">
        <div class="w-48">
            <x-input-label value="Select Class (Form)" class="text-[10px] uppercase font-bold text-gray-400" />
            <select wire:model.live="selected_form" class="mt-1 block w-full rounded-xl border-none bg-gray-50 text-gray-700 focus:ring-2 focus:ring-emerald-500 shadow-sm font-semibold">
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
            </select>
        </div>

        <div class="w-48">
            <x-input-label value="Subject" class="text-[10px] uppercase font-bold text-gray-400" />
            <select wire:model="subject" class="mt-1 block w-full rounded-xl border-none bg-gray-50 text-gray-700 focus:ring-2 focus:ring-emerald-500 shadow-sm font-semibold">
                <option value="">Select Subject...</option>
                <option value="Mathematics">Mathematics</option>
                <option value="English">English</option>
                <option value="Chichewa">Chichewa</option>
                <option value="Biology">Biology</option>
                <option value="Physics">Physics</option>
                <option value="Geography">Geography</option>
            </select>
        </div>

        <div class="flex-1 min-w-[200px]">
            <x-input-label value="Search List" class="text-[10px] uppercase font-bold text-gray-400" />
            <div class="relative">
                <input wire:model.live="search" type="text" placeholder="Filter by name..." class="mt-1 w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-emerald-500" />
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                <tr>
                    <th class="px-8 py-4">Student Name (A-Z)</th>
                    <th class="px-8 py-4">Student ID</th>
                    <th class="px-8 py-4 text-center w-32">Score (%)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($this->students as $student)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-4">
                            <span class="font-bold text-gray-800">{{ $student->last_name }}</span>, {{ $student->first_name }}
                        </td>
                        <td class="px-8 py-4 text-gray-400 font-mono text-xs">{{ $student->student_id }}</td>
                        <td class="px-8 py-4">
                            <input type="number" 
                                   wire:model="scores.{{ $student->id }}" 
                                   class="w-full text-center font-bold bg-gray-50 border-none rounded-lg focus:ring-2 focus:ring-emerald-500 py-2"
                                   placeholder="--">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2 opacity-20">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a5.97 5.97 0 00-.94 3.197M15.75 22.5a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3zM6 1.5a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 1.5zm1.5 4.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 6z" />
                                </svg>
                                <p>No students enrolled in {{ $selected_form }} yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-6 bg-gray-50 flex justify-between items-center border-t border-gray-100">
            @if (session()->has('message'))
                <span class="text-emerald-600 font-bold text-sm animate-bounce">{{ session('message') }}</span>
            @elseif (session()->has('error'))
                <span class="text-red-500 font-bold text-sm">{{ session('error') }}</span>
            @else
                <span class="text-gray-400 text-xs italic italic">Review scores before saving to database.</span>
            @endif

            <button wire:click="saveAll" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg shadow-emerald-100">
                Save All {{ $selected_form }} Grades
            </button>
        </div>
    </div>
</div>