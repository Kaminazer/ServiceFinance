<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionPaginateService
{
    public  function paginate(Request $request, ApiService $service): LengthAwarePaginator
    {
        $transactions = $service->convertCurrency($request);
        $perPage = 5;
        $currentPage = $request->query('page', 1);
        $currentTransactions = $transactions->slice(($currentPage - 1) * $perPage, $perPage);

        return new LengthAwarePaginator(
            $currentTransactions,
            $transactions->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }
}
