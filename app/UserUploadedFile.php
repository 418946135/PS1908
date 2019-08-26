<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUploadedFile extends Model
{
    public function tags()
    {
        return $this->hasMany(FileTag::class);
    }
}
