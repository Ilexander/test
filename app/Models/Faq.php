<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property string $question
 * @property string $answer
 */
class Faq extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'faq';

    public const DEFAULT_LANGUAGE = 'English';

    protected $fillable = [
        "question",
        "answer",
    ];

    public function translation(): Relation
    {
        return $this->hasMany(Translation::class, 'item_id', 'id')
            ->where('item_type', Faq::class);
    }
}
