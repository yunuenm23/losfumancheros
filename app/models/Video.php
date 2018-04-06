<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model{
	
	protected $table = 'videonuevo';
	protected $fillable = ['title','codigo','informacion'];
}