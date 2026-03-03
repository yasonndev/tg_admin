<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MybotSecure extends Model
{
    protected $table = 'mybots_secures';

    protected $fillable = [
        'bot_id',
        'bot_token',
        'api_key'
    ];

//    protected $casts = [
//        'bot_token' => 'encrypted',
//        'api_key'   => 'encrypted',
//    ];

    public function bot(): BelongsTo
    {
        return $this->belongsTo(Mybot::class, 'bot_id', 'id');
    }
}
