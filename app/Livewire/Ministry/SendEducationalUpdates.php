<?php

namespace App\Livewire\Ministry;

use App\Models\EducationalUpdate;
use Livewire\Component;
use Livewire\WithPagination;

class SendEducationalUpdates extends Component
{
    use WithPagination;

    public $title = '';
    public $content = '';
    public $priority = 'medium';
    public $status = 'draft';
    public $targetRecipients = [];
    public $expiresAt = null;

    public $showForm = false;
    public $editingId = null;

    protected $rules = [
        'title' => 'required|string|min:5|max:255',
        'content' => 'required|string|min:10',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:draft,published,archived',
        'targetRecipients' => 'array',
        'expiresAt' => 'nullable|date',
    ];

    public function openForm()
    {
        $this->showForm = true;
        $this->reset(['title', 'content', 'priority', 'status', 'targetRecipients', 'expiresAt', 'editingId']);
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->reset(['title', 'content', 'priority', 'status', 'targetRecipients', 'expiresAt']);
    }

    public function saveUpdate()
    {
        $this->validate();

        if ($this->editingId) {
            $update = EducationalUpdate::find($this->editingId);
            $update->update([
                'title' => $this->title,
                'content' => $this->content,
                'priority' => $this->priority,
                'status' => $this->status,
                'target_recipients' => $this->targetRecipients ?: null,
                'expires_at' => $this->expiresAt,
                'published_at' => $this->status === 'published' ? now() : null,
            ]);
        } else {
            EducationalUpdate::create([
                'ministry_user_id' => auth()->id(),
                'title' => $this->title,
                'content' => $this->content,
                'priority' => $this->priority,
                'status' => $this->status,
                'target_recipients' => $this->targetRecipients ?: null,
                'expires_at' => $this->expiresAt,
                'published_at' => $this->status === 'published' ? now() : null,
            ]);
        }

        $this->dispatch('notification', message: 'Educational update ' . ($this->editingId ? 'updated' : 'created') . ' successfully!');
        $this->closeForm();
    }

    public function editUpdate($id)
    {
        $update = EducationalUpdate::find($id);
        $this->editingId = $id;
        $this->title = $update->title;
        $this->content = $update->content;
        $this->priority = $update->priority;
        $this->status = $update->status;
        $this->targetRecipients = $update->target_recipients ?? [];
        $this->expiresAt = $update->expires_at?->format('Y-m-d');
        $this->showForm = true;
    }

    public function deleteUpdate($id)
    {
        EducationalUpdate::find($id)->delete();
        $this->dispatch('notification', message: 'Update deleted successfully!');
    }

    public function render()
    {
        $updates = EducationalUpdate::where('ministry_user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.ministry.send-educational-updates', [
            'updates' => $updates,
        ]);
    }
}
