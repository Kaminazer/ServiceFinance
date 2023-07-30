<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountsRequest;
use App\Http\Requests\TransactionsCreatedRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Services\TransferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('accounts.accounts',[
            'accounts' => $request->user()->Accounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("accounts.create-accounts",[
            'currencies' => Currency::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountsRequest $request, TransferService $service): RedirectResponse
    {
      $account = Account::create([
            'name' => $request->name,
            'currency' => $request->currency,
            'user_id' => $request->user()->id,
        ]);
      if ($request->balance > 0){
          $transaction = Transaction::create([
              'date' => now(),
              'type' => 'Income',
              'account_id' => $account->id,
              'sum' => $request->balance,
              'description' => 'Initial balance',
          ]);
          $service->transfer($transaction);
      }
        return Redirect::route('accounts.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('accounts.edit-accounts',
            [
                'account'=>$id,
                'currencies' => Currency::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountsRequest $request, string $id): RedirectResponse
    {
        $account = Account::findOrFail($id);
        $account->fill($request->validated());

        $account->save();

        return Redirect::route('accounts.index')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $account = Account::findOrFail($id);
        $noTransaction = false;
        if ($noTransaction){
            $account->delete();
        }
        return Redirect::route('accounts.index');
    }
}
