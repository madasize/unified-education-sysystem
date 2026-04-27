<?php

namespace App\Livewire\Teacher;

use App\Models\TeachingResource;
use Livewire\Component;

class ResourceHub extends Component
{
    public $title = '';
    public $description = '';
    public $resource_type = 'document';
    public $link = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'resource_type' => 'required|in:document,video,slide,link',
        'link' => 'nullable|url|max:1000',
    ];

    public function saveResource()
    {
        $this->validate();

        TeachingResource::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'resource_type' => $this->resource_type,
            'link' => $this->link,
            'is_public' => true,
        ]);

        $this->reset(['title', 'description', 'resource_type', 'link']);
        session()->flash('message', 'Teaching resource uploaded successfully.');
    }

    public function deleteResource($id)
    {
        $resource = TeachingResource::where('user_id', auth()->id())->findOrFail($id);
        $resource->delete();
        session()->flash('message', 'Resource removed.');
    }

    public function render()
    {
        return view('livewire.teacher.resource-hub', [
            'resources' => TeachingResource::where('user_id', auth()->id())
                ->latest()
                ->get(),
        ]);
    }
}
