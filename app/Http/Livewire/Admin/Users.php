<?php

namespace App\Http\Livewire\Admin;

use App\Enums\UserStatus;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    public function changeUserStatus($id)
    {
        $user = User::query()->find($id);
        if ($user->status == UserStatus::Active->value) {
            $user->update([
                'status' => UserStatus::InActive->value,
            ]);
        } else {
            $user->update([
                'status' => UserStatus::Active->value,
            ]);
        }
    }
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
