<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

/**
 * @info {!} нужно middleware которое будет узнавать бота
 * 1. Ключ бота - секретній пароль на аутентификацию
 * 2. Тип бота - так мы сможем разграничить спектр допустимых операций(экшенов) этого бота
 * 3. Версию митинга - тут пока достаточно туманно, желания это поддерживать ровно ноль
 */
class TelegramBotsController extends Controller
{
    public function registerUserInBot()
    {
        dump(__FUNCTION__);
    }

    public function canUserAuthenticate()
    {
        dump(__FUNCTION__);
    }

    public function userMadeAction()
    {
        dump(__FUNCTION__);
    }

    public function getUserByBot()
    {
        dump(__FUNCTION__);
    }
}
