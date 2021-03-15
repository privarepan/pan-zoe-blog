<?php

namespace App\Http\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\User;
use App\Traits\ChatTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ChatPanel extends Component
{
    use ChatTrait;

    public $user;

    public $message = '';

    public $typing = false;

    /**
     * @var $messages Collection
     */
    public $message_list;

    public $channel;

    protected $rules = [
        'message' => 'required|min:1',
    ];

    public function getListeners()
    {
        return [
            "echo-private:chat.$this->channel,Message" => 'message',
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->channel = $this->getChannel();
    }


    public function submit()
    {
        $this->validate();
        $message = Message::create([
            'from' => auth()->id(),
            'message' => $this->message,
            'to' => $this->user->id,
            'channel' => $this->channel
        ])->load('fromUser','toUser');

        $this->broadcast($message)->toOthers();
        $this->reset('message','typing');
        $this->put($message);
        $this->emitTo('active-user','refresh-'.$message->channel);
    }


    public function render()
    {
        $this->latestMessage();
        return view('livewire.chat-panel');
    }

    public function message($data)
    {
        $message = Message::findOrFail($data['message']['id']);
        $this->emit('refresh-' . $message->channel);
        $this->dispatchBrowserEvent('scroll-'.$this->channel);
    }
}
