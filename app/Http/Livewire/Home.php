<?php

namespace App\Http\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public $tag = '';

    protected $queryString = [
        'tag' => ['except' => ''],
    ];

    public function render()
    {
        $posts = \App\Models\Post::with('tag','user')->where(function (Builder $query){
            if ($this->tag){
                $query->whereHas('tag',function (Builder $builder){
                    $builder->where('name',$this->tag);
                });
            }
        })->paginate(8);
        return view('livewire.home',['posts' => $posts]);
    }




}
