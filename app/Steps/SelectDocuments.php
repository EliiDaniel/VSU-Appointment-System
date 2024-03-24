<?php

namespace App\Steps;

use Illuminate\Validation\Rules;
use Vildanbina\LivewireWizard\Components\Step;

class SelectDocuments extends Step
{
    protected string $view = 'requester.request-steps.select-documents';
    
    public function mount()
    {
        $this->setState([
            'price' => $this->model->price,
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
                'state.selectedDocs' => ['required', 'array'],
            ],
            [
                'state.selectedDocs' => __('Select Documents'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Select Documents');
    }
}