<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $search;

    public function render()
    {
        $users = User::query()
            ->where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->orWhere('mobile', 'LIKE', "%{$this->search}%")
            ->paginate(15);

        return view('livewire.admin.users', compact('users'));
    }
}
