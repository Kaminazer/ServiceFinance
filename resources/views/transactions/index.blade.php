<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{route('transactions.create')}}" class="p-6">
                        <div class=" flex items-center gap-4">
                            <x-primary-button>{{ __('Create new transaction') }}</x-primary-button>
                        </div>
                    </form>
                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
                        <div class="max-w-xl">
                            <h2 class="text-lg font-bold text-gray-900">
                                {{__("Total balance") }}
                            </h2>
                            <p class="pl-2 pt-1">{{$totalBalance}}</p>
                        </div>
                    </div>

                    @include('transactions.show')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
