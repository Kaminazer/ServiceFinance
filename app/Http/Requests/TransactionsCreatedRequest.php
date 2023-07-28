<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsCreatedRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d')],
            'type' => ['required'],
            'account' => ['required'],
            'sum' => ['required', 'numeric'],
            'description' => ['string', 'nullable'],
        ];
    }
}
