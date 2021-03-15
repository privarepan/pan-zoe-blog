<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\PostComment as Comment;

class PostComment extends Component
{

    /**
     * @var $comment Comment
     */
    public $comment;

    public $modal = false;

    public $content = '';

    protected $rules = [
        'content' => 'required'
    ];

    protected function getListeners()
    {
        return [
            'create' => 'create',
            '$refresh',
            "destroy:{$this->comment->id}" => 'destroy',
            "replyToComment:{$this->comment->id}" => 'replyToComment'
        ];
    }

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        $this->comment->load('reply.user')->loadCount('reply');
        return view('livewire.post-comment');
    }

    public function replyToComment($user_id)
    {
        $user = User::findOrFail($user_id);
        $this->content = '@'.$user->name.' ';
        $this->skipRender();
    }



    public function reply()
    {
        if (!auth()->check()) {
            return  redirect()->guest(route('login'));
        }
        $this->validate();
        $this->comment->reply()->create([
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);
        $this->reset('content');
    }


    public function update()
    {

    }

    public function destroy()
    {
        $this->comment->delete();
        $this->comment = null;
        $this->emitUp('postCommentDestroy');
        $this->skipRender();
    }

    public function create()
    {
        return 1;
    }
}
