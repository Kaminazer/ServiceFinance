<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionsCreatedRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("transactions.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Transaction $transaction, Request $request)
    {
        return view("transactions.create",[
            'types' => $transaction->getTypes(),
            'accounts' => $request->user()->accounts,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionsCreatedRequest $request)
    {
        Transaction::create([
            'date'=> $request->date,
            'type'=> $request->type,
            'account_id'=> $request->account,
            'sum'=> $request->sum,
            'description'=>$request->description,
        ]);
        return redirect('/transactions');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
