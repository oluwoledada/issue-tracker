<?php

namespace App\Livewire;

use Livewire\Component;

class IssueTracker extends Component
{
    public $issues = [];
    public $newIssue;

    public function addIssue()
    {
        if ($this->newIssue) {
            $this->issues[] = ['name' => $this->newIssue, 'status' => 'backlog', 'completed' => false];
            $this->newIssue = '';
        }
    }

    public function updateStatus($index, $status)
    {
        $this->issues[$index]['status'] = $status;
    }

    public function deleteIssue($index)
    {
        unset($this->issues[$index]);
    }

    public function render()
    {
        return view('livewire.issue-tracker');
    }
}
