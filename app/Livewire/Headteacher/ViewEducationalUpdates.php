<?php

namespace App\Livewire\Headteacher;

use App\Models\EducationalUpdate;
use Livewire\Component;
use Livewire\WithPagination;

class ViewEducationalUpdates extends Component
{
    use WithPagination;

    public $selectedUpdate = null;

    public function viewUpdate($id)
    {
        $this->selectedUpdate = EducationalUpdate::find($id);
    }

    public function closeModal()
    {
        $this->selectedUpdate = null;
    }

    public function render()
    {
        $updates = EducationalUpdate::where('status', 'published')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->where(function ($query) {
                $targetRecipients = $query->orWhereNull('target_recipients')
                    ->orWhereJsonContains('target_recipients', 'headteacher');
                return $targetRecipients;
            })
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        return view('livewire.headteacher.view-educational-updates', [
            'updates' => $updates,
        ]);
    }
}
