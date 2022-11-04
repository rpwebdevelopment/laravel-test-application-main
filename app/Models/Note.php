<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property Collection $categories
 * @property Collection $noteCategories
 */
class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return HasManyThrough
     */
    public function categories()
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

    public function noteCategories()
    {
        return $this->hasMany(NoteCategory::class);
    }
}
