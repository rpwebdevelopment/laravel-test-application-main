<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $note_id
 * @property int $category_id
 */
class NoteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'category_id',
    ];
}
