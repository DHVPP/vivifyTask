<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['idUser', 'url', 'shortUrl'];
}
