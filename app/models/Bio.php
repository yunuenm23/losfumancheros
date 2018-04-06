<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bio extends Model{
	
	protected $table = 'bio';
	protected $fillable = ['section','title','text','band'];
}