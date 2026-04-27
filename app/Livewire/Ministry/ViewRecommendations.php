<?php

namespace App\Livewire\Ministry;

use App\Models\TeacherRecommendation;
use Livewire\Component;
use Livewire\WithPagination;

class ViewRecommendations extends Component
{
    use WithPagination;

    public $filterStatus = 'pending';
    public $selectedRecommendation = null;
    public $ministryNotes = '';

    public function mount()
    {
        //
    }

    public function viewRecommendation($id)
    {
        $this->selectedRecommendation = TeacherRecommendation::with('teacher', 'school')->find($id);
    }

    public function closeModal()
    {
        $this->selectedRecommendation = null;
        $this->ministryNotes = '';
    }

    public function reviewRecommendation($id, $status)
    {
        $recommendation = TeacherRecommendation::find($id);
        $recommendation->update([
            'status' => $status,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'ministry_notes' => $this->ministryNotes ?: null,
        ]);

        $this->dispatch('notification', message: "Recommendation {$status} successfully!");
        $this->closeModal();
    }

    #[\Livewire\Attributes\On('updateFilters')]
    public function updateFilters($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function render()
    {
        $recommendations = TeacherRecommendation::with('teacher', 'school')
            ->where('status', $this->filterStatus)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.ministry.view-recommendations', [
            'recommendations' => $recommendations,
        ]);
    }
}
