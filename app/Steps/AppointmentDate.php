<?php

namespace App\Steps;

use App\Models\Request;
use App\Models\Credential;
use App\Models\VerifiedEmail;
use Vildanbina\LivewireWizard\Components\Step;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MimeType;

class AppointmentDate extends Step
{
    protected string $view = 'requester.request-steps.appointment-date';

    public function icon(): string
    {
        return 'check';
    }

    public function save($state)
    {
        $request = Request::create([
            'user_id' => isset($state['user_id']) ? $state['user_id'] : null,
            'verified_email_id' => isset($state['email']) ? VerifiedEmail::where('email', $state['email'])->first()->id : null,
            'price' => $state['price'],
            'payment_type' => $state['payment_type'],
            'appointment_date' => Carbon::parse($state['appointment_date'])->format('Y-m-d\TH:i'),
        ]);

        $syncData = [];
        foreach ($this->getLivewire()->selected_docs as $doc) {
            $syncData[] = [
                'document_id' => $doc->id,
                'quantity' => $state['quantities'][$doc->id],
                'price' => $doc->price
            ];
        }

        $request->documents()->sync($syncData);

        if (isset($this->getLivewire()->transaction)) {
            $this->getLivewire()->transaction->update(['request_id' => $request->id]);
        }

        // Saving Credential Images to Google Drive
        if (isset($state['email'])) {
            foreach ($state['credentials'] as $index => $cred_image) {
                $name = $cred_image->getClientOriginalName();
                $path = $cred_image->getRealPath();
            
                // Ensure the file name is properly encoded
                $name = utf8_encode($name);
            
                // Create a Guzzle client
                $client = new Client();
            
                // Prepare the multipart form data
                $multipart = [
                    [
                        'name'     => 'metadata',
                        'contents' => json_encode([
                            'name' => $name,
                            'parents' => [config('services.google.folder_id')]
                        ]),
                        'headers'  => [
                            'Content-Type' => 'application/json; charset=UTF-8',
                        ],
                    ],
                    [
                        'name'     => 'file',
                        'contents' => fopen($path, 'r'),
                        'filename' => $name,
                        'headers'  => [
                            'Content-Type' => MimeType::fromFilename($name) ?: 'application/octet-stream',
                        ],
                    ],
                ];
            
                // Send the request
                $response = $client->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->getLivewire()->token,
                    ],
                    'multipart' => $multipart,
                ]);
            
                if ($response->getStatusCode() === 200) {
                    $responseBody = json_decode($response->getBody(), true);
                    $upload = new Credential();
                    $upload->requester_name = $state['requester_name'];
                    $upload->school_id = $state['school_id'];
                    $upload->file_name = $name;
                    $upload->file_id = $responseBody['id'];
                    $upload->verified_email_id = VerifiedEmail::where('email', $state['email'])->first()->id;
                    $upload->save();
                }
            }
        }

        return $this->getLivewire()->reDir !== '/' ? redirect()->route($this->getLivewire()->reDir) : redirect('/');
    }

    public function validate()
    {
        Validator::extend('within_working_hours', function ($attribute, $value, $parameters, $validator) {
            $carbonDate = Carbon::parse($value);
            $hour = (int)$carbonDate->format('H');
            return ($hour >= Carbon::parse($this->getLivewire()->schedule->min_time)->format('H') && $hour < Carbon::parse($this->getLivewire()->schedule->max_time)->format('H'));
        });
        return [
            [
                'state.appointment_date' => ['required','date','within_working_hours'],
            ],
            [
                'state.appointment_date' => __('Pickup'),
            ],
        ];
    }

    public function title(): string
    {
        return __('Pickup');
    }
}