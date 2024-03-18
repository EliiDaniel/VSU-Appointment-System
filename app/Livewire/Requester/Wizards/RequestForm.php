<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\NameStep;
use App\Steps\EmailStep;
use App\Steps\PasswordStep;
use App\Models\User;

class RequestForm extends WizardComponent
{
    public User $user;

    public array $steps = [
        NameStep::class,
        EmailStep::class,
        PasswordStep::class,
    ];

    public function model(): User
    {
        return new User();
    }
}
