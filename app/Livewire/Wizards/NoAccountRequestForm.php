<?php

namespace App\Livewire\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\SelectDocuments;
use App\Steps\Payment;
use App\Steps\AppointmentDate;
use App\Steps\Email;
use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailVerification;
use Illuminate\Support\Facades\Validator;

class NoAccountRequestForm extends WizardComponent
{
    public $dateConfigs;
    public $documents;
    public $reDir;
    public $verifiedEmail;

    public array $steps = [
        Email::class,
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
            'email' => $this->verifiedEmail,
            'selected_documents' => [],
            'payment_type' => '',
            'appointment_date' => $this->dateConfigs['minDate'],
        ]);
    }

    public function verify()
    {
        $validator = Validator::make(
            ['email' => $this->state['email']],
            ['email' => 'required|email']
        );

        if ($validator->fails()) {
            $this->addError('email', $validator->errors()->first('email'));
            return;
        }

        Notification::route('mail', $this->state['email'])->notify(new EmailVerification(url('/verify-email/' . urlencode($this->state['email']))));
        session()->flash('email_sent', 'Verification email has been sent.');
    }
}