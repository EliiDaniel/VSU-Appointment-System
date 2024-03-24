<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\SelectDocuments;
use App\Steps\Payment;
use App\Steps\PasswordStep;
use App\Models\Request;
use Carbon\Carbon;

class RequestForm extends WizardComponent
{
    public Request $request;
    public $dateConfigs;
    public $documents;

    public function mount()
    {
        $this->dateConfigs = [
            'minDate' => Carbon::now()->addDays(2)->startOfDay()->addHours(8)->format('Y-m-d\TH:i'),
            'maxDate' => Carbon::now()->addDays(7)->endOfDay()->subHours(7)->format('Y-m-d\TH:i'),
        ];

        $this->setState([
            'selectedDocs' => [],
        ]);
    }

    public array $steps = [
        SelectDocuments::class,
        Payment::class,
        PasswordStep::class,
    ];

    public function model(): Request
    {
        return new Request();
    }
    
    public function updatePrice($total)
    {
        $this->total = $total;
    }
}