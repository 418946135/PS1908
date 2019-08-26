<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function uploadedFiles()
    {
        return $this->hasMany(UserUploadedFile::class);
    }

    public function getUploadedFileTypes()
    {
        return UserUploadedFile::where('user_id', $this->id)->select('type')->distinct('type')->get();
    }

    public function getFileTags()
    {
        return FileTag::select('name')->distinct('type')->get();
    }
}
