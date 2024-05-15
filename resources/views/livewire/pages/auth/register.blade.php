<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;
use App\Models\Credential;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MimeType;

new
#[Layout('layouts.guest')]
#[Title('Register')]
class extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $school_id;
    public $password;
    public $password_confirmation;
    public $credentials = [];

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'school_id' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'credentials' => ['required', 'array'],
            'credentials.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
        ], [
            'credentials.*.image' => 'Each credential must be an image file.',
            'credentials.*.mimes' => 'Each credential must be a valid image format (jpeg, png, jpg, gif, svg).',
            'credentials.*.max' => 'Each credential may not be greater than :max kilobytes.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        foreach ($this->credentials as $index => $cred_image) {
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
                    'Authorization' => 'Bearer ' . app('googleAccessToken'),
                ],
                'multipart' => $multipart,
            ]);
        
            if ($response->getStatusCode() === 200) {
                $responseBody = json_decode($response->getBody(), true);
                $upload = new Credential();
                $upload->requester_name = $this->name;
                $upload->school_id = $this->school_id;
                $upload->file_name = $name;
                $upload->file_id = $responseBody['id'];
                $upload->user_id = $user->id;
                $upload->save();
            }
        }

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
};

?>

<div>
    <form wire:submit="register">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- School ID -->
            <div class="mt-4">
                <x-input-label for="school_id" :value="__('School ID')" />
                <x-text-input wire:model="school_id" id="school_id" class="block mt-1 w-full" type="text" name="school_id" required autocomplete="school_id" />
                <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
                
            <div class="register-cred mt-4" wire:ignore x-init="
                FilePond.setOptions({
                    server: {
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            @this.upload('credentials', file, load, error, progress)
                        },
                        revert: (filename, load) => {
                            @this.removeUpload('credentials', filename, load)
                        },
                    },
                    onreorderfiles(files, origin, target){
                        @this.set('credentials', []);
                        files.forEach(function(file) {
                            @this.upload('state.credentials', file.file);
                        });
                    },
                    allowMultiple: true,
                    allowReorder: true,
                    maxFiles: 3,
                });
                
                FilePond.create($refs.input);
                ">
                <x-input-label for="name" :value="__('Upload Image for Verification')" />
                <input type="file" wire:model="credentials" name="credentials" x-ref="input" required>
            </div>
            @foreach($errors->get('credentials*') as $error)
                <x-input-error :messages="$error" class="mt-2" />
            @endforeach
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
