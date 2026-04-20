<?php

use function Livewire\Volt\{state, computed};
use App\Models\Student;
use App\Models\Grade;

state(['selectedStudentId' => null, 'term' => 'Term 1']);

$students = computed(fn() => Student::all());

$reportData = computed(function () {
    if (!$this->selectedStudentId) return null;

    return Student::with(['grades' => function($query) {
        $query->where('term', $this->term);
    }])->find($this->selectedStudentId);
});

$calculateAverage = function($grades) {
    if ($grades->isEmpty()) return 0;
    return $grades->avg('score');
};

?>

<div class="p-6 space-y-6">
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex gap-4 items-end">
        <div class="flex-1">
            <x-input-label value="Select Student" class="text-[10px] mb-1" />
            <select wire:model.live="selectedStudentId" class="w-full bg-gray-50 border-none rounded-xl text-sm">
                <option value="">-- Choose Student --</option>
                @foreach($this->students as $student)
                    <option value="{{ $student->id }}">{{ $student->last_name }}, {{ $student->first_name }} ({{ $student->student_id }})</option>
                @endforeach
            </select>
        </div>
        <div class="w-32">
            <x-input-label value="Term" class="text-[10px] mb-1" />
            <select wire:model.live="term" class="w-full bg-gray-50 border-none rounded-xl text-sm">
                <option>Term 1</option>
                <option>Term 2</option>
                <option>Term 3</option>
            </select>
        </div>
        <button onclick="window.print()" class="bg-gray-800 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-black transition-all">
            Print Report
        </button>
    </div>

    @if($this->reportData)
    <div id="report-card" class="bg-white p-12 rounded-3xl shadow-lg border border-gray-100 mx-auto max-w-4xl print:shadow-none print:border-none">
        <div class="text-center border-b-2 border-gray-800 pb-6 mb-8">
            <h1 class="text-3xl font-black uppercase tracking-tighter">USEMS Digital Report Card</h1>
            <p class="text-gray-500 font-mono text-sm">Ministry of Education Secondary Education Results</p>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-10">
            <div>
                <p class="text-[10px] uppercase font-bold text-gray-400">Student Name</p>
                <p class="text-xl font-bold">{{ $this->reportData->first_name }} {{ $this->reportData->last_name }}</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] uppercase font-bold text-gray-400">Class / Form</p>
                <p class="text-xl font-bold">{{ $this->reportData->form }} - {{ $this->reportData->stream }}</p>
            </div>
        </div>

        <table class="w-full mb-10">
            <thead>
                <tr class="border-b-2 border-gray-100 text-left text-[10px] uppercase font-black tracking-widest text-gray-400">
                    <th class="py-3">Subject</th>
                    <th class="py-3 text-center">Score (%)</th>
                    <th class="py-3 text-right">Grade</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($this->reportData->grades as $grade)
                <tr>
                    <td class="py-4 font-bold text-gray-700">{{ $grade->subject }}</td>
                    <td class="py-4 text-center font-mono">{{ number_format($grade->score, 1) }}%</td>
                    <td class="py-4 text-right font-black">
                        @if($grade->score >= 75) <span class="text-emerald-600">A</span>
                        @elseif($grade->score >= 60) <span class="text-blue-600">B</span>
                        @elseif($grade->score >= 45) <span class="text-orange-600">C</span>
                        @else <span class="text-red-600">F</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-gray-50 rounded-2xl p-6 flex justify-between items-center">
            <div>
                <p class="text-[10px] uppercase font-bold text-gray-400">Average Score</p>
                <p class="text-3xl font-black text-gray-800">{{ number_format($calculateAverage($this->reportData->grades), 1) }}%</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] uppercase font-bold text-gray-400">Headteacher's Signature</p>
                <div class="h-12 w-48 border-b border-gray-400 mt-2 italic text-gray-300">Digital Seal Verified</div>
            </div>
        </div>
    </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
            <p class="text-gray-400 font-medium">Please select a student to generate their academic report.</p>
        </div>
    @endif
</div>