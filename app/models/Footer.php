<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model{
	
	protected $table = 'footer';
	protected $fillable = ['hiring','city','facebook','twitter','youtube','instagram','developer'];
}