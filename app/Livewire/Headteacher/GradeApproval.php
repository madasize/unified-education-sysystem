<?php

namespace App\Livewire\Headteacher;

use App\Models\Grade;
use Livewire\Component;
use Livewire\WithPagination;

class GradeApproval extends Component
{
    use WithPagination;

    public $showOnlyPending = true;

    public function approveGrade($gradeId)
    {
        $grade = Grade::findOrFail($gradeId);
        $grade->update(['is_synced' => true]);
        session()->flash('message', 'Grade approved successfully.');
    }

    public function togglePendingFilter()
    {
        $this->showOnlyPending = !$this->showOnlyPending;
        $this->resetPage();
    }

    public function render()
    {
        $query = Grade::with('teacher')->orderBy('created_at', 'desc');

        if ($this->showOnlyPending) {
            $query->where('is_synced', false);
        }

        return view('livewire.headteacher.grade-approval', [
            'grades' => $query->paginate(10),
        ]);
    }
}
