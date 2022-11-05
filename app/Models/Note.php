<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property Collection $categories
 * @property Collection $noteCategories
 */
class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            NoteCategory::class,
            'note_id',
            'id',
            'id',
            'category_id'
        );
    }

    public function noteCategories(): HasMany
    {
        return $this->hasMany(NoteCategory::class);
    }
}
