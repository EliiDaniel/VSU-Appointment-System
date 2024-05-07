<?php

namespace App\Livewire\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\SelectDocuments;
use App\Steps\Payment;
use App\Steps\AppointmentDate;
use App\Steps\Email;
use App\Models\Request;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\BlockedDate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailVerification;
use Illuminate\Support\Facades\Validator;
use Luigel\Paymongo\Facades\Paymongo;

class NoAccountRequestForm extends WizardComponent
{
    public $dateConfigs;
    public $documents;
    public $reDir;
    public $verifiedEmail;
    public $checkout;
    public $selected_docs;
    public ?Transaction $transaction;
    public ?Schedule $schedule;

    public array $steps = [
        Email::class,
        SelectDocuments::class,
        Payment::class,
        AppointmentDate::class,
    ];

    public function mount()
    {
        $this->schedule = Schedule::first();
        $this->dateConfigs = [
            'minDate' => Carbon::now()->addDays($this->schedule->min)->startOfDay()->addHours(8)->format('Y-m-d\TH:i'),
            'maxDate' => Carbon::now()->addDays($this->schedule->min + $this->schedule->max)->endOfDay()->subHours(7)->format('Y-m-d\TH:i'),
            'blockedDates' => BlockedDate::getFormattedBlockedDates(Carbon::now()->addDays($this->schedule->min)->startOfDay()->addHours(8)->format('Y-m-d\TH:i'), Carbon::now()->addDays($this->schedule->min + $this->schedule->max)->endOfDay()->subHours(7)->format('Y-m-d\TH:i')),
        ];

        $this->mergeState([
            'transaction' => false,
            'checkout_id' => '',
            'email' => $this->verifiedEmail,
            'selected_documents' => [],
            'quantities' => $this->populateQuantities(),
            'payment_type' => '',
            'appointment_date' => null,
        ]);
    }

    public function updatedState($name, $value)
    {
        if (strpos($value, 'selected_documents')) {
            $this->expireCheckout();
        }
    }

    public function populateQuantities()
    {
        $quantities = [];

        foreach($this->documents as $document) {
            $quantities[$document->id] = 1;
        }

        return $quantities;
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

    public function createOnlineCheckout()
    {
        if(!empty($this->state['selected_documents']) && !isset($this->transaction)){
            $selected_documents_ids = $this->state['selected_documents'];
            $this->selected_docs = $selected_documents = $this->documents->filter(function($document) use ($selected_documents_ids) {
                return in_array($document->id, $selected_documents_ids);
            });
            $selected_documents_array = [];
    
            foreach ($selected_documents as $doc) {
                $selected_documents_array[] = [
                    'name' => $doc->name,
                    'price' => $doc->price,
                    'quantity' => $this->state['quantities'][$doc->id]
                ];
            }
    
            $line_items = [];
    
            foreach ($selected_documents_array as $item){
                $line_items[] = [
                    'amount' => $item['price'] * 100 ,
                    'currency' => 'PHP',
                    'description' => 'Document',
                    'images' => [
                        'https://images.unsplash.com/photo-1613243555988-441166d4d6fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
                    ],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                ];
            };
            
            $checkout = Paymongo::checkout()->create([
                'cancel_url' => route('checkout.failed'),
                'billing' => [
                    'name' => 'Juan Doe',
                    'email' => 'juan@doe.com',
                    'phone' => '+639123456789',
                ],
                'description' => 'My checkout session description',
                'line_items' => $line_items,
                'payment_method_types' => [
                    'gcash',
                    'grab_pay', 
                    'paymaya'
                ],
                'success_url' => route('checkout.successful'),
                'statement_descriptor' => 'Laravel Paymongo Library',
                'reference_number' => uniqid() . mt_rand(100, 999),
                'metadata' => [
                    'Key' => 'Value'
                ]
            ]);
    
            $this->checkout = $checkout->getData();
            $this->state['checkout_id'] = $this->checkout['id'];
            $this->calculatePrice($selected_documents);
        }

        $this->goToNextStep();
    }

    public function calculatePrice($selected_documents)
    {
        $total_price = 0;

        foreach ($selected_documents as $doc) {
            $total_price += $doc->price * $this->state['quantities'][$doc->id];
        }

        $this->mergeState([
            'price' => $total_price,
        ]);
    }

    public function verifyPayment()
    {
        if($this->state['payment_type'] == 'Online' && !isset($this->transaction) && isset($this->checkout)){
            $checkout = Paymongo::checkout()->find($this->checkout['id']);
            if(isset($checkout->getData()['paid_at'])){
                $this->transaction = Transaction::create([
                    'checkout_id' => $checkout->getData()['id'],
                ]);
                $this->state['transaction'] = true;
                session()->flash('transaction_complete', 'Transaction Complete');
            }
        }
    }

    public function expireCheckout()
    {
        if(isset($this->checkout['id'])){
            $checkout = Paymongo::checkout()->find($this->checkout['id']);
            if(!isset($checkout->getData()['paid_at'])){
                $checkout->expire();
                $this->checkout = null;
            }
        }
    }

    public function getRequestCountOn($day)
    {
        return Request::numberOfRequestsOn($day);
    }
}