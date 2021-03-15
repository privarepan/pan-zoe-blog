<?php


namespace App\Traits;


use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

trait ChatTrait
{
    public $prefix = 'chat:channel:';

    public $message_list;

    public function getChannel()
    {
        $arr = [$this->user->id, auth()->id()];
        sort($arr);
        $key = implode('-', $arr);
        return md5($key);
    }

    public function getKey()
    {
        return $this->prefix . $this->getChannel();
    }

    public function latestMessage()
    {
        $this->message_list = cache()->get($this->getKey(), Collection::make());
    }

    public function broadcast(Message $message)
    {
        return broadcast(new \App\Events\Message($message));
    }


    public function put(Message $message)
    {
        $this->message_list->push($message);
        cache()->put($this->getKey(), $this->message_list);
        $this->dispatchBrowserEvent('scroll-'.$this->channel);
        return $this;
    }

    public function refresh()
    {
        $messages = Message::query()->whereChannel($this->getChannel())->get();
        cache()->put($this->getKey(), $messages);
    }
}
