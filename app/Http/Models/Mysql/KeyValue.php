<?php

namespace App\Http\Models\Mysql;

use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
	protected $table = 'KeyValue';
	protected $primaryKey = 'keyValueId';
	protected $hidden = ['keyValueId', 'createdAt'];
	public $timestamps = false;	
}
