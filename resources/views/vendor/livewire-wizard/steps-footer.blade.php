<div class="p-2 flex flex-row-reverse justify-between">
    @if($this->hasNextStep())
        <x-button primary right-icon="chevron-right" wire:click="goToNextStep" spinner="goToNextStep" :label="__('Next')"/>
        @if($this->getCurrentStep()->title() === 'Email' )
            <div class="flex items-center gap-2">
                <x-secondary-button wire:click="verify">
                    {{ __('verify email') }}
                </x-secondary-button> 
                @if(session()->has('email_sent'))
                    <div class="text-green-600">
                        {{ session('email_sent') }}
                    </div>
                @endif
            </div>
        @endif
    @else
        <x-button primary type="submit" spinner="submit" :label="__('Submit')"/>
    @endif
    @if($this->hasPrevStep())
        <x-button dark :label="__('Back')" icon="chevron-left" wire:click="goToPrevStep" spinner="goToPrevStep"/>
    @endif
</div>
