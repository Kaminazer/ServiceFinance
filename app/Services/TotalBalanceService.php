<?php

namespace App\Services;

use Illuminate\Http\Request;

class TotalBalanceService
{
    public function calculate(Request $request, ApiService $service): string
    {
        $totalBalance = 0;

        $transactions = $service->convertCurrency($request);
        foreach ($transactions as $transaction){
            if ($transaction->type == "Expense"){
                $sum = floatval(str_replace(',', '', $transaction->sum));;
                $totalBalance -= $sum;
            } else {
                $sum = floatval(str_replace(',', '', $transaction->sum));;
                $totalBalance += $sum;
            }
            $currentBalance = $totalBalance;
        }
        return number_format($totalBalance, 2);
    }
}
