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

    static protected array $Types = [
        'Income',
        'Expense',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    static function getTypes(): array
    {
        return self::$Types;
    }
}
