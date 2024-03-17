<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Models\Request;

class RequestWizard extends WizardComponent
{
    public function model()
    {
        return Request::findOrNew($this->userId);
    }
}