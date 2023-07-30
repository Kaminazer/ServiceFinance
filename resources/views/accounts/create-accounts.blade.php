<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('accounts.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->accountName->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="currency" :value="__('Currency')" />
                            <select name="currency" id="currency" class="form-select rounded">
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->name }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="balance" :value="__('Start Balance')" />
                            <x-text-input id="balance" name="balance" type="number" class="mt-1 block w-full"/>
                            <x-input-error :messages="$errors->accountBalance->get('balance')" class="mt-2" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            {{--            @if (session('status') === 'password-updated')
                                            <p
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-gray-600"
                                            >{{ __('Saved.') }}</p>
                                        @endif--}}
                        </div>
                    </form>
                </div>
            </div>
            {{--

                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('accounts.partials.edit-accounts-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('accounts.partials.delete-accounts-form')
                            </div>
                        </div>
            --}}
        </div>
    </div>
</x-app-layout>
