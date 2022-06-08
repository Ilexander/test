<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBonus extends Model
{
    use HasFactory;

    protected $table = 'transaction_bonuses';

    protected $fillable = [
        'transaction_id',
        'amount'
    ];
}
