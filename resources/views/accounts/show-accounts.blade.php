<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Created accounts') }}
        </h2>
    </header>
    <table>
        <th class="pt-4">{{"Name"}}</th>
        <th class="pt-4">{{"Currency"}}</th>
        <th class="pt-4">{{"Balance"}}</th>
            @foreach($accounts as $account)
                <tr>
                    <td class="p-6">{{$account->name}}</td>
                    <td class="p-6">{{$account->currency->name}}</td>
                    <td class="p-6">{{$account->balance}}</td>
                    <td>
                        <form  action="{{route('accounts.edit', ['account'=>$account->id])}}" class="p-6">
                            @csrf
                            <x-change-button class="ml-3">
                                {{ __('Change') }}
                            </x-change-button>
                        </form>
                    </td>
                    <td> <form method="post" action="{{route('accounts.destroy', ['account'=>$account->id])}}" class="p-6">
                        @csrf
                        @method('delete')
                            @if($account->transactions->count() == 0)
                                <x-danger-button class="ml-3">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            @endif
                    </form>
                    </td>
                </tr>
            @endforeach
    </table>
</section>
