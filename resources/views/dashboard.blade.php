<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("User Information") }}
                    <p class="mt-1 text-sm text-gray-600">
                        {{$user->name}}
                        <br>
                        {{$user->email}}
                        <br>
                        {{$user->default_currency}}
                    </p>
                    <div class="p-6 text-gray-900">
                        <p>{{ __("Accounts user`s") }}</p>
                        <ul>
                            @foreach($accounts as $account)
                                <li>{{$account -> name}} <a href="{{route('accounts.edit', ['account'=>$account->id])}}">{{__("Change")}}</a> </li>
                            @endforeach
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
