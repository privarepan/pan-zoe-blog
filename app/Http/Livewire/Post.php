<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Post extends Component
{

    public $post;

    public function mount(\App\Models\Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post');
    }
}
