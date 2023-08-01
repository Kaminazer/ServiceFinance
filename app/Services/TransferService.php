<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public function initialTransfer(Transaction $transaction): void
    {
        DB::beginTransaction();
        if ($transaction->type == 'Income') {
            $transaction->account->balance += $transaction->sum;
        } elseif ($transaction->type == 'Expense' && $transaction->account->balance > $transaction->sum) {
            $transaction->account->balance -= $transaction->sum;
        }
        $transaction->account->save();
        DB::commit();
    }

    public function updateTransfer(Transaction $newTransaction, Transaction $oldTransaction): void
    {
        DB::beginTransaction();
        if ($oldTransaction->type == 'Income') {
            if ($newTransaction->type == 'Income') {
                $newTransaction->account->balance -= $oldTransaction->sum;
                $newTransaction->account->balance += $newTransaction->sum;
            } else {
                $newTransaction->account->balance -= $oldTransaction->sum;
                $newTransaction->account->balance -= $newTransaction->sum;
            }
        } else {
            if ($newTransaction->type == 'Income') {
                $newTransaction->account->balance += $oldTransaction->sum;
                $newTransaction->account->balance += $newTransaction->sum;
            } else {
                $newTransaction->account->balance += $oldTransaction->sum;
                $newTransaction->account->balance -= $newTransaction->sum;
            }
        }
        $newTransaction->account->save();
        DB::commit();
    }
}
