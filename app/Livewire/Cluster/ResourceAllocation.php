<?php

namespace App\Livewire\Cluster;

use App\Models\ResourceAllocation as ResourceAllocationModel;
use Livewire\Component;
use Livewire\WithPagination;

class ResourceAllocation extends Component
{
    use WithPagination;

    public $resource_type = '';
    public $quantity = 1;
    public $school_name = '';

    protected $rules = [
        'resource_type' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'school_name' => 'required|string|max:255',
    ];

    public function allocate()
    {
        $this->validate();

        ResourceAllocationModel::create([
            'cluster_head_id' => auth()->id(),
            'resource_type' => $this->resource_type,
            'quantity' => $this->quantity,
            'school_name' => $this->school_name,
        ]);

        $this->reset(['resource_type', 'quantity', 'school_name']);
        session()->flash('message', 'Resource allocation saved successfully.');
    }

    public function render()
    {
        return view('livewire.cluster.resource-allocation', [
            'allocations' => ResourceAllocationModel::where('cluster_head_id', auth()->id())
                ->latest()
                ->paginate(8),
        ]);
    }
}
