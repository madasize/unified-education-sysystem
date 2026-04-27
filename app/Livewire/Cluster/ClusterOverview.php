<?php

namespace App\Livewire\Cluster;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;

class ClusterOverview extends Component
{
    public function render()
    {
        $totalStudents = Student::count();
        $averageScore = Grade::avg('score') ?: 0;
        $activeSchools = Student::distinct('form')->count('form');
        $totalGrades = Grade::count();

        return view('livewire.cluster.cluster-overview', [
            'totalStudents' => $totalStudents,
            'averageScore' => number_format($averageScore, 1),
            'activeSchools' => $activeSchools,
            'totalGrades' => $totalGrades,
        ]);
    }
}
