<?php

namespace App\Livewire\Teacher;

use App\Models\TeacherRecommendation;
use Livewire\Component;

class SubmitRecommendation extends Component
{
    public $subject = '';
    public $comment = '';
    public $submitted = false;

    protected $rules = [
        'subject' => 'required|string|min:3|max:255',
        'comment' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        TeacherRecommendation::create([
            'teacher_id' => auth()->id(),
            'subject' => $this->subject,
            'comment' => $this->comment,
        ]);

        $this->submitted = true;
        $this->reset();

        $this->dispatch('notification', message: 'Your recommendation has been submitted to the Ministry!');
    }

    public function render()
    {
        return view('livewire.teacher.submit-recommendation');
    }
}
