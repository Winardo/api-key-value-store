<?php

namespace App\Http\Models\Mysql;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'User';
	protected $primaryKey = 'userId';
	protected $hidden = ['userId', 'password'];
	public $timestamps = false;	
}
