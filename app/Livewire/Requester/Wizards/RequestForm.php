<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\SelectDocuments;
use App\Steps\Payment;
use App\Steps\AppointmentDate;
use App\Models\Request;
use Carbon\Carbon;

class RequestForm extends WizardComponent
{
    public $dateConfigs;
    public $documents;
    public array $steps = [
        SelectDocuments::class,
        Payment::class,
        AppointmentDate::class,
    ];

    public function mount()
    {
        $this->dateConfigs = [
            'minDate' => Carbon::now()->addDays(2)->startOfDay()->addHours(8)->format('Y-m-d\TH:i'),
            'maxDate' => Carbon::now()->addDays(7)->endOfDay()->subHours(7)->format('Y-m-d\TH:i'),
        ];

        $this->mergeState([
            'user_id' => auth()->user()->id,
            'selected_documents' => [],
            'payment_type' => '',
            'appointment_date' => $this->dateConfigs['minDate'],
        ]);
    }
}