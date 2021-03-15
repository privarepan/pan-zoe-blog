<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $show = false;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatedSearch($value)
    {
        $this->show = true;
        return $value;
    }

    public function render()
    {
        if (filled($this->search)) {
            $posts = Post::with('user:name,id')->where('title','like',"%$this->search%")->orWhere('content','like',"%$this->search%")->take(8)->get();
        }

        return view('livewire.search', ['posts' => $posts ?? []]);
    }
}
