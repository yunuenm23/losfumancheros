<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head extends Model{
	
	protected $table = 'head';
	protected $fillable = ['sititle','description','keywords','author'];
}