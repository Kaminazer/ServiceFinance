<section>
    <form method="POST" action="{{ route('transactions.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="date" :value="__('Date')" />
            <div class="relative">
                <input name="date" type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pr-10">
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                     </svg>
                </span>
            </div>

        </div>
        <div>
            <x-input-label for="type" :value="__('Type')" />
            <select name="type" id="type" class="form-select rounded">
                @foreach ($types as $type)
                    <option value="{{ $type}}">{{ $type}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="account" :value="__('Account')" />
            <select name="account" id="account" class="form-select rounded">
                @foreach ($accounts as $account)
                    <option value="{{ $account->id}}">{{ $account->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="sum" :value="__('Sum')" />
            <x-text-input id="sum" name="sum" type="number" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->transactionSum->get('sum')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            {{--                            <x-text-input id="description" name="description" type="text-area" class="mt-1 block w-full"/>--}}
            <textarea name="description" rows="2" cols="50" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>

            <x-input-error :messages="$errors->transactionDescription->get('description')" class="mt-2" />
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

</section>
