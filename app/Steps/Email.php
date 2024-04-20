<?php

namespace App\Steps;

use Illuminate\Validation\Rule;
use Vildanbina\LivewireWizard\Components\Step;

class Email extends Step
{
    protected string $view = 'requester.request-steps.email';

    public function icon(): string
    {
        return 'check';
    }

    public function validate()
    {
        return [
            [
                'state.email' => ['required', 'email', 'exists:verified_emails,email'],
            ],
            [
                'state.email' => __('Email has not been verified'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Email');
    }
}