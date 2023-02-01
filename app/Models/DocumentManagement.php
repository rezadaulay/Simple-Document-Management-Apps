<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FieldsType;
use Illuminate\Support\Facades\Storage;

class DocumentManagement extends Model
{
    use HasFactory, FieldsType;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'signing_type',
        'signing_image',
        'signing_manual'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'signing_type' => 'string',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['signing_image_url'];

    public function getHashFields(): Array
    {
        return [
            'password'
        ];
    }

    public function getFileFields(): Array
    {
        return [
            'signing_image'
        ];
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getSigningImageUrlAttribute()
    {
        if (is_null($this->attributes['signing_image'])) {
            return null;
        }
        return Storage::url($this->attributes['signing_image']);
    }
}
