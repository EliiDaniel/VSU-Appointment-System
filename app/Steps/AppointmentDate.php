<?php

namespace App\Steps;

use App\Models\Request;
use App\Models\VerifiedEmail;
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
            'user_id' => isset($state['user_id']) ? $state['user_id'] : null,
            'verified_email_id' => isset($state['email']) ? VerifiedEmail::where('email', $state['email'])->first()->id : null,
            'price' => $state['price'],
            'payment_type' => $state['payment_type'],
            'appointment_date' => Carbon::parse($state['appointment_date'])->format('Y-m-d\TH:i'),
        ]);

        $syncData = [];
        foreach ($this->getLivewire()->selected_docs as $doc) {
            $syncData[] = [
                'document_id' => $doc->id,
                'quantity' => $state['quantities'][$doc->id]
            ];
        }

        $request->documents()->sync($syncData);

        if (isset($this->getLivewire()->transaction)) {
            $this->getLivewire()->transaction->update(['request_id' => $request->id]);
        }

        return $this->getLivewire()->reDir !== '/' ? redirect()->route($this->getLivewire()->reDir) : redirect('/');
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