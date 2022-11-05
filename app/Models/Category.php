<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $user_id
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];
}
