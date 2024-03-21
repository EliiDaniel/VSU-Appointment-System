<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\NameStep;
use App\Steps\EmailStep;
use App\Steps\PasswordStep;
use App\Models\Request;
use Carbon\Carbon;

class RequestForm extends WizardComponent
{
    public Request $request;
    public $dateConfigs;

    public function mount()
    {
        $this->dateConfigs = [
            'minDate' => Carbon::now()->addDays(2)->startOfDay()->addHours(8)->format('Y-m-d\TH:i'),
            'maxDate' => Carbon::now()->addDays(7)->endOfDay()->subHours(7)->format('Y-m-d\TH:i'),
        ];
    }

    public array $steps = [
        NameStep::class,
        EmailStep::class,
        PasswordStep::class,
    ];

    public function model(): Request
    {
        return new Request();
    }
}