<?php

namespace App\Services;

use App\Models\Account;

class TotalBalanceService
{
    public function calculate(){
        $totalBalance = 0;
        foreach (Account::all() as $account){
            $totalBalance += $account->balance;
        }
        return $totalBalance;
    }
}
