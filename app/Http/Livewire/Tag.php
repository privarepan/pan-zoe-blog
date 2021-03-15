<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Tag as TagModel;

class Tag extends Component
{
    public function render()
    {
        $tags = TagModel::get();
        return view('livewire.tag',['tags' => $tags]);
    }
}
