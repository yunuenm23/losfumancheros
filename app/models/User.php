<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
	
	protected $table = 'users';
	protected $fillable = ['username','name','lastname','email','password','profile_photo'];
}