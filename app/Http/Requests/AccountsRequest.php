<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AccountsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'currency' => ['string', 'max:255'],
        ];
    }
}
