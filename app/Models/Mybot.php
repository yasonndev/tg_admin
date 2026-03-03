<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mybot extends Model
{
    protected $table = 'mybots';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'first_name', 'last_name', 'username', 'language_code',
        'is_bot', 'can_join_groups', 'can_read_all_group_messages',
        'supports_inline_queries', 'has_main_web_app'
    ];

    protected $casts = [
        'is_bot' => 'boolean',
        'can_join_groups' => 'boolean',
        'can_read_all_group_messages' => 'boolean',
        'supports_inline_queries' => 'boolean',
    ];

    public function secureData(): HasOne
    {
        return $this->hasOne(MybotSecure::class, 'bot_id', 'id');
    }
}
