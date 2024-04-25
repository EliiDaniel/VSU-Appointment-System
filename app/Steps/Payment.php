<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class Payment extends Step
{
    protected string $view = 'requester.request-steps.payment';

    public function icon(): string
    {
        return 'check';
    }

    public function validate()
    {
        if($this->getLivewire()->getState()['payment_type'] === 'Online'){
            return [
                [
                    'state.payment_type' => ['required', 'string'],
                    'state.checkout_id' => ['required', 'string', 'exists:transactions,checkout_id'],
                ],
                [
                    'state.payment_type' => __('Payment'),
                    'state.checkout_id' => __('Payment'),
                ],
            ];
        }
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