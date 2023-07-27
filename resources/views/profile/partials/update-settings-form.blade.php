<section>
<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Settings') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("Set or update default currency") }}
    </p>
</header>

<form method="post" action="{{ route('settings.setSettings') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="default_currency" :value="__('Default currency')" />
        <select name="default_currency">
            @foreach ($currencies as $currency)
                <option value="{{ $currency->name }}">{{ $currency->name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('default_currency')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === '$currency-updated')
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
