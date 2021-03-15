<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from','message','type','channel','to','read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public function read()
    {
        return $this->read_at !== null;
    }

    public function unread()
    {
        return $this->read_at === null;
    }

    public function scopeRead(Builder $builder)
    {
        $builder->whereNotNull('read_at');
    }

    public function scopeUnread(Builder $query)
    {
        return $query->whereNull('read_at');
    }


    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }

    public function markAsUnread()
    {
        if (! is_null($this->read_at)) {
            $this->forceFill(['read_at' => null])->save();
        }
    }
}
