<?php

namespace App\Http\Livewire;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Post;
use App\Models\PostComment;

class PostShow extends Component
{
    /**
     * @var $post Post
     */
    public $post;

    public $content = '';

    public $testing = 0;

    public $modal = [
        'id' => null,
        'show' => false,
        'title' => '确定要删除这条评论吗？',
        'component' => '',
        'content' => '',
    ];

    protected $listeners = [
        'replyToComment','postCommentDestroy' ,'$refresh','showModal'
    ];


    protected $rules = [
        'content' => 'required|min:1',
    ];


    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function star(Request $request)
    {
        if (!auth()->check()) {
            return  redirect()->guest(route('login'));
        }

        if ($this->post->starWithAuth) {
            $this->post->starWithAuth->delete();
        }else{
            $star = $this->post->star()->create();
            $star->user()->associate(auth()->user())->save();
        }

        return ;
    }


    public function render()
    {
        $this->post->load('starWithAuth','tag','comment.user')->loadCount('star','comment');
        return view('livewire.post-show');
    }

    public function comment()
    {
//        $this->emitTo('post-comment','$refresh');
//        return ;
        if (!auth()->check()) {
            return  redirect()->guest(route('login'));
        }

        $this->validate();

        $this->post->comment()->create([
            'content' => $this->content,
            'user_id' => auth()->id()
        ]);
        $this->reset('content');
        $this->emitTo('post-comment','$refresh');
//        $this->emitSelf('$refresh');
    }



    public function postCommentDestroy()
    {
        $this->reset('modal');
    }

    public function showModal($id,$content,$component = 'post-comment')
    {
        $this->modal['show'] = true;
        $this->modal['id'] = $id;
        $this->modal['content'] = $content;
        $this->modal['component'] = $component;
    }

    public function test($name)
    {
//        dd($name);
    }
}
