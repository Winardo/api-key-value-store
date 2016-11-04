<?php

namespace App\Http\Models\Mysql;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = 'UserSession';
    protected $primaryKey = 'sessionId';
    public $timestamps = false; 
}
