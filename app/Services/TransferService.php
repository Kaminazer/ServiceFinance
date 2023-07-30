<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;

class TransferService
{
    public function transfer(Transaction $transaction)
    {
        if ($transaction->type == 'Income'){
            $transaction->account->balance += $transaction->sum;
        }elseif ($transaction->type == 'Expense' && $transaction->account->balance > $transaction->sum) {
            $transaction->account->balance -= $transaction->sum;
        }
        $transaction->account->save();
    }
}
