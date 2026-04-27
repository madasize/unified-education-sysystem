<?php

use function Livewire\Volt\{state, computed};
use App\Models\Student;
use App\Models\Grade;

state(['selected_form' => 'Form 1', 'term' => 'Term 1']);

$reportCards = computed(function () {
    return Student::with(['grades' => function ($query) {
        $query->where('term', $this->term);
    }])
    ->where('form', $this->selected_form)
    ->orderBy('last_name', 'asc')
    ->get();
});

$calculateAverage = function ($grades) {
    if ($grades->isEmpty()) return 0;
    return $grades->avg('score');
};

?>

<div class="p-6 space-y-6">
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
            <div>
                <x-input-label value="Select Form" class="text-[10px] mb-1" />
                <select wire:model.live="selected_form" class="w-full bg-gray-50 border-none rounded-xl text-sm px-4 py-3">
                    <option value="Form 1">Form 1</option>
                    <option value="Form 2">Form 2</option>
                    <option value="Form 3">Form 3</option>
                    <option value="Form 4">Form 4</option>
                </select>
            </div>
            <div>
                <x-input-label value="Term" class="text-[10px] mb-1" />
                <select wire:model.live="term" class="w-full bg-gray-50 border-none rounded-xl text-sm px-4 py-3">
                    <option>Term 1</option>
                    <option>Term 2</option>
                    <option>Term 3</option>
                </select>
            </div>
        </div>

        <button onclick="window.print()" class="bg-gray-800 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-black transition-all">
            Print Form Report
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="font-bold text-gray-800">{{ $this->selected_form }} Report Cards</h3>
                <p class="text-sm text-gray-500">Showing {{ $this->reportCards->count() }} students for {{ $this->term }}.</p>
            </div>
        </div>

        @if($this->reportCards->isEmpty())
            <div class="p-10 text-center text-gray-500">No students found for {{ $this->selected_form }}.</div>
        @else
            <div class="divide-y divide-gray-100">
                @if($this->schoolLogo)
                    <div class="p-6 text-center">
                        <img src="{{ asset('storage/' . $this->schoolLogo) }}" alt="School Logo" class="h-16 mx-auto">
                    </div>
                @endif
                @foreach($this->reportCards as $student)
                    <div class="p-6">
                        <div class="grid gap-6 lg:grid-cols-[1fr_2fr]">
                            <div class="space-y-2">
                                <p class="text-[10px] uppercase font-bold text-gray-400">Student</p>
                                <p class="text-lg font-bold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</p>
                                <p class="text-sm text-gray-500">{{ $student->student_id }} · {{ $student->form }} - {{ $student->stream }}</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3">
                                <div class="rounded-3xl bg-gray-50 p-4">
                                    <p class="text-[10px] uppercase font-bold text-gray-400">Term</p>
                                    <p class="mt-2 text-lg font-semibold text-gray-900">{{ $this->term }}</p>
                                </div>
                                <div class="rounded-3xl bg-gray-50 p-4">
                                    <p class="text-[10px] uppercase font-bold text-gray-400">Average Score</p>
                                    <p class="mt-2 text-lg font-semibold text-gray-900">{{ number_format($student->average_score, 1) }}%</p>
                                </div>
                                <div class="rounded-3xl bg-gray-50 p-4">
                                    <p class="text-[10px] uppercase font-bold text-gray-400">Position</p>
                                    <p class="mt-2 text-lg font-semibold text-gray-900">{{ $student->position }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 overflow-hidden rounded-3xl border border-gray-100">
                            <table class="w-full text-left text-sm text-gray-600">
                                <thead class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Subject</th>
                                        <th class="px-4 py-3 text-center">Score</th>
                                        <th class="px-4 py-3 text-right">Grade</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($student->grades as $grade)
                                        <tr>
                                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $grade->subject }}</td>
                                            <td class="px-4 py-3 text-center font-mono">{{ number_format($grade->score, 1) }}%</td>
                                            <td class="px-4 py-3 text-right font-black">
                                                @if($grade->score >= 75)
                                                    <span class="text-emerald-600">A</span>
                                                @elseif($grade->score >= 60)
                                                    <span class="text-blue-600">B</span>
                                                @elseif($grade->score >= 45)
                                                    <span class="text-orange-600">C</span>
                                                @else
                                                    <span class="text-red-600">F</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-6 text-center text-gray-400">No grades entered for this term.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
