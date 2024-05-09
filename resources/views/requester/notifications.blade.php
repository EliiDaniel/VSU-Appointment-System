<x-app-layout>
    <livewire:requester.notifications :search="$referenceNo ? $referenceNo : ($title ? $title : '')"/>
</x-app-layout>