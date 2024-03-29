<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if (session('error'))
                        <div class="alert alert-danger text-sm text-red-600 space-y-1">
                            {{ session('error') }}
                        </div>
                    @endif
                    @include('transactions.partials.form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
