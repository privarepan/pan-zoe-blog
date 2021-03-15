<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PostCommentReply as Reply;

class PostCommentReply extends Component
{
    public $reply;

    protected function getListeners()
    {
        return [
            '$refresh',
            "destroy:{$this->reply->id}" => 'destroy',
        ];
    }

    public function mount(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function render()
    {
        return view('livewire.post-comment-reply');
    }

    public function destroy()
    {
        $this->reply->delete();
        $this->emitTo('post-show','postCommentDestroy');
        $this->emitTo('post-comment','$refresh');
        $this->skipRender();
    }

    public function update()
    {

    }
}
