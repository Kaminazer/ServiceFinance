<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('List accounts') }}
        </h2>
    </header>
    <div>
        <ol>
            @foreach($accounts as $account)
            <li>
                <div>
                    <p>{{$account -> name}}</p>
                    <a href="{{route('accounts.edit', ['account'=>$account->id])}}">{{__("Change")}}</a>

                    <form method="post" action="{{route('accounts.destroy', ['account'=>$account->id])}}" class="p-6">
                        @csrf
                        @method('delete')
                        <x-danger-button class="ml-3">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </form>
{{--                    <a href="{{route('accounts.destroy', ['account'=>$account->id])}}">{{__("Delete")}}</a>--}}
                </div>
            </li>
            @endforeach
        </ol>
    </div>
</section>
