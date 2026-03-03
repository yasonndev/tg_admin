<?php

namespace App\Repositories;

use App\Models\TgUser;

class TgUserRepository
{
    public function findById(int $id): ?TgUser
    {
        return TgUser::find($id);
    }

    public function updateOrCreate(array $data): TgUser
    {
        return TgUser::updateOrCreate(
            ['id' => $data['id']],
            $data
        );
    }
}
