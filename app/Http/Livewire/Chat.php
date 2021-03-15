<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $users;

    protected $listeners = [
        'echo:new-user,NewUser' => 'newUser'
    ];

    public function mount()
    {
        $this->users = User::query()->whereKeyNot(auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.chat');
    }

    public function markRead($component,$event)
    {
        $this->emitTo($component,$event);
    }

    public function newUser($user)
    {
        $user = User::find($user['user']);
        if ($user) $this->users->push($user);
    }
}
