<?php

namespace App\Steps;

use App\Models\Request;
use Vildanbina\LivewireWizard\Components\Step;
use Carbon\Carbon;

class AppointmentDate extends Step
{
    protected string $view = 'requester.request-steps.appointment-date';

    public function icon(): string
    {
        return 'check';
    }

    public function save($state)
    {
        $request = Request::create([
            'user_id' => $state['user_id'],
            'price' => $state['price'],
            'payment_type' => $state['payment_type'],
            'appointment_date' => Carbon::parse($state['appointment_date'])->format('Y-m-d\TH:i'),
        ]);

        $request->documents()->sync($state['selected_documents']);

        return redirect()->route($this->getLivewire()->reDir);
    }

    public function validate()
    {
        return [
            [
                'state.appointment_date' => ['required','date'],
            ],
            [
                'state.appointment_date' => __('Pickup'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Pickup');
    }
}