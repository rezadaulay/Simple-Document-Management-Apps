<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\FieldsType;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FieldsType;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'company_name',
        'division_name',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile_picture_url'];

    public function getHashFields(): Array
    {
        return [
            'password'
        ];
    }

    public function getFileFields(): Array
    {
        return [
            'profile_picture'
        ];
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getProfilePictureUrlAttribute()
    {
        if (is_null($this->attributes['profile_picture'])) {
            return null;
        }
        return Storage::url($this->attributes['profile_picture']);
    }
}
