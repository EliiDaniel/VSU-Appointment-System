@php
    $isStepValid = $stepInstance->isValid();
    $isFailedStep = $stepInstance->validationFails;
    $stepIsGreaterOrEqualThan = $this->stepIsGreaterOrEqualThan($stepInstance->getOrder());
@endphp
<div class="w-1/3">
    <div class="relative mb-2">
        @if(!$loop->first)
            <div class="absolute" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                <div class="bg-gradient-to-r from-transparent to-gray-200 rounded flex-1">
                    <div
                        @class([
                            'rounded py-0.5',
                            'bg-green-400 animate-pulse animate-infinite animate-ease-linear' => $stepIsGreaterOrEqualThan && !$isFailedStep,
                            'bg-red-400 animate-pulse animate-infinite animate-ease-linear' => $isFailedStep,
                            'w-full' => $isFailedStep || $stepIsGreaterOrEqualThan,
                            'w-0' =>  !($isFailedStep || $stepIsGreaterOrEqualThan)
                        ])
                    ></div>
                </div>
            </div>
        @endif

        <div class="grid place-items-center">
            <x-button.circle
                @class([
                    'bg-green-400' => $stepIsGreaterOrEqualThan && !$isFailedStep,
                    'bg-red-400 animate-jump animate-once animate-ease-in-out' => $isFailedStep
                ])
                :positive="$stepIsGreaterOrEqualThan && !$isFailedStep"
                :negative="$isFailedStep"
                wire:click="setStep({{ $stepInstance->getOrder() }})"
                icon="{{ $stepInstance->icon() }}"
            />
        </div>
    </div>
    <div class="text-xs text-center md:text-base">{{ $stepInstance->title() }}</div>
</div>
