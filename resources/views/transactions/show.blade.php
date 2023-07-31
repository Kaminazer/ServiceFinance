<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Created transactions') }}
        </h2>
    </header>
    <table>
        <th class="pt-4">{{"Date"}}</th>
        <th class="pt-4">{{"Type"}}</th>
        <th class="pt-4">{{"Account"}}</th>
        <th class="pt-4">{{"Sum"}}</th>
        <th class="pt-4">{{"Description"}}</th>
        @foreach($transactions as $transaction)
            <tr>
                <td class="p-6">{{$transaction->date}}</td>
                <td class="p-6">{{$transaction->type}}</td>
                <td class="p-6">{{$transaction->account->name}}</td>
                <td class="p-6">{{$transaction->sum }}</td>
                <td class="p-6">{{$transaction->description}}</td>
                <td>
                    <form  action="{{route('transactions.edit', ['transaction'=>$transaction->id])}}" class="p-6">
                        @csrf
                        <x-change-button class="ml-3">
                            {{ __('Change') }}
                        </x-change-button>
                    </form>
                </td>
                <td> <form method="post" action="{{route('transactions.destroy', ['transaction'=>$transaction->id])}}" class="p-6">
                        @csrf
                        @method('delete')
                        <x-danger-button class="ml-3" >
                            {{ __('Delete') }}
                        </x-danger-button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $transactions->links() }}
</section>
