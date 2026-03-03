<?php

namespace App\Livewire;

use App\Models\TgUser;
use Livewire\Component;
use Livewire\WithPagination;

class TgUserList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = TgUser::query()
            ->when($this->search, function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                    ->orWhere('username', 'like', "%{$this->search}%")
                    ->orWhere('id', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.tg-user-list', [
            'users' => $users
        ]);
    }
}
