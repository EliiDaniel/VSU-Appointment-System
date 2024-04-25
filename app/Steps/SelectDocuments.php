<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class SelectDocuments extends Step
{
    protected string $view = 'requester.request-steps.select-documents';

    public function icon(): string
    {
        return 'check';
    }

    public function validate()
    {
        return [
            [
                'state.selected_documents' => ['required', 'array'],
            ],
            [
                'state.selected_documents' => __('Select Documents'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Select Documents');
    }
}