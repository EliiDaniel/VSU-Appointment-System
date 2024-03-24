<?php

namespace App\Steps;

use Illuminate\Validation\Rule;
use Vildanbina\LivewireWizard\Components\Step;

class Payment extends Step
{
    protected string $view = 'requester.request-steps.payment';

    public function mount()
    {
        $this->mergeState([
            'email' => $this->model->email
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
                'state.email' => ['required', 'email', Rule::unique('users', 'email')],
            ],
            [
                'state.email' => __('Payment'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Payment');
    }
}