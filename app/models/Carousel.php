<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model{
	
	protected $table = 'carousel';
	protected $fillable = ['section','title','subtitle','button','carousel'];
}