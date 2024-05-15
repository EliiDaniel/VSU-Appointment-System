<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class Credentials extends Step
{
    protected string $view = 'requester.request-steps.credentials';

    public function mount()
    {
        $this->mergeState([
            'requester_name',
            'school_id',
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
                'state.credentials' => ['required', 'array'],
                'state.credentials.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
                'state.requester_name' => ['required', 'string', 'max:255'],
                'state.school_id' => ['required', 'string', 'max:255'],
            ],
            [
                'state.credentials' => __('Invalid Credential(s) input'),
                'state.requester_name' => __('Name Cannot Be Empty'),
                'state.school_id' => __('ID Cannot Be Empty'),
                'state.credentials.*' =>  __('Files must be images'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Credentials');
    }
}