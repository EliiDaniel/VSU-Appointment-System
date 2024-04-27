<?php

namespace App\Livewire\Requester\Wizards;

use Vildanbina\LivewireWizard\WizardComponent;
use App\Steps\SelectDocuments;
use App\Steps\Payment;
use App\Steps\AppointmentDate;
use App\Models\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Luigel\Paymongo\Facades\Paymongo;

class RequestForm extends WizardComponent
{
    public $dateConfigs;
    public $documents;
    public $reDir;
    public $checkout;
    public $selected_docs;
    public ?Transaction $transaction;

    public array $steps = [
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
            'checkout_id' => '',
            'user_id' => auth()->user()->id,
            'selected_documents' => [],
            'quantities' => $this->populateQuantities(),
            'payment_type' => '',
            'appointment_date' => $this->dateConfigs['minDate'],
        ]);
    }

    public function populateQuantities()
    {
        $quantities = [];

        foreach($this->documents as $document) {
            $quantities[$document->id] = 1;
        }

        return $quantities;
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

    public function calculatePrice($selected_documents )
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
        if($this->state['payment_type'] == 'Online'){
            $checkout = Paymongo::checkout()->find($this->checkout['id']);
            if(isset($checkout->getData()['paid_at'])){
                $this->transaction = Transaction::create([
                    'checkout_id' => $checkout->getData()['id'],
                ]);
                session()->flash('transaction_complete', 'Transaction Complete');
            }
        }
        
        $this->goToNextStep();
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
}