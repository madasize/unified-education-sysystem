<?php

namespace App\Livewire\Teacher;

use App\Models\TeacherRecommendation;
use Livewire\Component;
use Livewire\WithPagination;

class ViewRecommendationStatus extends Component
{
    use WithPagination;

    public $filterStatus = 'all';

    public function updateFilter($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function render()
    {
        $query = TeacherRecommendation::where('teacher_id', auth()->id());

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        $recommendations = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.teacher.view-recommendation-status', [
            'recommendations' => $recommendations,
        ]);
    }
}
