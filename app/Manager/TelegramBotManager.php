<?php

namespace App\Manager;

use App\Models\TgUser;
use App\Repositories\TgUserRepository;
use App\Services\BotAuthService;

class TelegramBotManager
{
    public function __construct(
        protected TgUserRepository $userRepo,
        protected BotAuthService $authService
    ) {}

    public function handleUserRegistration(array $userData): TgUser
    {
        return $this->userRepo->updateOrCreate($userData);
    }

    public function validateUserAuth(int $userId, $bot): bool
    {
        $user = $this->userRepo->findById($userId);
        if (!$user) return false;

        return $this->authService->checkAccess($user, $bot);
    }
}
