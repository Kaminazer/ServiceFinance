<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'type',
        'account_id',
        'sum',
        'description'
    ];

    protected array $Types = [
        'Income',
        'Expense',
    ];

    public function accounts(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function getTypes(): array
    {
        return $this->Types;
    }
}
