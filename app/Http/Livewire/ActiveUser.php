<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use App\Traits\ChatTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ActiveUser extends Component
{
    use ChatTrait;

    public $user;

    public $channel;

    protected function getListeners()
    {
        $channel = $this->getChannel();
        return [
            'refresh-' . $channel => '$refresh',
            'mark-read-'.$channel => 'markRead',
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->channel = $this->getChannel();
    }

    public function render()
    {
        $this->latestMessage();
        return view('livewire.active-user');
    }


    public function markRead()
    {
        $messages = Message::query()->whereChannel($this->channel)->whereTo(auth()->id())->get();
        if ($messages->isNotEmpty()) {
            Message::query()->whereChannel($this->channel)->whereTo(auth()->id())->update(['read_at' => now()]);
            $this->refresh();
        }
    }


}
