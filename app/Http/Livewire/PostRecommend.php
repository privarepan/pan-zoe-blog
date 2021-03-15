<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostRecommend extends Component
{
    public function render()
    {
        $posts = \App\Models\Post::where('is_recommend',1)->take(10)->get();
        return view('livewire.post-recommend',['posts' => $posts]);
    }
}
