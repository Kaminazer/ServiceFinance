<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountsRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("accounts.accounts",[
            'currencies' => Currency::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountsRequest $request): RedirectResponse
    {
       $account = Account::create([
            'name' => $request->name,
            'currency' => $request->currency,
            'user_id' => $request->user()->id,
        ]);
        return Redirect::route('accounts.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
