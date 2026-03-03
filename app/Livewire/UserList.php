<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    // Свойства для фильтрации
    public $search = '';
    public $activeOnly = false;

    // Сбрасываем пагинацию при каждом изменении поиска или фильтра
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingActiveOnly()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Формируем запрос
        $query = User::query();

        // Фильтр по поиску
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Пример дополнительного фильтра (если в базе есть поле is_active)
        if ($this->activeOnly) {
            $query->where('is_active', true);
        }

        return view('livewire.user-list', [
            'users' => $query->latest()->paginate(50)
        ]);
    }
}
