<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>
    </x-slot>

    <form action="{{route('accounts.create')}}">
        <div class=" flex items-center gap-4">
            <x-primary-button>{{ __('Create new accounts') }}</x-primary-button>
        </div>
    </form>

    <div class="py-12">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('accounts.partials.show-accounts')
            </div>
        </div>
    </div>
</x-app-layout>
