<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDelete;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,SoftDelete;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'blocked',
        'photo_filename',
        'custom'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPhotoFullUrlAttribute()
    {
        debug($this->photo_filename);

        if ($this->photo_filename && Storage::exists("public/photos/{$this->photo_filename}")) {
            return asset("storage/photos/{$this->photo_filename}");
        } else {
             return asset('storage/photos/no-photo-icon-22.png');
        }
    }
    public function getFileNameAttribute()
    {
        return strtoupper(trim($this->title)) . '.png';
    }

    public function getImageExistsAttribute()
    {
        return Storage::exists("public/photos/{$this->photo_filename}");
    }

    public function getImageUrlAttribute()
    {
        if ($this->imageExists) {
            return asset("storage/photos/{$this->photo_filename}");
        }
        return asset('storage/photos/no-photo-icon-22.png');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class,'id');
    }
    public function block()
    {
        $this->blocked = 1;
        $this->save();
    }

    public function unblock()
    {
        $this->blocked = 0;
        $this->save();
    }

    public function isBlocked($userid): bool
    {
        return $this->blocked;
    }



}
