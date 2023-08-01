<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionsCreatedRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\ApiService;
use App\Services\TotalBalanceService;
use App\Services\TransactionPaginateService;
use App\Services\TransferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
  */
    public function index(Request $request, TransactionPaginateService $service, TotalBalanceService $balance, ApiService $api): View
    {
        return view("transactions.index", [
            'transactions'=> $service->paginate($request, $api),
            'totalBalance'=>$balance->calculate($request, $api),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view("transactions.create",[
            'types' => Transaction::getTypes(),
            'accounts' => $request->user()->accounts,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionsCreatedRequest $request, TransferService $service): RedirectResponse
    {
        $account = Account::find($request->account);
        if (!($request->type == 'Expense' && $account->balance < $request->sum)) {
            $transaction = Transaction::create([
                'date' => $request->date,
                'type' => $request->type,
                'account_id' => $request->account,
                'sum' => $request->sum,
                'description' => $request->description,
            ]);

            $service->initialTransfer($transaction);
            return redirect('/transactions');
        }
        return redirect()->back()->with('error', 'Insufficient funds in the account');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        return view("transactions.edit",[
            'transaction'=>$id,
            'types' => Transaction::getTypes(),
            'accounts' => $request->user()->accounts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionsCreatedRequest $request, string $id, TransferService $service)
    {
        $transaction = Transaction::findOrFail($id);
        if ($request->sum > $transaction->account->balance && $request->type == "Expense"){
            return redirect()->back()->with('error', 'Insufficient funds in the account');
        } else {
            $transaction->fill($request->validated());
            $oldTransaction = Transaction::findOrFail($id);
            $transaction->save();
            $service->updateTransfer($transaction, $oldTransaction);
            return Redirect::route('transactions.index')->with('status', 'transaction-updated');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return Redirect::route('transactions.index');
    }
}
