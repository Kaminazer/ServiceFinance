<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-bold text-gray-900">
                        {{__("User Data") }}
                    </h2>
                        <p class="pl-2 pt-1"> Username : {{$user->name}}</p>
                        <p class="pl-2 pt-1"> Email : {{$user->email}}</p>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-bold text-gray-900">
                        {{__("Default Currency") }}
                    </h2>
                    <p class="pl-2 pt-1"> {{$user->default_currency}}</p>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-bold text-gray-900">
                        {{__("Account user`s") }}
                    </h2>
                    <ul class="list-disc pl-5">
                        @foreach($accounts as $account)
                            <li class="p-2"> {{$account -> name}} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-bold text-gray-900">
                        {{__("Total balance") }}
                    </h2>
                    <p class="pl-2 pt-1">{{$totalBalance}}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
