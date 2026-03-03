<?php

namespace App\Services;

use App\Models\Mybot;
use App\Models\TgUser;

class BotAuthService
{
    public function checkAccess(TgUser $user): bool
    {
        return $user->is_bot === false;
    }
}
