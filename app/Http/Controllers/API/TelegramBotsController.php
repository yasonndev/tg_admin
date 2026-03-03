<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Manager\TelegramBotManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @info {!} нужно middleware которое будет узнавать бота
 * 1. Ключ бота - секретній пароль на аутентификацию
 * 2. Тип бота - так мы сможем разграничить спектр допустимых операций(экшенов) этого бота
 * 3. Версию митинга - тут пока достаточно туманно, желания это поддерживать ровно ноль
 */
class TelegramBotsController extends Controller
{
    public function __construct(
        protected TelegramBotManager $botManager
    ) {}

    /**
     * POST /telegram/register
     */
    public function registerUserInBot(Request $request): JsonResponse
    {
        // Передаем все данные из JSON тела (id, first_name, etc.)
        $user = $this->botManager->handleUserRegistration($request->all());

        return response()->json([
            'status' => 'registered',
            'data' => $user
        ], 201);
    }

    /**
     * POST /telegram/auth
     */
    public function canUserAuthenticate(Request $request): JsonResponse
    {
        // Извлекаем бота, которого Middleware нашел по API-KEY
        $bot = $request->attributes->get('current_bot');

        // Проверяем доступ пользователя (id берем из тела запроса)
        $canAuth = $this->botManager->validateUserAuth($request->input('id'), $bot);

        return response()->json([
            'allowed' => $canAuth,
            'bot_identity' => $bot->username
        ]);
    }

    /**
     * POST /telegram/user/{userId}
     */
    public function getUserInBot(int $userId): JsonResponse
    {
        // $userId автоматически пробрасывается из {userId} в роуте
        $user = $this->botManager->getUserData($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * POST /telegram/user/action
     */
    public function userMadeAction(Request $request): JsonResponse
    {
        // Логика записи действия (через менеджер)
        $this->botManager->logAction(
            $request->input('id'),
            $request->input('action_type', 'default')
        );

        return response()->json(['status' => 'action_recorded']);
    }
}
