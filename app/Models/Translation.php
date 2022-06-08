<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type',
        'item_id',
        'language_id',
        'title',
        'context',
    ];

    public function language(): Relation
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
}
