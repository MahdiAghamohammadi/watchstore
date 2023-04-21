<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $users = User::paginate(15);

        return view('livewire.admin.users', compact('users'));
    }
}
