<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getShowAttribute($value)
    {
        if ($value) return $value;
        return 'hidden';
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($photo = $this->profile_photo_path) {
            if (URL::isValidUrl($photo)) {
                return $photo;
            }
            return Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
        }
        return $this->defaultProfilePhotoUrl();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'to');
    }

    public function latestFirstMessage()
    {
        $this->hasOne(Message::class);
    }

    public function getChannel()
    {
        return $this->id + auth()->id();
    }
}
