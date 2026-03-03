<?php

namespace App\Livewire;

use App\Models\Mybot;
use Livewire\Component;
use Livewire\WithPagination;

class MybotsList extends Component
{
    use WithPagination;

    public $search = '';
    public $onlyWithTokens = false; // Фильтр: только те, у кого привязан токен

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bots = Mybot::query()
            ->with('secureData')
            ->when($this->search, function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->when($this->onlyWithTokens, function ($query) {
                // Фильтр через связь: выбираем только ботов, у которых есть запись в secureData
                $query->has('secureData');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.mybots-list', [
            'bots' => $bots
        ]);
    }
}
