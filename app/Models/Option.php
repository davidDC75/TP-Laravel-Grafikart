<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOption
 */
class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
