<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class Payment extends Step
{
    protected string $view = 'requester.request-steps.payment';
    
    public function mount()
    {
        $this->mergeState([
            'payment_type',
        ]);
    }

    public function icon(): string
    {
        return 'check';
    }

    public function validate()
    {
        return [
            [
                'state.payment_type' => ['required', 'string'],
            ],
            [
                'state.payment_type' => __('Payment'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Payment');
    }
}