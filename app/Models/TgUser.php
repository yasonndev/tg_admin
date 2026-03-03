<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TgUser extends Model
{
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id', 'first_name', 'last_name', 'username',
        'language_code', 'is_bot', 'is_premium'
    ];

    protected $casts = [
        'is_bot' => 'boolean',
        'is_premium' => 'boolean',
    ];
}
