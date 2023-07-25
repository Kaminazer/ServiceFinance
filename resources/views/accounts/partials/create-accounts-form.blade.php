<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create accounts') }}
        </h2>
    </header>

    <form method="post" action="{{ route('accounts.store') }}" class="mt-6 space-y-6">
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


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
