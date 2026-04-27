<?php

namespace App\Livewire\Cluster;

use App\Models\InspectionReport;
use Livewire\Component;
use Livewire\WithPagination;

class Inspection extends Component
{
    use WithPagination;

    public $school_name = '';
    public $findings = '';
    public $inspected_at = '';

    protected $rules = [
        'school_name' => 'required|string|max:255',
        'findings' => 'required|string|max:1200',
        'inspected_at' => 'required|date',
    ];

    public function saveReport()
    {
        $this->validate();

        InspectionReport::create([
            'cluster_head_id' => auth()->id(),
            'school_name' => $this->school_name,
            'findings' => $this->findings,
            'inspected_at' => $this->inspected_at,
            'status' => 'open',
        ]);

        $this->reset(['school_name', 'findings', 'inspected_at']);
        session()->flash('message', 'Inspection report saved successfully.');
    }

    public function closeReport($id)
    {
        $report = InspectionReport::where('cluster_head_id', auth()->id())->findOrFail($id);
        $report->update(['status' => 'closed']);
        session()->flash('message', 'Report closed.');
    }

    public function render()
    {
        return view('livewire.cluster.inspection', [
            'reports' => InspectionReport::where('cluster_head_id', auth()->id())
                ->latest()
                ->paginate(8),
        ]);
    }
}
