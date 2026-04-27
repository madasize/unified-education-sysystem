<?php

namespace App\Livewire\Reports;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;

class StudentReport extends Component
{
    public $selected_form = 'Form 1';
    public $term = 'Term 1';

    public function getReportCardsProperty()
    {
        $students = Student::with(['grades' => function ($query) {
            $query->where('term', $this->term);
        }])
        ->where('form', $this->selected_form)
        ->get()
        ->map(function (Student $student) {
            $student->average_score = $student->grades->isEmpty()
                ? 0
                : $student->grades->avg('score');

            return $student;
        });

        $sorted = $students->sortByDesc('average_score')->values();

        $position = 0;
        $lastAverage = null;

        return $sorted->map(function (Student $student, $index) use (&$position, &$lastAverage) {
            if ($lastAverage !== $student->average_score) {
                $position = $index + 1;
                $lastAverage = $student->average_score;
            }

            $student->position = $position;

            return $student;
        });
    }

    public function getStudentCountProperty()
    {
        return $this->reportCards->count();
    }

    public function getSchoolLogoProperty()
    {
        return auth()->user()->school?->logo_path;
    }

    public function getAverageForStudent(Student $student)
    {
        if ($student->grades->isEmpty()) {
            return 0;
        }

        return $student->grades->avg('score');
    }

    public function render()
    {
        return view('livewire.reports.student-report');
    }
}
